<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterManagerController extends Controller
{
    public function index()
    {
        $pages = \DB::table('global_pages')
            ->orderBy('menu_order')
            ->get();

        return view('admin.footer-manager', compact('pages'));
    }

    public function getMenus()
    {
        $navFilePath = storage_path('app/content/global-json/global-navigation.json');

        if (file_exists($navFilePath)) {
            $navigation = json_decode(file_get_contents($navFilePath), true);
            $footer = $navigation['footer'] ?? [];

            return response()->json([
                'success' => true,
                'menus' => [
                    'navigate' => $footer['navigate'] ?? ['title' => 'Navigate', 'links' => []],
                    'courses' => $footer['courses'] ?? ['title' => 'Courses', 'links' => []],
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'menus' => [
                'navigate' => ['title' => 'Navigate', 'links' => []],
                'courses' => ['title' => 'Courses', 'links' => []],
            ]
        ]);
    }

    public function saveMenus(Request $request)
    {
        $validated = $request->validate([
            'navigate' => 'required|array',
            'courses' => 'required|array',
        ]);

        $navFilePath = storage_path('app/content/global-json/global-navigation.json');

        // Read existing navigation
        if (file_exists($navFilePath)) {
            $navigation = json_decode(file_get_contents($navFilePath), true);
        } else {
            $navigation = [];
        }

        // Ensure footer structure exists
        if (!isset($navigation['footer'])) {
            $navigation['footer'] = [];
        }

        // Update footer menus
        $navigation['footer']['navigate'] = [
            'title' => $validated['navigate']['title'] ?? 'Navigate',
            'links' => $validated['navigate']['links'] ?? []
        ];

        $navigation['footer']['courses'] = [
            'title' => $validated['courses']['title'] ?? 'Courses',
            'links' => $validated['courses']['links'] ?? []
        ];

        // Save back to file
        file_put_contents(
            $navFilePath,
            json_encode($navigation, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );

        return response()->json([
            'success' => true,
            'message' => 'Footer menus saved successfully'
        ]);
    }
}
