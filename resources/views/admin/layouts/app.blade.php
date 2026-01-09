<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - EduCVE</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6.4.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Admin Panel CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    @yield('styles')
</head>
<body class="admin-body">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="sidebar-brand">Edu<span>CVE</span></div>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-category">Main</div>
            <a href="/admin" class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-category">Content Management</div>
            <a href="/admin/page-builder" class="menu-item {{ request()->is('admin/page-builder*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i>
                <span>Page Builder</span>
            </a>
            <a href="/admin/content-manager" class="menu-item {{ request()->is('admin/content-manager*') ? 'active' : '' }}">
                <i class="fas fa-edit"></i>
                <span>Content Manager</span>
            </a>
            <a href="/admin/page-manager" class="menu-item {{ request()->is('admin/page-manager*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Page Manager</span>
            </a>

            <div class="menu-category">Navigation</div>
            <a href="/admin/page-manager?tab=menu#menu-tab" class="menu-item" id="headerMenuLink">
                <i class="fas fa-bars"></i>
                <span>Header Menu</span>
            </a>
            <a href="/admin/footer-manager" class="menu-item {{ request()->is('admin/footer-manager*') ? 'active' : '' }}">
                <i class="fas fa-shoe-prints"></i>
                <span>Footer Menu</span>
            </a>

            <div class="menu-category">Appearance</div>
            <a href="/admin/theme-manager" class="menu-item {{ request()->is('admin/theme-manager*') ? 'active' : '' }}">
                <i class="fas fa-swatchbook"></i>
                <span>Theme Manager</span>
            </a>
            <a href="/admin/theme-import" class="menu-item {{ request()->is('admin/theme-import*') ? 'active' : '' }}">
                <i class="fas fa-file-import"></i>
                <span>Theme Import</span>
            </a>
            <a href="/admin/appearance" class="menu-item {{ request()->is('admin/appearance*') ? 'active' : '' }}">
                <i class="fas fa-palette"></i>
                <span>Theme Settings</span>
            </a>
            <a href="/admin/logo-manager" class="menu-item {{ request()->is('admin/logo-manager*') ? 'active' : '' }}">
                <i class="fas fa-image"></i>
                <span>Logo Manager</span>
            </a>

            <div class="menu-category">Media</div>
            <a href="/admin/media-library" class="menu-item {{ request()->is('admin/media-library*') ? 'active' : '' }}">
                <i class="fas fa-photo-video"></i>
                <span>Media Library</span>
            </a>

            <div class="menu-category">Settings</div>
            <a href="/admin/settings" class="menu-item {{ request()->is('admin/settings*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>General Settings</span>
            </a>
            <a href="/admin/seo" class="menu-item {{ request()->is('admin/seo*') ? 'active' : '' }}">
                <i class="fas fa-search"></i>
                <span>SEO Settings</span>
            </a>
            <a href="/admin/activity-log" class="menu-item {{ request()->is('admin/activity-log*') ? 'active' : '' }}">
                <i class="fas fa-history"></i>
                <span>Activity Log</span>
            </a>

            <div class="menu-category">Quick Links</div>
            <a href="/home" target="_blank" class="menu-item">
                <i class="fas fa-external-link-alt"></i>
                <span>View Site</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Top Header -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
            </div>

            <div class="header-actions">
                <button class="header-btn" title="Notifications">
                    <i class="fas fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                <button class="header-btn" title="Messages">
                    <i class="fas fa-envelope"></i>
                </button>
                <div class="user-dropdown">
                    <div class="user-avatar">A</div>
                    <div class="user-info">
                        <div class="user-name">Admin</div>
                        <div class="user-role">Administrator</div>
                    </div>
                    <i class="fas fa-chevron-down" style="font-size: 12px; color: #999;"></i>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-custom alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loader"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const body = document.body;
            sidebar.classList.toggle('active');
            body.classList.toggle('sidebar-open');
        }

        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('adminSidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            const body = document.body;
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('active');
                    body.classList.remove('sidebar-open');
                }
            }
        });

        // Close sidebar on window resize if open
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                const sidebar = document.getElementById('adminSidebar');
                const body = document.body;
                sidebar.classList.remove('active');
                body.classList.remove('sidebar-open');
            }
        });

        // Auto-hide success message
        (function() {
            const layoutSuccessAlert = document.querySelector('.admin-content > .alert-custom');
            if (layoutSuccessAlert) {
                setTimeout(() => {
                    layoutSuccessAlert.style.animation = 'slideInDown 0.5s ease reverse';
                    setTimeout(() => {
                        layoutSuccessAlert.remove();
                    }, 500);
                }, 5000);
            }
        })();

        // Highlight Header Menu link when on page-manager with menu tab
        (function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');
            const hash = window.location.hash;
            const currentPath = window.location.pathname;

            if (currentPath.includes('/admin/page-manager') && (tabParam === 'menu' || hash === '#menu-tab')) {
                // Remove active from Page Manager and add to Header Menu
                const pageManagerLink = document.querySelector('a.menu-item[href="/admin/page-manager"]');
                const headerMenuLink = document.getElementById('headerMenuLink');

                if (pageManagerLink) pageManagerLink.classList.remove('active');
                if (headerMenuLink) headerMenuLink.classList.add('active');
            }
        })();
    </script>

    @yield('scripts')
</body>
</html>
