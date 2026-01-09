<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ThemeImportService
{
    protected $themesPath;
    protected $requiredFiles = ['theme.json', 'preview.jpg'];
    protected $errors = [];

    public function __construct()
    {
        $this->themesPath = storage_path('app/themes');

        // Ensure themes directory exists
        if (!File::isDirectory($this->themesPath)) {
            File::makeDirectory($this->themesPath, 0755, true);
        }
    }

    /**
     * Import theme from ZIP file
     */
    public function importFromZip($zipPath): array
    {
        $this->errors = [];

        $zip = new ZipArchive();
        if ($zip->open($zipPath) !== true) {
            return ['success' => false, 'errors' => ['Unable to open ZIP file']];
        }

        // Create temp directory for extraction
        $tempDir = storage_path('app/temp/' . Str::random(16));
        File::makeDirectory($tempDir, 0755, true);

        // Extract ZIP
        $zip->extractTo($tempDir);
        $zip->close();

        // Find theme.json (might be in root or subdirectory)
        $themeJsonPath = $this->findThemeJson($tempDir);

        if (!$themeJsonPath) {
            File::deleteDirectory($tempDir);
            return ['success' => false, 'errors' => ['theme.json not found in package']];
        }

        $themeRoot = dirname($themeJsonPath);

        // Validate theme structure
        $validation = $this->validateTheme($themeRoot);
        if (!$validation['valid']) {
            File::deleteDirectory($tempDir);
            return ['success' => false, 'errors' => $validation['errors']];
        }

        // Read theme metadata
        $themeData = json_decode(File::get($themeJsonPath), true);
        $slug = Str::slug($themeData['slug'] ?? $themeData['name']);

        // Check if theme already exists
        $targetDir = $this->themesPath . '/' . $slug;
        if (File::isDirectory($targetDir)) {
            // Backup existing theme
            $backupDir = $this->themesPath . '/_backups/' . $slug . '_' . date('Y-m-d_His');
            File::moveDirectory($targetDir, $backupDir);
        }

        // Move theme to themes directory
        File::moveDirectory($themeRoot, $targetDir);

        // Clean up temp directory
        File::deleteDirectory($tempDir);

        // Process theme assets (copy to public)
        $this->processThemeAssets($slug);

        // Register theme sections
        $this->registerThemeSections($slug);

        return [
            'success' => true,
            'theme' => $this->getThemeInfo($slug),
            'message' => "Theme '{$themeData['name']}' imported successfully!"
        ];
    }

    /**
     * Find theme.json in extracted directory
     */
    protected function findThemeJson($dir): ?string
    {
        // Check root
        if (File::exists($dir . '/theme.json')) {
            return $dir . '/theme.json';
        }

        // Check first level subdirectories
        $directories = File::directories($dir);
        foreach ($directories as $subdir) {
            if (File::exists($subdir . '/theme.json')) {
                return $subdir . '/theme.json';
            }
        }

        return null;
    }

    /**
     * Validate theme structure
     */
    protected function validateTheme($themeRoot): array
    {
        $errors = [];

        // Check required files
        foreach ($this->requiredFiles as $file) {
            if (!File::exists($themeRoot . '/' . $file)) {
                $errors[] = "Required file missing: {$file}";
            }
        }

        // Validate theme.json structure
        $themeJsonPath = $themeRoot . '/theme.json';
        if (File::exists($themeJsonPath)) {
            $themeData = json_decode(File::get($themeJsonPath), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $errors[] = "Invalid JSON in theme.json";
            } else {
                $requiredFields = ['name', 'version', 'author'];
                foreach ($requiredFields as $field) {
                    if (empty($themeData[$field])) {
                        $errors[] = "Missing required field in theme.json: {$field}";
                    }
                }
            }
        }

        // Validate sections if config exists
        $sectionsConfig = $themeRoot . '/config/sections.json';
        if (File::exists($sectionsConfig)) {
            $sections = json_decode(File::get($sectionsConfig), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $errors[] = "Invalid JSON in config/sections.json";
            } else {
                // Check if section blade files exist
                foreach ($sections as $key => $section) {
                    if (isset($section['partial'])) {
                        $bladePath = str_replace('.', '/', $section['partial']) . '.blade.php';
                        $fullPath = $themeRoot . '/sections/' . basename($bladePath);

                        // Also check in proper structure
                        $altPath = $themeRoot . '/' . $bladePath;

                        if (!File::exists($fullPath) && !File::exists($altPath)) {
                            // Just a warning, not an error
                            \Log::warning("Section blade file not found: {$bladePath}");
                        }
                    }
                }
            }
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    /**
     * Process theme assets - copy to public directory
     */
    protected function processThemeAssets($slug): void
    {
        $themeDir = $this->themesPath . '/' . $slug;
        $assetsSource = $themeDir . '/assets';
        $assetsTarget = public_path('assets/themes/' . $slug);

        if (File::isDirectory($assetsSource)) {
            // Remove old assets if exist
            if (File::isDirectory($assetsTarget)) {
                File::deleteDirectory($assetsTarget);
            }

            // Copy new assets
            File::copyDirectory($assetsSource, $assetsTarget);
        }

        // Copy preview image
        $previewSource = $themeDir . '/preview.jpg';
        $previewTarget = public_path('assets/themes/' . $slug . '/preview.jpg');

        if (File::exists($previewSource)) {
            File::copy($previewSource, $previewTarget);
        }
    }

    /**
     * Register theme sections to the system
     */
    protected function registerThemeSections($slug): void
    {
        $themeDir = $this->themesPath . '/' . $slug;
        $sectionsConfig = $themeDir . '/config/sections.json';
        $sectionsDir = $themeDir . '/sections';

        if (!File::isDirectory($sectionsDir)) {
            return;
        }

        // Copy section blade files to resources/views/partials/themes/{slug}/
        $targetDir = resource_path('views/partials/themes/' . $slug);

        if (!File::isDirectory($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        // Copy all blade files
        $bladeFiles = File::glob($sectionsDir . '/*.blade.php');
        foreach ($bladeFiles as $file) {
            File::copy($file, $targetDir . '/' . basename($file));
        }

        // Also copy nested blade files
        $nestedDirs = File::directories($sectionsDir);
        foreach ($nestedDirs as $nestedDir) {
            $nestedTarget = $targetDir . '/' . basename($nestedDir);
            if (!File::isDirectory($nestedTarget)) {
                File::makeDirectory($nestedTarget, 0755, true);
            }

            $nestedFiles = File::glob($nestedDir . '/*.blade.php');
            foreach ($nestedFiles as $file) {
                File::copy($file, $nestedTarget . '/' . basename($file));
            }
        }
    }

    /**
     * Get theme information
     */
    public function getThemeInfo($slug): ?array
    {
        $themeDir = $this->themesPath . '/' . $slug;
        $themeJsonPath = $themeDir . '/theme.json';

        if (!File::exists($themeJsonPath)) {
            return null;
        }

        $themeData = json_decode(File::get($themeJsonPath), true);
        $themeData['slug'] = $slug;
        $themeData['path'] = $themeDir;
        $themeData['preview_url'] = asset('assets/themes/' . $slug . '/preview.jpg');

        // Get sections config if exists
        $sectionsConfig = $themeDir . '/config/sections.json';
        if (File::exists($sectionsConfig)) {
            $themeData['sections_config'] = json_decode(File::get($sectionsConfig), true);
        }

        return $themeData;
    }

    /**
     * Get all installed themes
     */
    public function getInstalledThemes(): array
    {
        $themes = [];

        if (!File::isDirectory($this->themesPath)) {
            return $themes;
        }

        $directories = File::directories($this->themesPath);

        foreach ($directories as $dir) {
            $slug = basename($dir);

            // Skip backup directory
            if ($slug === '_backups') {
                continue;
            }

            $themeInfo = $this->getThemeInfo($slug);
            if ($themeInfo) {
                $themes[] = $themeInfo;
            }
        }

        return $themes;
    }

    /**
     * Delete theme
     */
    public function deleteTheme($slug): bool
    {
        $themeDir = $this->themesPath . '/' . $slug;
        $assetsDir = public_path('assets/themes/' . $slug);
        $viewsDir = resource_path('views/partials/themes/' . $slug);

        // Delete theme directory
        if (File::isDirectory($themeDir)) {
            File::deleteDirectory($themeDir);
        }

        // Delete assets
        if (File::isDirectory($assetsDir)) {
            File::deleteDirectory($assetsDir);
        }

        // Delete views
        if (File::isDirectory($viewsDir)) {
            File::deleteDirectory($viewsDir);
        }

        return true;
    }

    /**
     * Export current theme/page builder sections as theme package
     */
    public function exportTheme($name, $sections = []): string
    {
        $slug = Str::slug($name);
        $exportDir = storage_path('app/exports/' . $slug);

        // Create export directory structure
        File::makeDirectory($exportDir . '/sections', 0755, true);
        File::makeDirectory($exportDir . '/assets/css', 0755, true);
        File::makeDirectory($exportDir . '/assets/js', 0755, true);
        File::makeDirectory($exportDir . '/assets/images', 0755, true);
        File::makeDirectory($exportDir . '/config', 0755, true);
        File::makeDirectory($exportDir . '/sample-data/pages', 0755, true);

        // Create theme.json
        $themeJson = [
            'name' => $name,
            'slug' => $slug,
            'version' => '1.0.0',
            'author' => 'Exported Theme',
            'description' => 'Exported from Page Builder',
            'category' => 'Custom',
            'sections' => array_keys($sections),
            'compatible_version' => '1.0.0'
        ];
        File::put($exportDir . '/theme.json', json_encode($themeJson, JSON_PRETTY_PRINT));

        // Export sections config
        File::put($exportDir . '/config/sections.json', json_encode($sections, JSON_PRETTY_PRINT));

        // Create ZIP
        $zipPath = storage_path('app/exports/' . $slug . '.zip');
        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $this->addDirectoryToZip($zip, $exportDir, $slug);

        $zip->close();

        // Clean up export directory
        File::deleteDirectory($exportDir);

        return $zipPath;
    }

    /**
     * Add directory to ZIP recursively
     */
    protected function addDirectoryToZip($zip, $dir, $baseName): void
    {
        $files = File::allFiles($dir);

        foreach ($files as $file) {
            $relativePath = $baseName . '/' . $file->getRelativePathname();
            $zip->addFile($file->getPathname(), $relativePath);
        }
    }

    /**
     * Import sample pages from theme
     */
    public function importSamplePages($slug): array
    {
        $themeDir = $this->themesPath . '/' . $slug;
        $samplePagesDir = $themeDir . '/sample-data/pages';
        $imported = [];

        if (!File::isDirectory($samplePagesDir)) {
            return $imported;
        }

        $pageFiles = File::glob($samplePagesDir . '/*.json');
        $customPagesDir = storage_path('app/content/custom-pages');

        foreach ($pageFiles as $pageFile) {
            $pageData = json_decode(File::get($pageFile), true);

            if ($pageData) {
                // Generate unique slug if needed
                $baseSlug = $pageData['slug'] ?? Str::slug($pageData['title'] ?? 'imported-page');
                $slug = $baseSlug;
                $counter = 1;

                while (File::exists($customPagesDir . '/' . $slug . '.json')) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $pageData['slug'] = $slug;
                $pageData['id'] = Str::uuid()->toString();
                $pageData['created_at'] = now()->toIso8601String();
                $pageData['updated_at'] = now()->toIso8601String();

                File::put(
                    $customPagesDir . '/' . $slug . '.json',
                    json_encode($pageData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                );

                $imported[] = $pageData;
            }
        }

        return $imported;
    }
}
