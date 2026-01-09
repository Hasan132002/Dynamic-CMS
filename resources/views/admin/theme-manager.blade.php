@extends('admin.layouts.app')

@section('title', 'Theme Manager')

@section('styles')
<style>
    /* Theme Manager Specific Styles */

    /* Theme Cards Grid */
    .themes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-top: 24px;
    }

    /* Theme Card */
    .theme-card {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 2px solid var(--border-light);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
    }

    .theme-card:hover {
        border-color: var(--primary-light);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .theme-card.active {
        border-color: var(--success-color);
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.15);
    }

    /* Theme Preview */
    .theme-preview {
        height: 180px;
        background: linear-gradient(135deg, var(--light-bg) 0%, var(--border-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .theme-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .theme-preview-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        color: var(--text-light);
    }

    .theme-preview-placeholder i {
        font-size: 48px;
        opacity: 0.3;
    }

    .theme-preview-placeholder span {
        font-size: 13px;
    }

    /* Active Badge */
    .theme-active-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--success-color);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }

    .theme-active-badge i {
        font-size: 10px;
    }

    /* System Badge */
    .theme-system-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--secondary-color);
        color: white;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 10px;
        font-weight: 500;
    }

    /* Theme Info */
    .theme-info {
        padding: 20px;
    }

    .theme-name {
        font-size: 18px;
        font-weight: 600;
        color: var(--heading-color);
        margin-bottom: 5px;
    }

    .theme-description {
        font-size: 13px;
        color: var(--text-light);
        margin-bottom: 12px;
        line-height: 1.5;
        min-height: 40px;
    }

    .theme-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .theme-meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: var(--text-light);
    }

    .theme-meta-item i {
        font-size: 11px;
        color: var(--primary-color);
    }

    /* Theme Actions */
    .theme-actions {
        display: flex;
        gap: 10px;
        padding-top: 15px;
        border-top: 1px solid var(--border-light);
    }

    .theme-btn {
        flex: 1;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }

    .theme-btn-activate {
        background: var(--primary-color);
        color: white;
        border: 1px solid var(--primary-dark);
    }

    .theme-btn-activate:hover {
        background: var(--primary-dark);
        color: white;
    }

    .theme-btn-active {
        background: var(--success-light);
        color: var(--success-color);
        border: 1px solid var(--success-color);
        cursor: default;
    }

    .theme-btn-edit {
        background: var(--white);
        color: var(--heading-color);
        border: 1px solid var(--border-color);
    }

    .theme-btn-edit:hover {
        background: var(--light-bg);
        color: var(--heading-color);
        border-color: var(--primary-light);
    }

    .theme-btn-delete {
        background: var(--white);
        color: var(--danger-color);
        border: 1px solid var(--danger-color);
        flex: 0 0 auto;
        padding: 10px 12px;
    }

    .theme-btn-delete:hover {
        background: var(--danger-color);
        color: white;
    }

    /* Add Theme Card */
    .add-theme-card {
        background: var(--light-bg);
        border: 2px dashed var(--border-color);
        border-radius: var(--card-radius);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 340px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--text-light);
    }

    .add-theme-card:hover {
        border-color: var(--primary-color);
        background: var(--info-light);
        color: var(--primary-color);
    }

    .add-theme-card i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .add-theme-card:hover i {
        opacity: 1;
    }

    .add-theme-card span {
        font-size: 16px;
        font-weight: 500;
    }

    /* Stats Cards */
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--white);
        border-radius: var(--card-radius);
        padding: 20px;
        border: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-icon.primary {
        background: var(--info-light);
        color: var(--primary-color);
    }

    .stat-icon.success {
        background: var(--success-light);
        color: var(--success-color);
    }

    .stat-icon.warning {
        background: #fff3cd;
        color: var(--warning-color);
    }

    .stat-content h3 {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: var(--heading-color);
    }

    .stat-content p {
        font-size: 13px;
        color: var(--text-light);
        margin: 0;
    }

    /* Alert Messages */
    .alert-custom {
        border-radius: var(--card-radius);
        border: none;
        padding: 12px 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: var(--card-shadow);
        animation: slideInDown 0.5s ease;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background: var(--success-light);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    .alert-error {
        background: #f8d7da;
        color: var(--danger-color);
        border-left: 4px solid var(--danger-color);
    }

    /* Page Header */
    .page-header {
        margin-bottom: 30px;
    }

    .page-header h1 {
        font-size: 24px;
        font-weight: 600;
        color: var(--heading-color);
        margin: 0 0 5px 0;
        display: flex;
        align-items: center;
    }

    .page-header p {
        color: var(--text-light);
        margin: 0;
        font-size: 14px;
    }

    /* Delete Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-box {
        background: var(--white);
        border-radius: var(--card-radius);
        padding: 30px;
        max-width: 400px;
        width: 90%;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .modal-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f8d7da;
        color: var(--danger-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 20px;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--heading-color);
    }

    .modal-text {
        color: var(--text-light);
        margin-bottom: 25px;
        font-size: 14px;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .modal-btn {
        padding: 10px 25px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .modal-btn-cancel {
        background: var(--light-bg);
        color: var(--heading-color);
    }

    .modal-btn-cancel:hover {
        background: var(--border-color);
    }

    .modal-btn-delete {
        background: var(--danger-color);
        color: white;
    }

    .modal-btn-delete:hover {
        background: #c82333;
    }

    @media (max-width: 768px) {
        .themes-grid {
            grid-template-columns: 1fr;
        }

        .stats-cards {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-palette me-3"></i>Theme Manager</h1>
        <p>Manage and customize your website themes</p>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert-custom alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-custom alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <!-- Statistics -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="fas fa-palette"></i>
            </div>
            <div class="stat-content">
                <h3>{{ count($themes) }}</h3>
                <p>Total Themes</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $activeTheme }}</h3>
                <p>Active Theme</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="fas fa-lock"></i>
            </div>
            <div class="stat-content">
                <h3>{{ collect($themes)->where('is_system', true)->count() }}</h3>
                <p>System Themes</p>
            </div>
        </div>
    </div>

    <!-- Themes Grid -->
    <div class="themes-grid">
        @foreach($themes as $theme)
        <div class="theme-card {{ $theme['is_active'] ? 'active' : '' }}">
            <!-- Preview -->
            <div class="theme-preview">
                @if($theme['preview_image'] && file_exists(public_path($theme['preview_image'])))
                    <img src="{{ asset($theme['preview_image']) }}" alt="{{ $theme['name'] }} Preview">
                @else
                    <div class="theme-preview-placeholder">
                        <i class="fas fa-image"></i>
                        <span>No Preview</span>
                    </div>
                @endif

                @if($theme['is_active'])
                <div class="theme-active-badge">
                    <i class="fas fa-check"></i>
                    Active
                </div>
                @endif

                @if($theme['is_system'] ?? false)
                <div class="theme-system-badge">
                    <i class="fas fa-lock me-1"></i>System
                </div>
                @endif
            </div>

            <!-- Info -->
            <div class="theme-info">
                <div class="theme-name">{{ $theme['name'] }}</div>
                <div class="theme-description">
                    {{ $theme['description'] ?: 'No description available.' }}
                </div>

                <div class="theme-meta">
                    <div class="theme-meta-item">
                        <i class="fas fa-code-branch"></i>
                        v{{ $theme['version'] ?? '1.0.0' }}
                    </div>
                    @if($theme['author'] ?? false)
                    <div class="theme-meta-item">
                        <i class="fas fa-user"></i>
                        {{ $theme['author'] }}
                    </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="theme-actions">
                    @if($theme['is_active'])
                        <span class="theme-btn theme-btn-active">
                            <i class="fas fa-check-circle"></i>
                            Currently Active
                        </span>
                    @else
                        <form action="{{ route('admin.themes.activate', $theme['slug']) }}" method="POST" style="flex: 1;">
                            @csrf
                            <button type="submit" class="theme-btn theme-btn-activate" style="width: 100%;">
                                <i class="fas fa-power-off"></i>
                                Activate
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('admin.themes.edit', $theme['slug']) }}" class="theme-btn theme-btn-edit">
                        <i class="fas fa-cog"></i>
                    </a>

                    @if(!$theme['is_active'] && !($theme['is_system'] ?? false))
                    <button type="button" class="theme-btn theme-btn-delete" onclick="confirmDelete('{{ $theme['slug'] }}', '{{ $theme['name'] }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <!-- Add New Theme Card -->
        <a href="{{ route('admin.themes.create') }}" class="add-theme-card">
            <i class="fas fa-plus-circle"></i>
            <span>Add New Theme</span>
        </a>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <div class="modal-title">Delete Theme</div>
            <div class="modal-text">
                Are you sure you want to delete "<span id="deleteThemeName"></span>"? This action cannot be undone.
            </div>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="modal-btn modal-btn-delete">Delete Theme</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Delete confirmation
    function confirmDelete(slug, name) {
        document.getElementById('deleteThemeName').textContent = name;
        document.getElementById('deleteForm').action = '/admin/theme-manager/' + slug;
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }

    // Close modal on outside click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Auto-hide alerts
    (function() {
        const alerts = document.querySelectorAll('.alert-custom');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.animation = 'slideInDown 0.5s ease reverse';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    })();
</script>
@endsection
