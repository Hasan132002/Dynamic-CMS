<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageManagerController extends Controller
{
    public function index()
    {
        $pages = DB::table('global_pages')
            ->orderBy('menu_order')
            ->get();

        return view('admin.page-manager', compact('pages'));
    }

    public function save(Request $request)
    {
        $submittedPages = $request->input('pages', []);

        // Get all page IDs from the database
        $allPageIds = DB::table('global_pages')->pluck('id');

        $updateCount = 0;

        // Update all pages
        foreach ($allPageIds as $pageId) {
            // If page exists in submitted data, use those values
            // Otherwise, both checkboxes are unchecked (not submitted)
            $data = $submittedPages[$pageId] ?? [];

            $inMenu = isset($data['in_menu']) ? 1 : 0;
            $isActive = isset($data['is_active']) ? 1 : 0;

            DB::table('global_pages')
                ->where('id', $pageId)
                ->update([
                    'in_menu'   => $inMenu,
                    'is_active' => $isActive,
                    'updated_at' => now(),
                ]);

            $updateCount++;
        }

        return redirect()->back()->with('success', "Pages updated successfully! ({$updateCount} pages processed)");
    }

    public function getMenu()
    {
        $navFilePath = storage_path('app/content/global-json/global-navigation.json');

        if (file_exists($navFilePath)) {
            $navigation = json_decode(file_get_contents($navFilePath), true);
            $menu = $navigation['header']['menu'] ?? [];

            return response()->json([
                'success' => true,
                'menu' => $menu
            ]);
        }

        return response()->json([
            'success' => false,
            'menu' => []
        ]);
    }

    public function saveMenu(Request $request)
    {
        try {
            $validated = $request->validate([
                'menu' => 'required|array',
            ]);

            $menuData = $validated['menu'];

            // Save to navigation JSON file
            $navFilePath = storage_path('app/content/global-json/global-navigation.json');

            // Read existing navigation
            if (file_exists($navFilePath)) {
                $navigation = json_decode(file_get_contents($navFilePath), true);
                if ($navigation === null) {
                    $navigation = ['header' => ['menu' => []]];
                }
            } else {
                $navigation = ['header' => ['menu' => []]];
            }

            // Ensure header key exists
            if (!isset($navigation['header'])) {
                $navigation['header'] = ['menu' => []];
            }

            // Update header menu with new structure
            $formattedMenu = $this->formatMenuForNavigation($menuData);
            $navigation['header']['menu'] = $formattedMenu;

            // Save back to file
            $result = file_put_contents(
                $navFilePath,
                json_encode($navigation, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
            );

            if ($result === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to write to file'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Menu saved successfully'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function formatMenuForNavigation($menuItems)
    {
        $formatted = [];

        foreach ($menuItems as $item) {
            $navItem = [
                'label' => $item['title'],
                'url' => $item['url'],
            ];

            // Add children if they exist
            if (!empty($item['children'])) {
                $navItem['children'] = $this->formatMenuForNavigation($item['children']);
            }

            $formatted[] = $navItem;
        }

        return $formatted;
    }
}
