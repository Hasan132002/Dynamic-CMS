<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;

class ActivityLogService
{
    /**
     * Log a page view
     */
    public static function logPageView(string $url, ?string $description = null): ActivityLog
    {
        return self::log([
            'action' => 'page_view',
            'url' => $url,
            'method' => request()->method(),
            'description' => $description ?? "Viewed: {$url}",
        ]);
    }

    /**
     * Log a content edit with revert capability
     */
    public static function logContentEdit(
        string $resourceType,
        string $resourceId,
        array $oldData,
        array $newData,
        ?string $description = null
    ): ActivityLog {
        $changes = self::computeChanges($oldData, $newData);

        return self::log([
            'action' => 'content_edit',
            'resource_type' => $resourceType,
            'resource_id' => $resourceId,
            'old_data' => $oldData,
            'new_data' => $newData,
            'changes' => $changes,
            'description' => $description ?? "Edited {$resourceType}: {$resourceId}",
            'is_revertible' => true,
        ]);
    }

    /**
     * Log theme update
     */
    public static function logThemeUpdate(
        string $themeSlug,
        array $oldData,
        array $newData,
        ?string $description = null
    ): ActivityLog {
        return self::log([
            'action' => 'theme_update',
            'resource_type' => 'theme',
            'resource_id' => $themeSlug,
            'old_data' => $oldData,
            'new_data' => $newData,
            'changes' => self::computeChanges($oldData, $newData),
            'description' => $description ?? "Updated theme: {$themeSlug}",
            'is_revertible' => true,
        ]);
    }

    /**
     * Log theme activation
     */
    public static function logThemeActivate(string $oldTheme, string $newTheme): ActivityLog
    {
        return self::log([
            'action' => 'theme_activate',
            'resource_type' => 'theme',
            'resource_id' => $newTheme,
            'old_data' => ['active_theme' => $oldTheme],
            'new_data' => ['active_theme' => $newTheme],
            'description' => "Activated theme: {$newTheme} (was: {$oldTheme})",
            'is_revertible' => true,
        ]);
    }

    /**
     * Log setting update
     */
    public static function logSettingUpdate(
        string $settingType,
        array $oldData,
        array $newData,
        ?string $description = null
    ): ActivityLog {
        return self::log([
            'action' => 'setting_update',
            'resource_type' => 'setting',
            'resource_id' => $settingType,
            'old_data' => $oldData,
            'new_data' => $newData,
            'changes' => self::computeChanges($oldData, $newData),
            'description' => $description ?? "Updated setting: {$settingType}",
            'is_revertible' => true,
        ]);
    }

    /**
     * Log SEO update
     */
    public static function logSeoUpdate(array $oldData, array $newData): ActivityLog
    {
        return self::log([
            'action' => 'seo_update',
            'resource_type' => 'seo',
            'resource_id' => 'global',
            'old_data' => $oldData,
            'new_data' => $newData,
            'changes' => self::computeChanges($oldData, $newData),
            'description' => 'Updated SEO settings',
            'is_revertible' => true,
        ]);
    }

    /**
     * Log menu update
     */
    public static function logMenuUpdate(
        string $menuType,
        array $oldData,
        array $newData
    ): ActivityLog {
        return self::log([
            'action' => 'menu_update',
            'resource_type' => 'menu',
            'resource_id' => $menuType,
            'old_data' => $oldData,
            'new_data' => $newData,
            'description' => "Updated menu: {$menuType}",
            'is_revertible' => true,
        ]);
    }

    /**
     * Log cache clear
     */
    public static function logCacheClear(): ActivityLog
    {
        return self::log([
            'action' => 'cache_clear',
            'description' => 'Cleared application cache',
            'is_revertible' => false,
        ]);
    }

    /**
     * Log a revert action
     */
    public static function logRevert(ActivityLog $originalLog): ActivityLog
    {
        return self::log([
            'action' => 'revert',
            'resource_type' => $originalLog->resource_type,
            'resource_id' => $originalLog->resource_id,
            'old_data' => $originalLog->new_data,
            'new_data' => $originalLog->old_data,
            'description' => "Reverted: {$originalLog->description}",
            'is_revertible' => false,
        ]);
    }

    /**
     * Create log entry
     */
    protected static function log(array $data): ActivityLog
    {
        return ActivityLog::create(array_merge($data, [
            'url' => $data['url'] ?? request()->fullUrl(),
            'method' => $data['method'] ?? request()->method(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id(),
        ]));
    }

    /**
     * Compute changes between old and new data
     */
    protected static function computeChanges(array $oldData, array $newData): array
    {
        $changes = [];

        // Find changed and new keys
        foreach ($newData as $key => $newValue) {
            $oldValue = $oldData[$key] ?? null;
            if ($oldValue !== $newValue) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => $newValue,
                ];
            }
        }

