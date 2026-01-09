<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'action',
        'url',
        'method',
        'resource_type',
        'resource_id',
        'description',
        'old_data',
        'new_data',
        'changes',
        'ip_address',
        'user_agent',
        'user_id',
        'is_revertible',
        'is_reverted',
        'reverted_by_log_id',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
        'changes' => 'array',
        'is_revertible' => 'boolean',
        'is_reverted' => 'boolean',
    ];

    /**
     * Get action display name
     */
    public function getActionLabelAttribute(): string
    {
        $labels = [
            'page_view' => 'Page View',
            'content_edit' => 'Content Edit',
            'content_create' => 'Content Create',
            'content_delete' => 'Content Delete',
            'theme_update' => 'Theme Update',
            'theme_activate' => 'Theme Activated',
            'setting_update' => 'Setting Update',
            'seo_update' => 'SEO Update',
            'logo_upload' => 'Logo Upload',
            'media_upload' => 'Media Upload',
            'media_delete' => 'Media Delete',
            'menu_update' => 'Menu Update',
            'cache_clear' => 'Cache Cleared',
            'revert' => 'Reverted Change',
        ];

        return $labels[$this->action] ?? ucwords(str_replace('_', ' ', $this->action));
    }

    /**
     * Get action icon
     */
    public function getActionIconAttribute(): string
    {
        $icons = [
            'page_view' => 'fa-eye',
            'content_edit' => 'fa-edit',
            'content_create' => 'fa-plus',
            'content_delete' => 'fa-trash',
            'theme_update' => 'fa-palette',
            'theme_activate' => 'fa-swatchbook',
            'setting_update' => 'fa-cog',
            'seo_update' => 'fa-search',
            'logo_upload' => 'fa-image',
            'media_upload' => 'fa-upload',
            'media_delete' => 'fa-trash-alt',
            'menu_update' => 'fa-bars',
            'cache_clear' => 'fa-broom',
            'revert' => 'fa-undo',
        ];

        return $icons[$this->action] ?? 'fa-circle';
    }

    /**
     * Get action color class
     */
    public function getActionColorAttribute(): string
    {
        $colors = [
            'page_view' => 'info',
            'content_edit' => 'warning',
            'content_create' => 'success',
            'content_delete' => 'danger',
            'theme_update' => 'primary',
            'theme_activate' => 'primary',
            'setting_update' => 'warning',
            'seo_update' => 'info',
            'logo_upload' => 'success',
            'media_upload' => 'success',
            'media_delete' => 'danger',
            'menu_update' => 'warning',
            'cache_clear' => 'success',
            'revert' => 'secondary',
        ];

        return $colors[$this->action] ?? 'secondary';
    }

    /**
     * Scope for revertible logs
     */
    public function scopeRevertible($query)
    {
        return $query->where('is_revertible', true)->where('is_reverted', false);
    }

    /**
     * Scope for recent activity
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope by action type
     */
    public function scopeByAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope edits only (excluding page views)
     */
    public function scopeEditsOnly($query)
    {
        return $query->where('action', '!=', 'page_view');
    }
}
