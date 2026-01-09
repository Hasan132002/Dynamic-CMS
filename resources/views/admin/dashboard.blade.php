@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: var(--card-shadow);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--hover-shadow);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .stat-icon.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-icon.green { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .stat-icon.orange { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-icon.red { background: linear-gradient(135deg, var(--primary-color) 0%, #ff416c 100%); }

    .stat-content h3 {
        font-size: 28px;
        font-weight: 700;
        color: var(--secondary-color);
        margin: 0;
    }

    .stat-content p {
        font-size: 14px;
        color: #999;
        margin: 5px 0 0 0;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .quick-action-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        color: var(--secondary-color);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .quick-action-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-3px);
        color: var(--primary-color);
    }

    .quick-action-card i {
        font-size: 32px;
        margin-bottom: 10px;
        color: var(--primary-color);
    }

    .quick-action-card h5 {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }

    .recent-table th {
        text-align: left;
        padding: 12px 15px;
        background: var(--light-bg);
        font-weight: 600;
        font-size: 13px;
        color: #666;
        border-radius: 8px;
    }

    .recent-table td {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge.live {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.offline {
        background: #f8d7da;
        color: #721c24;
    }

    .card-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .card-header-custom h4 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: var(--secondary-color);
    }

    .view-all-link {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
    }

    .view-all-link:hover {
        text-decoration: underline;
    }

    .activity-item {
        display: flex;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--light-bg);
        color: var(--primary-color);
    }

    .activity-content h6 {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        color: var(--secondary-color);
    }

    .activity-content p {
        font-size: 12px;
        color: #999;
        margin: 3px 0 0 0;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-tachometer-alt me-3"></i>Dashboard</h1>
        <p>Welcome back! Here's what's happening with your website.</p>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-file-alt"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_pages'] }}</h3>
                <p>Total Pages</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['active_pages'] }}</h3>
                <p>Active Pages</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-bars"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['menu_pages'] }}</h3>
                <p>Menu Items</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-database"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['content_files'] }}</h3>
                <p>Content Files</p>
            </div>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <!-- Recent Pages -->
        <div class="admin-card">
            <div class="card-header-custom">
                <h4><i class="fas fa-clock me-2"></i>Recent Pages</h4>
                <a href="/admin/page-manager" class="view-all-link">View All <i class="fas fa-arrow-right ms-1"></i></a>
            </div>

            <table class="recent-table">
                <thead>
                    <tr>
                        <th>Page Title</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPages as $page)
                    <tr>
                        <td><strong>{{ $page->title }}</strong></td>
                        <td><code>{{ $page->route_uri }}</code></td>
                        <td>
                            @if($page->is_active)
                                <span class="status-badge live"><i class="fas fa-circle me-1"></i>Live</span>
                            @else
                                <span class="status-badge offline"><i class="fas fa-circle me-1"></i>Offline</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($page->updated_at)->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">No pages found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Quick Actions -->
        <div class="admin-card">
            <div class="card-header-custom">
                <h4><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
            </div>

            <div class="quick-actions">
                <a href="/admin/content-manager" class="quick-action-card">
                    <i class="fas fa-edit"></i>
                    <h5>Edit Content</h5>
                </a>

                <a href="/admin/page-manager" class="quick-action-card">
                    <i class="fas fa-file-alt"></i>
                    <h5>Manage Pages</h5>
                </a>

                <a href="/admin/page-manager#menu-tab" class="quick-action-card">
                    <i class="fas fa-bars"></i>
                    <h5>Header Menu</h5>
                </a>

                <a href="/admin/footer-manager" class="quick-action-card">
                    <i class="fas fa-shoe-prints"></i>
                    <h5>Footer Menu</h5>
                </a>

                <a href="/admin/appearance" class="quick-action-card">
                    <i class="fas fa-palette"></i>
                    <h5>Appearance</h5>
                </a>

                <a href="/home" target="_blank" class="quick-action-card">
                    <i class="fas fa-eye"></i>
                    <h5>View Site</h5>
                </a>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="admin-card mt-4">
        <div class="card-header-custom">
            <h4><i class="fas fa-info-circle me-2"></i>System Information</h4>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p><strong>Laravel Version:</strong> {{ app()->version() }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Environment:</strong> {{ app()->environment() }}</p>
            </div>
        </div>
    </div>
@endsection
