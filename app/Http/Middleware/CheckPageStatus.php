<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckPageStatus
{
    public function handle($request, Closure $next)
    {
        $uri = '/' . trim($request->path(), '/');
        if ($uri === '/') $uri = '/home';

        // Skip admin routes
        if (str_starts_with($uri, '/admin')) {
            return $next($request);
        }

        // Check if this is a custom page (Page Builder)
        $slug = trim($request->path(), '/');
        $customPagePath = "content/custom-pages/{$slug}.json";
        if (Storage::exists($customPagePath)) {
            // Let the CustomPageController handle validation
            return $next($request);
        }

        // Check database for regular pages
        $page = DB::table('global_pages')->where('route_uri', $uri)->first();

        if (!$page || !$page->is_active) {
            abort(404);
        }

        return $next($request);
    }
}
