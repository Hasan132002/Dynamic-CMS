<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class NavigationResolver
{
     public static function resolve(array $navigation): array
    {
        foreach (['menu', 'menu_left', 'menu_right'] as $key) {
            if (!empty($navigation['header'][$key])) {
                $navigation['header'][$key] =
                    self::buildTree($navigation['header'][$key]);
            }
        }

        return $navigation;
    }

    private static function buildTree(array $items): array
    {
        $filtered = [];

        foreach ($items as $item) {

            if (!self::isAllowed($item['url'] ?? null)) {
                continue;
            }

            // Mega menu
            if (!empty($item['mega']) && !empty($item['columns'])) {
                $cols = [];
                foreach ($item['columns'] as $col) {
                    $links = self::buildTree($col['links'] ?? []);
                    if ($links) {
                        $cols[] = [
                            'title' => $col['title'],
                            'links' => $links,
                        ];
                    }
                }
                if ($cols) {
                    $item['columns'] = $cols;
                    $filtered[] = $item;
                }
                continue;
            }

            // Children
            if (!empty($item['children'])) {
                $item['children'] = self::buildTree($item['children']);
            }

            $filtered[] = $item;
        }

        return $filtered;
    }

    private static function isAllowed(?string $url): bool
    {
        if (!$url || !str_starts_with($url, '/')) return true;

        $page = DB::table('global_pages')->where('route_uri', $url)->first();
        return $page && $page->in_menu && $page->is_active;
    }

    private static function filterItems(array $items): array
    {
        $result = [];

        foreach ($items as $item) {

            // Mega menu
            if (!empty($item['mega']) && !empty($item['columns'])) {
                $columns = [];

                foreach ($item['columns'] as $column) {
                    $links = self::filterItems($column['links'] ?? []);
                    if (!empty($links)) {
                        $columns[] = [
                            'title' => $column['title'] ?? '',
                            'links' => $links,
                        ];
                    }
                }

                if (!empty($columns)) {
                    $item['columns'] = $columns;
                    $result[] = $item;
                }

                continue;
            }

            // Normal menu item
            if (!self::isAllowed($item['url'] ?? null)) {
                continue;
            }

            // Children
            if (!empty($item['children'])) {
                $item['children'] = self::filterItems($item['children']);
            }

            $result[] = $item;
        }

        return $result;
    }


}
