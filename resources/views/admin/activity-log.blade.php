@extends('admin.layouts.app')

@section('title', 'Activity Log')

@section('styles')
<style>
    .log-filters {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 1px solid var(--border-color);
        background: var(--white);
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.15s ease;
        text-decoration: none;
        color: var(--text-color);
    }

    .filter-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .filter-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-left: auto;
    }

    .btn-cache {
        background: var(--info-color);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }

    .btn-cache:hover {
        background: var(--primary-dark);
    }

    .btn-revert-last {
        background: var(--warning-color);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }

    .btn-revert-last:hover {
        background: #c49000;
    }

    .log-table {
        width: 100%;
        border-collapse: collapse;
    }

    .log-table th,
    .log-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid var(--border-light);
    }

    .log-table th {
        background: var(--light-bg);
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-light);
    }

    .log-table tbody tr:hover {
        background: var(--light-bg);
    }

    .action-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
    }

    .action-badge.info {
        background: #e3f2fd;
        color: #1565c0;
    }

    .action-badge.warning {
        background: #fff3e0;
        color: #e65100;
    }

    .action-badge.success {
        background: var(--success-light);
        color: var(--success-color);
    }

    .action-badge.danger {
        background: var(--danger-light);
        color: var(--danger-color);
    }

    .action-badge.primary {
        background: #fce4ec;
        color: var(--primary-color);
    }

    .action-badge.secondary {
        background: #eceff1;
        color: #546e7a;
    }

    .log-description {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .log-time {
        font-size: 12px;
        color: var(--text-light);
    }

    .log-url {
        font-family: monospace;
        font-size: 11px;
        color: var(--text-light);
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .btn-revert {
        padding: 4px 10px;
        background: var(--warning-light);
        color: var(--warning-color);
        border: 1px solid var(--warning-color);
        border-radius: 4px;
        cursor: pointer;
        font-size: 11px;
        transition: all 0.15s ease;
    }

    .btn-revert:hover {
        background: var(--warning-color);
        color: white;
    }

    .btn-revert:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-view {
        padding: 4px 10px;
        background: var(--light-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
        border-radius: 4px;
        cursor: pointer;
        font-size: 11px;
        transition: all 0.15s ease;
    }

    .btn-view:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .reverted-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 6px;
        background: #eceff1;
        color: #546e7a;
        border-radius: 3px;
        font-size: 10px;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-light);
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 15px;
        color: var(--border-color);
    }

    .migration-notice {
        background: var(--warning-light);
        border: 1px solid var(--warning-color);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .migration-notice h4 {
        color: var(--warning-color);
        margin: 0 0 10px;
    }

    .migration-notice code {
        background: rgba(0,0,0,0.1);
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 13px;
    }

    /* Modal Styles */
    .log-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 2000;
        align-items: center;
        justify-content: center;
    }

    .log-modal.active {
        display: flex;
    }

    .log-modal-content {
        background: white;
        border-radius: 12px;
        max-width: 700px;
        width: 90%;
        max-height: 80vh;
        overflow: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .log-modal-header {
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .log-modal-header h3 {
        margin: 0;
        font-size: 18px;
    }

    .log-modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-light);
    }

    .log-modal-body {
        padding: 20px;
    }

    .log-detail-row {
        display: flex;
        margin-bottom: 15px;
    }

    .log-detail-label {
        width: 120px;
        font-weight: 600;
        color: var(--text-light);
        flex-shrink: 0;
    }

    .log-detail-value {
        flex: 1;
        word-break: break-all;
    }

    .json-display {
        background: var(--light-bg);
        border-radius: 6px;
        padding: 10px;
        font-family: monospace;
        font-size: 12px;
        max-height: 200px;
        overflow: auto;
        white-space: pre-wrap;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .log-filters {
            flex-direction: column;
            align-items: stretch;
        }

        .action-buttons {
            margin-left: 0;
            flex-direction: column;
        }

        .table-card {
            overflow-x: auto;
        }

        .log-table {
            min-width: 700px;
        }

        .log-modal-content {
            margin: 10px;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-history me-3"></i>Activity Log</h1>
        <p>Track all admin actions and changes</p>
    </div>

    @if(!$tableExists)
    <div class="migration-notice">
        <h4><i class="fas fa-exclamation-triangle me-2"></i>Database Migration Required</h4>
        <p>The activity log table has not been created yet. Please run the migration:</p>
        <code>php artisan migrate</code>
    </div>
    @else

    <div class="log-filters">
        <a href="/admin/activity-log" class="filter-btn {{ $filter === 'all' ? 'active' : '' }}">
            <i class="fas fa-list me-1"></i> All Activity
        </a>
        <a href="/admin/activity-log?filter=edits" class="filter-btn {{ $filter === 'edits' ? 'active' : '' }}">
            <i class="fas fa-edit me-1"></i> Edits Only
        </a>
        <a href="/admin/activity-log?filter=views" class="filter-btn {{ $filter === 'views' ? 'active' : '' }}">
            <i class="fas fa-eye me-1"></i> Page Views
        </a>
        <a href="/admin/activity-log?filter=revertible" class="filter-btn {{ $filter === 'revertible' ? 'active' : '' }}">
            <i class="fas fa-undo me-1"></i> Revertible
        </a>

        <div class="action-buttons">
            <form action="/admin/cache/clear" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-cache" onclick="return confirm('Clear all application cache?')">
                    <i class="fas fa-broom"></i> Clear Cache
                </button>
            </form>
            <form action="/admin/activity-log/revert-last" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-revert-last" onclick="return confirm('Revert the last revertible action?')">
                    <i class="fas fa-undo"></i> Undo Last Change
                </button>
            </form>
        </div>
    </div>

    <div class="table-card">
        @if($logs->isEmpty())
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h4>No Activity Yet</h4>
                <p>Activity will appear here as you use the admin panel.</p>
            </div>
        @else
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Description</th>
                        <th>URL</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>
                            <span class="action-badge {{ $log->action_color }}">
                                <i class="fas {{ $log->action_icon }}"></i>
                                {{ $log->action_label }}
                            </span>
                            @if($log->is_reverted)
                                <span class="reverted-badge">
                                    <i class="fas fa-check"></i> Reverted
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="log-description" title="{{ $log->description }}">
                                {{ $log->description ?? '-' }}
                            </div>
                        </td>
                        <td>
                            <div class="log-url" title="{{ $log->url }}">
                                {{ $log->url ? parse_url($log->url, PHP_URL_PATH) : '-' }}
                            </div>
                        </td>
                        <td>
                            <div class="log-time">
                                {{ $log->created_at->diffForHumans() }}
                                <br>
                                <small>{{ $log->created_at->format('M d, H:i') }}</small>
                            </div>
                        </td>
                        <td>
                            <button class="btn-view" onclick="viewLog({{ $log->id }})">
                                <i class="fas fa-eye"></i> View
                            </button>
                            @if($log->is_revertible && !$log->is_reverted)
                                <form action="/admin/activity-log/{{ $log->id }}/revert" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn-revert" onclick="return confirm('Revert this action?')">
                                        <i class="fas fa-undo"></i> Revert
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-3">
                {{ $logs->appends(['filter' => $filter])->links() }}
            </div>
        @endif
    </div>
    @endif

    <!-- Log Detail Modal -->
    <div class="log-modal" id="logModal">
        <div class="log-modal-content">
            <div class="log-modal-header">
                <h3><i class="fas fa-info-circle me-2"></i>Activity Details</h3>
                <button class="log-modal-close" onclick="closeLogModal()">&times;</button>
            </div>
            <div class="log-modal-body" id="logModalBody">
                Loading...
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function viewLog(id) {
    document.getElementById('logModal').classList.add('active');
    document.getElementById('logModalBody').innerHTML = '<div class="text-center p-4"><i class="fas fa-spinner fa-spin fa-2x"></i></div>';

    fetch('/admin/activity-log/' + id)
        .then(response => response.json())
        .then(data => {
            let html = `
                <div class="log-detail-row">
                    <div class="log-detail-label">Action:</div>
                    <div class="log-detail-value"><span class="action-badge ${getColorClass(data.action)}">${data.action_label}</span></div>
                </div>
                <div class="log-detail-row">
                    <div class="log-detail-label">Description:</div>
                    <div class="log-detail-value">${data.description || '-'}</div>
                </div>
                <div class="log-detail-row">
                    <div class="log-detail-label">URL:</div>
                    <div class="log-detail-value">${data.url || '-'}</div>
                </div>
                <div class="log-detail-row">
                    <div class="log-detail-label">Method:</div>
                    <div class="log-detail-value">${data.method}</div>
                </div>
                <div class="log-detail-row">
                    <div class="log-detail-label">Resource:</div>
                    <div class="log-detail-value">${data.resource_type ? data.resource_type + ' / ' + data.resource_id : '-'}</div>
                </div>
                <div class="log-detail-row">
                    <div class="log-detail-label">IP Address:</div>
                    <div class="log-detail-value">${data.ip_address || '-'}</div>
                </div>
                <div class="log-detail-row">
                    <div class="log-detail-label">Time:</div>
                    <div class="log-detail-value">${data.created_at}</div>
                </div>
            `;

            if (data.changes && Object.keys(data.changes).length > 0) {
                html += `
                    <div class="log-detail-row">
                        <div class="log-detail-label">Changes:</div>
                        <div class="log-detail-value">
                            <div class="json-display">${JSON.stringify(data.changes, null, 2)}</div>
                        </div>
                    </div>
                `;
            }

            if (data.old_data) {
                html += `
                    <div class="log-detail-row">
                        <div class="log-detail-label">Old Data:</div>
                        <div class="log-detail-value">
                            <div class="json-display">${JSON.stringify(data.old_data, null, 2)}</div>
                        </div>
                    </div>
                `;
            }

            if (data.new_data) {
                html += `
                    <div class="log-detail-row">
                        <div class="log-detail-label">New Data:</div>
                        <div class="log-detail-value">
                            <div class="json-display">${JSON.stringify(data.new_data, null, 2)}</div>
                        </div>
                    </div>
                `;
            }

            document.getElementById('logModalBody').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('logModalBody').innerHTML = '<div class="text-center text-danger p-4">Failed to load details</div>';
        });
}

function getColorClass(action) {
    const colors = {
        'page_view': 'info',
        'content_edit': 'warning',
        'content_create': 'success',
        'content_delete': 'danger',
        'theme_update': 'primary',
        'theme_activate': 'primary',
        'setting_update': 'warning',
        'seo_update': 'info',
        'cache_clear': 'success',
        'revert': 'secondary'
    };
    return colors[action] || 'secondary';
}

function closeLogModal() {
    document.getElementById('logModal').classList.remove('active');
}

// Close modal on outside click
document.getElementById('logModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLogModal();
    }
});

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLogModal();
    }
});
</script>
@endsection
