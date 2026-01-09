<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class LogoManagerController extends Controller
{
    protected $logosPath;

    public function __construct()
    {
        $this->logosPath = storage_path('app/content/global-json/global-logos.json');
    }

    public function index()
    {
        $logos = $this->loadLogos();
        return view('admin.logo-manager', compact('logos'));
    }

    public function update(Request $request)
    {
        $logos = $this->loadLogos();

        // Handle Header Logo
        if ($request->hasFile('header_logo')) {
            // File upload takes priority
            $path = $request->file('header_logo')->store('logos', 'public');
            $logos['header']['default'] = 'storage/' . $path;
        } elseif ($request->filled('header_logo_url') && $request->input('header_source') === 'url') {
            // Only update URL if source is explicitly URL and no file was uploaded
            $logos['header']['default'] = $request->input('header_logo_url');
        }

        // Handle Footer Logo
        if ($request->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->store('logos', 'public');
            $logos['footer']['default'] = 'storage/' . $path;
        } elseif ($request->filled('footer_logo_url') && $request->input('footer_source') === 'url') {
            $logos['footer']['default'] = $request->input('footer_logo_url');
        }

        // Handle Favicon - Fix: Check file first, then URL
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('logos', 'public');
            $logos['favicon'] = 'storage/' . $path;
        } elseif ($request->filled('favicon_url') && $request->input('favicon_source') === 'url') {
            $logos['favicon'] = $request->input('favicon_url');
        }

        $this->saveLogos($logos);

        return redirect()->back()->with('success', 'Logos updated successfully!');
    }

    /**
     * Get media files for the media library
     */
    public function getMedia(Request $request)
    {
        $folder = $request->get('folder', 'logos');
        $files = [];

        // Define search paths based on folder type
        $searchPaths = [];

        switch ($folder) {
            case 'logos':
                $searchPaths = [
                    storage_path('app/public/logos'),
                    public_path('storage/logos'),
                ];
                break;

            case 'assets':
                $searchPaths = [
                    storage_path('app/public/assets/img'),
                    public_path('assets/img'),
                ];
                break;

            case 'all':
                $searchPaths = [
                    storage_path('app/public/logos'),
                    storage_path('app/public/assets/img'),
                    public_path('assets/img'),
                ];
                break;
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'webp'];

        foreach ($searchPaths as $basePath) {
            if (!is_dir($basePath)) continue;

            $this->scanDirectory($basePath, $files, $imageExtensions);
        }

        // Remove duplicates based on filename
        $uniqueFiles = [];
        $seenNames = [];
        foreach ($files as $file) {
            if (!in_array($file['name'], $seenNames)) {
                $uniqueFiles[] = $file;
                $seenNames[] = $file['name'];
            }
        }

        // Sort by name
        usort($uniqueFiles, function($a, $b) {
            return strcasecmp($a['name'], $b['name']);
        });

        return response()->json([
            'success' => true,
            'files' => array_slice($uniqueFiles, 0, 100) // Limit to 100 files
        ]);
    }

    /**
     * Recursively scan directory for images
     */
    private function scanDirectory($path, &$files, $extensions, $depth = 0)
    {
        if ($depth > 2 || !is_dir($path)) return; // Limit recursion depth

        $items = scandir($path);

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') continue;

            $fullPath = $path . DIRECTORY_SEPARATOR . $item;

            if (is_dir($fullPath)) {
                $this->scanDirectory($fullPath, $files, $extensions, $depth + 1);
            } else {
                $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                if (in_array($ext, $extensions)) {
                    // Convert to web-accessible path
                    $webPath = $this->convertToWebPath($fullPath);
                    if ($webPath) {
                        $files[] = [
                            'name' => $item,
                            'path' => $webPath,
                            'extension' => $ext
                        ];
                    }
                }
            }
        }
    }

    /**
     * Convert filesystem path to web-accessible path
     */
    private function convertToWebPath($fullPath)
    {
        $fullPath = str_replace('\\', '/', $fullPath);

        // Check if it's in storage/app/public
        if (strpos($fullPath, 'storage/app/public/') !== false) {
            $relativePath = substr($fullPath, strpos($fullPath, 'storage/app/public/') + strlen('storage/app/public/'));
            return 'storage/' . $relativePath;
        }

        // Check if it's in public/storage
        if (strpos($fullPath, 'public/storage/') !== false) {
            $relativePath = substr($fullPath, strpos($fullPath, 'public/storage/') + strlen('public/'));
            return $relativePath;
        }

        // Check if it's in public/assets
        if (strpos($fullPath, 'public/assets/') !== false) {
            $relativePath = substr($fullPath, strpos($fullPath, 'public/assets/') + strlen('public/'));
            return $relativePath;
        }

        return null;
    }

    /**
     * Upload a file to the logos folder
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120' // 5MB max
        ]);

        try {
            $path = $request->file('file')->store('logos', 'public');

            return response()->json([
                'success' => true,
                'path' => 'storage/' . $path,
                'message' => 'File uploaded successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function loadLogos()
    {
        if (file_exists($this->logosPath)) {
            return json_decode(file_get_contents($this->logosPath), true) ?? [];
        }
        return [
            'header' => ['default' => ''],
            'footer' => ['default' => ''],
            'favicon' => '',
        ];
    }

    protected function saveLogos($logos)
    {
        $dir = dirname($this->logosPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents(
            $this->logosPath,
            json_encode($logos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }
}
