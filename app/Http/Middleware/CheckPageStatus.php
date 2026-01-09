<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckPageStatus
{
    public function handle($request, Closure $next)
{
    $uri = '/' . trim($request->path(), '/');
    if ($uri === '/') $uri = '/home';

    if (str_starts_with($uri, '/admin')) {
        return $next($request);
    }

    $page = DB::table('global_pages')->where('route_uri', $uri)->first();

    if (!$page || !$page->is_active) {
        abort(404);
    }

    return $next($request);
}

}
