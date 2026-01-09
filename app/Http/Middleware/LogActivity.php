<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Schema;

class LogActivity
{
    /**
     * URLs to exclude from logging
     */
    protected array $excludedPaths = [
        '_debugbar/*',
        'livewire/*',
        'favicon.ico',
        'assets/*',
        'storage/*',
        'css/*',
        'js/*',
        'images/*',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only log if table exists (migration has run)
        if (!$this->shouldLog($request)) {
            return $response;
        }

        try {
            // Check if table exists
            if (!Schema::hasTable('activity_logs')) {
                return $response;
            }

            $url = $request->path();
            $method = $request->method();

            // Only log GET requests as page views (admin pages only)
            if ($method === 'GET' && str_starts_with($url, 'admin')) {
                ActivityLogService::logPageView(
                    $request->fullUrl(),
                    "Admin page: {$url}"
                );
            }
        } catch (\Exception $e) {
            // Silently fail - don't break the app if logging fails
            report($e);
        }

        return $response;
    }

    /**
     * Check if request should be logged
     */
    protected function shouldLog(Request $request): bool
    {
        $path = $request->path();

        // Check excluded paths
        foreach ($this->excludedPaths as $excludedPath) {
            if (str_contains($excludedPath, '*')) {
                $pattern = str_replace('*', '.*', $excludedPath);
                if (preg_match("#^{$pattern}$#", $path)) {
                    return false;
                }
            } elseif ($path === $excludedPath) {
                return false;
            }
        }

        // Only log admin requests
        if (!str_starts_with($path, 'admin')) {
            return false;
        }

        // Skip AJAX requests for now
        if ($request->ajax() && $request->method() === 'GET') {
            return false;
        }

        return true;
    }
}
