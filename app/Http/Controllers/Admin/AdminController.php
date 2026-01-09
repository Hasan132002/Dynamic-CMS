<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Get stats for dashboard
        $stats = [
            'total_pages' => DB::table('global_pages')->count(),
            'active_pages' => DB::table('global_pages')->where('is_active', 1)->count(),
            'menu_pages' => DB::table('global_pages')->where('in_menu', 1)->count(),
            'content_files' => $this->countContentFiles(),
        ];

        // Get recent pages
        $recentPages = DB::table('global_pages')
            ->orderBy('updated_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPages'));
    }

    private function countContentFiles()
    {
        $path = storage_path('app/content');
        if (!File::isDirectory($path)) {
            return 0;
        }

        $count = 0;
        $files = File::allFiles($path);
        foreach ($files as $file) {
            if ($file->getExtension() === 'json') {
                $count++;
            }
        }
        return $count;
    }
}
