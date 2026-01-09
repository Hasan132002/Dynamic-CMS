<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ThemeService;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    protected ThemeService $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->themeService = $themeService;
    }

    /**
     * Display theme manager page
     */
    public function index()
    {
        $themes = $this->themeService->getAllThemes();
        $activeTheme = $this->themeService->getActiveThemeSlug();

        return view('admin.theme-manager', compact('themes', 'activeTheme'));
    }

    /**
     * Activate a theme
     */
    public function activate(string $slug)
    {
        if (!$this->themeService->themeExists($slug)) {
            return redirect()->back()->with('error', 'Theme not found.');
        }

        $oldTheme = $this->themeService->getActiveThemeSlug();
        $success = $this->themeService->activateTheme($slug);

        if ($success) {
            // Log theme activation
            ActivityLogService::logThemeActivate($oldTheme, $slug);
            return redirect()->back()->with('success', 'Theme activated successfully!');
        }

        return redirect()->back()->with('error', 'Failed to activate theme.');
    }

    /**
     * Show theme details/edit page
     */
    public function edit(string $slug)
    {
        if (!$this->themeService->themeExists($slug)) {
            return redirect()->route('admin.themes')->with('error', 'Theme not found.');
        }

        $theme = $this->themeService->getThemeBySlug($slug);
        $isActive = ($slug === $this->themeService->getActiveThemeSlug());

        // Get available versions for dropdowns
        $homeVersions = $this->getAvailableVersions('sections', 'home-');
        $headerVersions = $this->getAvailableVersions('headers', 'header-');
        $footerVersions = $this->getAvailableVersions('footers', 'footer-');

        return view('admin.theme-edit', compact(
            'theme',
            'isActive',
            'homeVersions',
            'headerVersions',
            'footerVersions'
        ));
    }

    /**
     * Update theme settings
     */
    public function update(Request $request, string $slug)
    {
        if (!$this->themeService->themeExists($slug)) {
            return redirect()->route('admin.themes')->with('error', 'Theme not found.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'company' => 'nullable|string|max:255',
            'home_version' => 'required|string',
            'header_version' => 'required|string',
            'footer_version' => 'required|string',
            'colors' => 'nullable|array',
            'colors.primary' => 'nullable|string|max:7',
            'colors.secondary' => 'nullable|string|max:7',
            'colors.accent' => 'nullable|string|max:7',
            'colors.header_bg' => 'nullable|string|max:7',
            'colors.header_text' => 'nullable|string|max:7',
            'colors.footer_bg' => 'nullable|string|max:7',
            'colors.footer_text' => 'nullable|string|max:7',
        ]);

        // Update theme.json
        $themePath = storage_path("app/content/themes/{$slug}/theme.json");
        $oldThemeData = json_decode(file_get_contents($themePath), true);
        $themeData = $oldThemeData;

        $themeData['name'] = $validated['name'];
        $themeData['description'] = $validated['description'] ?? '';
        $themeData['company'] = $validated['company'] ?? '';
        $themeData['home_version'] = $validated['home_version'];
        $themeData['header_version'] = $validated['header_version'];
        $themeData['footer_version'] = $validated['footer_version'];

        file_put_contents($themePath, json_encode($themeData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        // Update version files
        $this->updateVersionFile($slug, 'home.json', $validated['home_version']);
        $this->updateVersionFile($slug, 'header.json', $validated['header_version']);
        $this->updateVersionFile($slug, 'footer.json', $validated['footer_version']);

        // Update assets.json with colors
        if (!empty($validated['colors'])) {
            $assetsPath = storage_path("app/content/themes/{$slug}/assets.json");
            $assetsData = [];
            if (file_exists($assetsPath)) {
                $assetsData = json_decode(file_get_contents($assetsPath), true) ?? [];
            }

            // Ensure colors array exists
            if (!isset($assetsData['colors'])) {
                $assetsData['colors'] = [];
            }

            // Update colors
            foreach ($validated['colors'] as $key => $value) {
                if (!empty($value)) {
                    $assetsData['colors'][$key] = $value;
                }
            }

            file_put_contents($assetsPath, json_encode($assetsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        }

        // Log theme update
        $assetsPath = storage_path("app/content/themes/{$slug}/assets.json");
        $currentAssets = file_exists($assetsPath) ? json_decode(file_get_contents($assetsPath), true) : [];
        ActivityLogService::logThemeUpdate(
            $slug,
            ['theme' => $oldThemeData, 'assets' => []],
            ['theme' => $themeData, 'assets' => $currentAssets],
            "Updated theme: {$validated['name']}"
        );

        return redirect()->back()->with('success', 'Theme updated successfully!');
    }

    /**
     * Update theme assets (colors, fonts, brand)
     */
    public function updateAssets(Request $request, string $slug)
    {
        if (!$this->themeService->themeExists($slug)) {
            return response()->json(['success' => false, 'message' => 'Theme not found'], 404);
        }

        $assets = $request->input('assets', []);

        $success = $this->themeService->updateThemeAssets($slug, $assets);

        if ($success) {
            return response()->json(['success' => true, 'message' => 'Assets updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update assets'], 500);
    }

    /**
     * Show create theme form
     */
    public function create()
    {
        $existingThemes = $this->themeService->getAllThemes();
        $homeVersions = $this->getAvailableVersions('sections', 'home-');
        $headerVersions = $this->getAvailableVersions('headers', 'header-');
        $footerVersions = $this->getAvailableVersions('footers', 'footer-');

        return view('admin.theme-create', compact(
            'existingThemes',
            'homeVersions',
            'headerVersions',
            'footerVersions'
        ));
    }

    /**
     * Store new theme
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:100|regex:/^[a-z0-9-]+$/',
            'description' => 'nullable|string|max:500',
            'company' => 'nullable|string|max:255',
            'home_version' => 'required|string',
            'header_version' => 'required|string',
            'footer_version' => 'required|string',
            'copy_from' => 'nullable|string',
        ]);

        // Check if theme already exists
        if ($this->themeService->themeExists($validated['slug'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'A theme with this slug already exists.');
        }

        $success = $this->themeService->createTheme($validated, $validated['copy_from'] ?? null);

        if ($success) {
            return redirect()->route('admin.themes')
                ->with('success', "Theme '{$validated['name']}' created successfully!");
        }

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to create theme.');
    }

    /**
     * Delete a theme
     */
    public function destroy(string $slug)
    {
        // Check if trying to delete active theme
        if ($slug === $this->themeService->getActiveThemeSlug()) {
            return redirect()->back()->with('error', 'Cannot delete the active theme. Please activate another theme first.');
        }

        // Check if system theme
        $theme = $this->themeService->getThemeBySlug($slug);
        if ($theme['is_system'] ?? false) {
            return redirect()->back()->with('error', 'Cannot delete system themes.');
        }

        $success = $this->themeService->deleteTheme($slug);

        if ($success) {
            return redirect()->route('admin.themes')->with('success', 'Theme deleted successfully!');
        }

        return redirect()->back()->with('error', 'Failed to delete theme.');
    }

    /**
     * Preview theme (AJAX)
     */
    public function preview(string $slug)
    {
        if (!$this->themeService->themeExists($slug)) {
            return response()->json(['success' => false, 'message' => 'Theme not found'], 404);
        }

        $theme = $this->themeService->getThemeBySlug($slug);

        return response()->json([
            'success' => true,
            'theme' => $theme,
        ]);
    }

    /**
     * Get available versions from views directory
     */
    private function getAvailableVersions(string $folder, string $prefix): array
    {
        $versions = [];
        $path = resource_path("views/partials/{$folder}");

        if (!is_dir($path)) {
            return $versions;
        }

        $items = scandir($path);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            // For sections, look for directories like home-v1, home-v2
            if ($folder === 'sections' && is_dir("{$path}/{$item}")) {
                if (strpos($item, $prefix) === 0) {
                    $versions[] = $item;
                }
            }

            // For headers/footers, look for files like header-v1.blade.php
            if (($folder === 'headers' || $folder === 'footers') && is_file("{$path}/{$item}")) {
                $name = str_replace('.blade.php', '', $item);
                if (strpos($name, $prefix) === 0) {
                    $versions[] = $name;
                }
            }
        }

        sort($versions);
        return $versions;
    }

    /**
     * Update version file (home.json, header.json, footer.json)
     */
    private function updateVersionFile(string $slug, string $filename, string $version): void
    {
        $path = storage_path("app/content/themes/{$slug}/{$filename}");

        $data = ['version' => $version];

        // For home.json, also add content_file reference
        if ($filename === 'home.json') {
            $data['content_file'] = $version . '.json';
        }

        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
