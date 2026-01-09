<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

class ThemeService
{
    private string $themesDir = 'content/themes/';
    private string $globalJsonDir = 'content/global-json/';
    private string $activeThemeFile = 'content/global-json/active-theme.json';

    /**
     * Get the currently active theme slug
     */
    public function getActiveThemeSlug(): string
    {
        $data = $this->readJson($this->activeThemeFile);
        return $data['active_theme'] ?? 'default';
    }

    /**
     * Get the complete active theme configuration
     * Includes theme config, versions, and assets
     */
    public function getActiveTheme(): array
    {
        $slug = $this->getActiveThemeSlug();
        return $this->getThemeBySlug($slug);
    }

    /**
     * Get a specific theme by slug
     */
    public function getThemeBySlug(string $slug): array
    {
        $themePath = $this->themesDir . $slug . '/';

        // Check if theme exists
        if (!Storage::exists($themePath . 'theme.json')) {
            // Fallback to default theme
            if ($slug !== 'default') {
                return $this->getThemeBySlug('default');
            }
            throw new RuntimeException("Default theme not found");
        }

        // Load theme configuration files
        $theme = $this->readJson($themePath . 'theme.json');
        $home = $this->readJson($themePath . 'home.json');
        $header = $this->readJson($themePath . 'header.json');
        $footer = $this->readJson($themePath . 'footer.json');
        $assets = $this->readJson($themePath . 'assets.json');

        // Merge all into single array
        return [
            'slug' => $slug,
            'name' => $theme['name'] ?? 'Unknown Theme',
            'description' => $theme['description'] ?? '',
            'company' => $theme['company'] ?? '',
            'version' => $theme['version'] ?? '1.0.0',
            'author' => $theme['author'] ?? '',
            'css' => $theme['css'] ?? 'default.css',
            'preview_image' => $theme['preview_image'] ?? '',
            'is_system' => $theme['is_system'] ?? false,

            // Version pointers
            'home_version' => $theme['home_version'] ?? $home['version'] ?? 'home-v1',
            'header_version' => $theme['header_version'] ?? $header['version'] ?? 'header-v1',
            'footer_version' => $theme['footer_version'] ?? $footer['version'] ?? 'footer-v1',

            // Content file reference
            'home_content_file' => $home['content_file'] ?? null,

            // Assets (brand, colors, fonts, social)
            'assets' => $assets,
        ];
    }

    /**
     * Get all available themes
     */
    public function getAllThemes(): array
    {
        $themes = [];
        $activeSlug = $this->getActiveThemeSlug();

        // Scan themes directory
        $directories = Storage::directories($this->themesDir);

        foreach ($directories as $dir) {
            $slug = basename($dir);
            $themePath = $this->themesDir . $slug . '/theme.json';

            if (Storage::exists($themePath)) {
                $themeData = $this->readJson($themePath);
                $themes[] = [
                    'slug' => $slug,
                    'name' => $themeData['name'] ?? $slug,
                    'description' => $themeData['description'] ?? '',
                    'preview_image' => $themeData['preview_image'] ?? '',
                    'version' => $themeData['version'] ?? '1.0.0',
                    'author' => $themeData['author'] ?? '',
                    'is_active' => ($slug === $activeSlug),
                    'is_system' => $themeData['is_system'] ?? false,
                ];
            }
        }

        return $themes;
    }

    /**
     * Activate a theme by slug
     */
    public function activateTheme(string $slug): bool
    {
        // Verify theme exists
        $themePath = $this->themesDir . $slug . '/theme.json';
        if (!Storage::exists($themePath)) {
            return false;
        }

        // Update active theme file
        $data = [
            'active_theme' => $slug,
            'last_updated' => now()->toDateTimeString(),
            'updated_by' => auth()->user()->name ?? 'system',
        ];

        $this->writeJson($this->activeThemeFile, $data);

        // Clear any cached theme data
        Cache::forget('active_theme');
        Cache::forget('theme_' . $slug);

        return true;
    }

    /**
     * Get theme versions (for controller use)
     */
    public function getThemeVersions(): array
    {
        $theme = $this->getActiveTheme();

        return [
            'home' => $theme['home_version'],
            'header' => $theme['header_version'],
            'footer' => $theme['footer_version'],
        ];
    }

    /**
     * Get theme assets merged with global settings
     * Theme assets override global settings
     */
    public function getThemeAssets(): array
    {
        $theme = $this->getActiveTheme();
        $themeAssets = $theme['assets'] ?? [];

        // Load global settings for fallback
        $globalColors = $this->readJson($this->globalJsonDir . 'global-colors.json');
        $globalFonts = $this->readJson($this->globalJsonDir . 'global-fonts.json');
        $globalLogos = $this->readJson($this->globalJsonDir . 'global-logos.json');

        // Merge: Theme overrides Global
        return [
            'brand' => $themeAssets['brand'] ?? [],
            'colors' => array_merge(
                $globalColors['base'] ?? [],
                $themeAssets['colors'] ?? []
            ),
            'fonts' => array_merge(
                $globalFonts['default'] ?? [],
                $themeAssets['fonts'] ?? []
            ),
            'social' => $themeAssets['social'] ?? [],
        ];
    }

