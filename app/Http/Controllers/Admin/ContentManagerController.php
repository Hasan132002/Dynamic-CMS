<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentManagerController extends Controller
{
    /**
     * Display the content manager interface
     */
    public function index()
    {
        // Load all page content from storage
        $pages = $this->loadAllPageContent();

        return view('admin.content-manager', [
            'pages' => $pages
        ]);
    }

    /**
     * Update section visibility
     */
    public function updateSectionVisibility(Request $request)
    {
        try {
            $validated = $request->validate([
                'page' => 'required|string',
                'section' => 'required|string',
                'visible' => 'required|boolean'
            ]);

            $page = $validated['page'];
            $section = $validated['section'];
            $visible = $validated['visible'];

            // Load page content - normalize path separators
            $filePath = "content/{$page}.json";

            // Normalize path to use forward slashes for Storage
            $filePath = str_replace('\\', '/', $filePath);

            \Log::info("Content Manager: Attempting update", [
                'page' => $page,
                'filePath' => $filePath,
                'section' => $section,
                'visible' => $visible
            ]);

            if (!Storage::exists($filePath)) {
                \Log::error("Content Manager: File not found", [
                    'page' => $page,
                    'filePath' => $filePath,
                    'section' => $section,
                    'storage_path' => Storage::path($filePath)
                ]);

                return response()->json([
                    'success' => false,
                    'message' => "Page content file not found: {$filePath}"
                ], 404);
            }

            $content = json_decode(Storage::get($filePath), true);

            if ($content === null) {
                \Log::error("Content Manager: Invalid JSON", [
                    'filePath' => $filePath
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid JSON in content file'
                ], 500);
            }

            // Update section visibility - add visible property directly to the section
            if (isset($content[$section])) {
                // If section data is already wrapped with visible property
                if (isset($content[$section]['visible'])) {
                    $content[$section]['visible'] = $visible;
                } else {
                    // Add visible property while preserving all section data
                    $sectionData = $content[$section];
                    $content[$section] = [
                        'visible' => $visible,
                        'data' => $sectionData
                    ];
                }
            } else {
                \Log::error("Content Manager: Section not found", [
                    'filePath' => $filePath,
                    'section' => $section,
                    'available_sections' => array_keys($content)
                ]);

                return response()->json([
                    'success' => false,
                    'message' => "Section '{$section}' not found in page"
                ], 404);
            }

            // Save updated content
            Storage::put($filePath, json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return response()->json([
                'success' => true,
                'message' => 'Section visibility updated successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error("Content Manager: Exception", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Load all page content from storage
     */
    private function loadAllPageContent()
    {
        $pages = [];
        $contentPath = 'content';

        // Get all JSON files from content directory (root level)
        $files = Storage::files($contentPath);

        // Also get files from subdirectories
        $directories = Storage::directories($contentPath);

        foreach ($directories as $dir) {
            // Skip global-json and backup directories
            if (strpos($dir, 'global-') !== false || strpos($dir, 'backup') !== false) {
                continue;
            }

            $subFiles = Storage::files($dir);
            $files = array_merge($files, $subFiles);
        }

        foreach ($files as $file) {
            // Skip global JSON files
            if (strpos($file, 'global-') !== false) {
                continue;
            }

            // Normalize path separators to forward slashes for consistent handling
            $normalizedFile = str_replace('\\', '/', $file);

            // Get filename and directory name for better identification
            $pathParts = explode('/', $normalizedFile);
            $filename = basename($file, '.json');

            // If file is in subdirectory, prefix with directory name
            if (count($pathParts) > 2) {
                $directory = $pathParts[count($pathParts) - 2];
                $pageKey = $directory . '/' . $filename;
            } else {
                $pageKey = $filename;
            }

            $content = json_decode(Storage::get($file), true);

            if ($content) {
                // Get all sections (all top-level keys except some meta keys)
                $excludeKeys = ['page_title', 'page_meta', 'page_description'];
                $sections = [];

                foreach ($content as $key => $value) {
                    if (!in_array($key, $excludeKeys) && is_array($value)) {
                        // Add visible property if not exists
                        if (!isset($value['visible'])) {
                            $sections[$key] = [
                                'visible' => true,
                                'data' => $value
                            ];
                        } else {
                            $sections[$key] = $value;
                        }
                    }
                }

                if (!empty($sections)) {
                    $pages[$pageKey] = [
                        'title' => $content['page_title'] ?? ucfirst(str_replace(['-', '_', '/'], ' ', $pageKey)),
                        'sections' => $sections
                    ];
                }
            }
        }

        return $pages;
    }

    /**
     * Get section images from content
     */
    private function getSectionImages($section)
    {
        $images = [];

        // If section has 'data' key (wrapped format), use that
        $sectionData = isset($section['data']) ? $section['data'] : $section;

        // Recursively find all image paths in section
        array_walk_recursive($sectionData, function($value, $key) use (&$images) {
            if (is_string($value) && (
                strpos($value, '.jpg') !== false ||
                strpos($value, '.jpeg') !== false ||
                strpos($value, '.png') !== false ||
                strpos($value, '.svg') !== false ||
                strpos($value, '.gif') !== false ||
                strpos($value, '.webp') !== false ||
                strpos($value, 'assets/img') !== false ||
                (strpos($key, 'image') !== false && strpos($value, 'http') === false) ||
                (strpos($key, 'icon') !== false && strpos($value, 'http') === false) ||
                (strpos($key, 'avatar') !== false && strpos($value, 'http') === false) ||
                (strpos($key, 'logo') !== false && strpos($value, 'http') === false)
            )) {
                // Avoid duplicates
                if (!in_array($value, $images)) {
                    $images[] = $value;
                }
            }
        });

        return array_slice($images, 0, 12); // Limit to 12 images
    }
}
