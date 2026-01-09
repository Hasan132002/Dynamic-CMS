<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class ActivityLogController extends Controller
{
    /**
     * Display activity log list
     */
    public function index(Request $request)
    {
        // Check if table exists
        if (!Schema::hasTable('activity_logs')) {
            return view('admin.activity-log', [
                'logs' => collect(),
                'tableExists' => false,
                'filter' => 'all',
            ]);
        }

        $filter = $request->get('filter', 'all');
        $query = ActivityLog::latest();

        switch ($filter) {
            case 'edits':
                $query->editsOnly();
                break;
            case 'views':
                $query->byAction('page_view');
                break;
            case 'revertible':
                $query->revertible();
                break;
        }

        $logs = $query->paginate(50);

        return view('admin.activity-log', [
            'logs' => $logs,
            'tableExists' => true,
            'filter' => $filter,
        ]);
    }

    /**
     * Revert a specific action
     */
    public function revert(Request $request, $id)
    {
        $log = ActivityLog::findOrFail($id);

        if (!$log->is_revertible || $log->is_reverted) {
            return back()->with('error', 'This action cannot be reverted.');
        }

        $success = ActivityLogService::revert($id);

        if ($success) {
            return back()->with('success', 'Action reverted successfully!');
        }

        return back()->with('error', 'Failed to revert action. Please try manually.');
    }

    /**
     * Revert the last revertible action
     */
    public function revertLast()
    {
        $lastRevertible = ActivityLogService::getLastRevertible();

        if (!$lastRevertible) {
            return back()->with('error', 'No revertible actions found.');
        }

        $success = ActivityLogService::revert($lastRevertible->id);

        if ($success) {
            return back()->with('success', "Reverted: {$lastRevertible->description}");
        }

        return back()->with('error', 'Failed to revert action. Please try manually.');
    }

    /**
     * Clear application cache
     */
    public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');

            // Log the cache clear
            if (Schema::hasTable('activity_logs')) {
                ActivityLogService::logCacheClear();
            }

            return back()->with('success', 'All caches cleared successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to clear cache: ' . $e->getMessage());
        }
    }

    /**
     * View log details
     */
    public function show($id)
    {
        $log = ActivityLog::findOrFail($id);

        return response()->json([
            'id' => $log->id,
            'action' => $log->action,
            'action_label' => $log->action_label,
            'description' => $log->description,
            'url' => $log->url,
            'method' => $log->method,
            'resource_type' => $log->resource_type,
            'resource_id' => $log->resource_id,
            'old_data' => $log->old_data,
            'new_data' => $log->new_data,
            'changes' => $log->changes,
            'ip_address' => $log->ip_address,
            'user_agent' => $log->user_agent,
            'is_revertible' => $log->is_revertible,
            'is_reverted' => $log->is_reverted,
            'created_at' => $log->created_at->format('M d, Y H:i:s'),
        ]);
    }

    /**
     * Delete old logs
     */
    public function cleanup(Request $request)
    {
        $days = $request->get('days', 30);

        $deleted = ActivityLog::where('created_at', '<', now()->subDays($days))->delete();

        return back()->with('success', "Deleted {$deleted} logs older than {$days} days.");
    }
}