        // Find removed keys
        foreach ($oldData as $key => $oldValue) {
            if (!array_key_exists($key, $newData)) {
                $changes[$key] = [
                    'old' => $oldValue,
                    'new' => null,
                ];
            }
        }

        return $changes;
    }

    /**
     * Revert a log entry
     */
    public static function revert(int $logId): bool
    {
        $log = ActivityLog::find($logId);

        if (!$log || !$log->is_revertible || $log->is_reverted) {
            return false;
        }

        $success = false;

        switch ($log->resource_type) {
            case 'theme':
                $success = self::revertThemeChange($log);
                break;
            case 'setting':
                $success = self::revertSettingChange($log);
                break;
            case 'seo':
                $success = self::revertSeoChange($log);
                break;
            case 'page':
            case 'content':
                $success = self::revertContentChange($log);
                break;
            case 'menu':
                $success = self::revertMenuChange($log);
                break;
        }

        if ($success) {
            $log->update(['is_reverted' => true]);
            $revertLog = self::logRevert($log);
            $log->update(['reverted_by_log_id' => $revertLog->id]);
        }

        return $success;
    }

    /**
     * Revert theme change
     */
    protected static function revertThemeChange(ActivityLog $log): bool
    {
        if ($log->action === 'theme_activate') {
            // Revert theme activation
            $oldTheme = $log->old_data['active_theme'] ?? null;
            if ($oldTheme) {
                $settingsPath = storage_path('app/content/global-json/settings.json');
                $settings = json_decode(file_get_contents($settingsPath), true) ?? [];
                $settings['active_theme'] = $oldTheme;
                return file_put_contents($settingsPath, json_encode($settings, JSON_PRETTY_PRINT)) !== false;
            }
        } else {
            // Revert theme settings
            $themeSlug = $log->resource_id;
            $oldData = $log->old_data;

            if ($themeSlug && $oldData) {
                // Revert theme.json
                if (isset($oldData['theme'])) {
                    $themePath = storage_path("app/content/themes/{$themeSlug}/theme.json");
                    file_put_contents($themePath, json_encode($oldData['theme'], JSON_PRETTY_PRINT));
                }
                // Revert assets.json
                if (isset($oldData['assets'])) {
                    $assetsPath = storage_path("app/content/themes/{$themeSlug}/assets.json");
                    file_put_contents($assetsPath, json_encode($oldData['assets'], JSON_PRETTY_PRINT));
                }
                return true;
            }
        }

        return false;
    }

    /**
     * Revert setting change
     */
    protected static function revertSettingChange(ActivityLog $log): bool
    {
        $settingType = $log->resource_id;
        $oldData = $log->old_data;

        if ($settingType && $oldData) {
            $path = storage_path("app/content/global-json/{$settingType}.json");
            if (file_exists(dirname($path))) {
                return file_put_contents($path, json_encode($oldData, JSON_PRETTY_PRINT)) !== false;
            }
        }

        return false;
    }

    /**
     * Revert SEO change
     */
    protected static function revertSeoChange(ActivityLog $log): bool
    {
        $oldData = $log->old_data;

        if ($oldData) {
            $path = storage_path('app/content/global-json/seo.json');
            return file_put_contents($path, json_encode($oldData, JSON_PRETTY_PRINT)) !== false;
        }

        return false;
    }

    /**
     * Revert content/page change
     */
    protected static function revertContentChange(ActivityLog $log): bool
    {
        $resourceId = $log->resource_id;
        $oldData = $log->old_data;

        if ($resourceId && $oldData) {
            // Try multiple path patterns
            $paths = [
                storage_path("app/content/pages/{$resourceId}.json"),
                storage_path("app/content/{$resourceId}.json"),
            ];

            foreach ($paths as $path) {
                if (file_exists($path)) {
                    return file_put_contents($path, json_encode($oldData, JSON_PRETTY_PRINT)) !== false;
                }
            }
        }

        return false;
    }

    /**
     * Revert menu change
     */
    protected static function revertMenuChange(ActivityLog $log): bool
    {
        $oldData = $log->old_data;

        if ($oldData) {
            $path = storage_path('app/content/global-json/global-navigation.json');
            return file_put_contents($path, json_encode($oldData, JSON_PRETTY_PRINT)) !== false;
        }

        return false;
    }

    /**
     * Get recent activity for dashboard
     */
    public static function getRecentActivity(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return ActivityLog::latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent edits (excluding page views)
     */
    public static function getRecentEdits(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return ActivityLog::editsOnly()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get last revertible action
     */
    public static function getLastRevertible(): ?ActivityLog
    {
        return ActivityLog::revertible()
            ->latest()
            ->first();
    }
}