    /**
     * Get data for Blade templates
     * Combines theme info with global navigation
     */
    public function getThemeData(): array
    {
        $theme = $this->getActiveTheme();
        $assets = $this->getThemeAssets();
        $globalNav = $this->readJson($this->globalJsonDir . 'global-navigation.json');

        return [
            'theme' => $theme,
            'assets' => $assets,
            'globalNavigation' => $globalNav,
        ];
    }

    /**
     * Check if a theme exists
     */
    public function themeExists(string $slug): bool
    {
        return Storage::exists($this->themesDir . $slug . '/theme.json');
    }

    /**
     * Create a new theme (copy from existing or blank)
     */
    public function createTheme(array $data, string $copyFrom = null): bool
    {
        $slug = $data['slug'] ?? '';
        if (empty($slug) || $this->themeExists($slug)) {
            return false;
        }

        $themePath = $this->themesDir . $slug . '/';

        if ($copyFrom && $this->themeExists($copyFrom)) {
            // Copy from existing theme
            $sourcePath = $this->themesDir . $copyFrom . '/';
            $files = ['theme.json', 'home.json', 'header.json', 'footer.json', 'assets.json'];

            foreach ($files as $file) {
                if (Storage::exists($sourcePath . $file)) {
                    $content = Storage::get($sourcePath . $file);
                    Storage::put($themePath . $file, $content);
                }
            }

            // Update theme.json with new data
            $themeConfig = $this->readJson($themePath . 'theme.json');
            $themeConfig['name'] = $data['name'] ?? $slug;
            $themeConfig['slug'] = $slug;
            $themeConfig['description'] = $data['description'] ?? '';
            $themeConfig['is_system'] = false;
            $themeConfig['created_at'] = now()->toDateString();

            $this->writeJson($themePath . 'theme.json', $themeConfig);
        } else {
            // Create blank theme structure
            $this->writeJson($themePath . 'theme.json', [
                'name' => $data['name'] ?? $slug,
                'slug' => $slug,
                'description' => $data['description'] ?? '',
                'company' => $data['company'] ?? '',
                'home_version' => $data['home_version'] ?? 'home-v1',
                'header_version' => $data['header_version'] ?? 'header-v1',
                'footer_version' => $data['footer_version'] ?? 'footer-v1',
                'css' => $slug . '.css',
                'preview_image' => '',
                'author' => auth()->user()->name ?? 'Unknown',
                'version' => '1.0.0',
                'created_at' => now()->toDateString(),
                'is_system' => false,
            ]);

            $this->writeJson($themePath . 'home.json', [
                'version' => $data['home_version'] ?? 'home-v1',
            ]);

            $this->writeJson($themePath . 'header.json', [
                'version' => $data['header_version'] ?? 'header-v1',
            ]);

            $this->writeJson($themePath . 'footer.json', [
                'version' => $data['footer_version'] ?? 'footer-v1',
            ]);

            $this->writeJson($themePath . 'assets.json', [
                'brand' => [
                    'company_name' => $data['company'] ?? '',
                    'tagline' => '',
                    'logo' => '',
                    'logo_dark' => '',
                    'favicon' => '',
                ],
                'colors' => [
                    'primary' => '#007bff',
                    'secondary' => '#6c757d',
                    'accent' => '#17a2b8',
                ],
                'fonts' => [
                    'primary' => 'Inter',
                    'secondary' => 'Poppins',
                ],
                'social' => [],
            ]);
        }

        return true;
    }

    /**
     * Delete a theme (cannot delete active or system themes)
     */
    public function deleteTheme(string $slug): bool
    {
        // Cannot delete active theme
        if ($slug === $this->getActiveThemeSlug()) {
            return false;
        }

        // Cannot delete system themes
        $theme = $this->readJson($this->themesDir . $slug . '/theme.json');
        if ($theme['is_system'] ?? false) {
            return false;
        }

        // Delete theme directory
        return Storage::deleteDirectory($this->themesDir . $slug);
    }

    /**
     * Update theme assets (colors, fonts, brand)
     */
    public function updateThemeAssets(string $slug, array $assets): bool
    {
        if (!$this->themeExists($slug)) {
            return false;
        }

        $assetsPath = $this->themesDir . $slug . '/assets.json';
        $currentAssets = $this->readJson($assetsPath);

        // Merge updates
        $updatedAssets = array_replace_recursive($currentAssets, $assets);

        $this->writeJson($assetsPath, $updatedAssets);

        // Clear cache
        Cache::forget('theme_' . $slug);

        return true;
    }

    /**
     * Read JSON file
     */
    private function readJson(string $path): array
    {
        if (!Storage::exists($path)) {
            return [];
        }

        $raw = Storage::get($path);
        $decoded = json_decode($raw, true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Write JSON file
     */
    private function writeJson(string $path, array $data): void
    {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            throw new RuntimeException("Failed to encode JSON for {$path}");
        }

        Storage::put($path, $json);
    }
}
