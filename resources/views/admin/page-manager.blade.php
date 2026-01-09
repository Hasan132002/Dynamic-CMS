@extends('admin.layouts.app')

@section('title', 'Page Manager')

@section('styles')
<style>
    /* Page Manager Specific Styles */

    .table-responsive {
        overflow-x: auto;
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

    .alert-custom i {
        font-size: 16px;
    }

    .alert-success {
        background: var(--success-light);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    /* Tooltip */
    .tooltip-custom {
        position: relative;
        display: inline-block;
    }

    .tooltip-custom .tooltiptext {
        visibility: hidden;
        width: 110px;
        background-color: var(--secondary-color);
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -55px;
        opacity: 0;
        transition: opacity 0.2s;
        font-size: 11px;
    }

    .tooltip-custom:hover .tooltiptext {
        visibility: visible;
        opacity: 1;
    }

    /* Menu Builder Styles - WordPress Like */
    .menu-builder-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 20px;
    }

    .menu-sidebar {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        height: fit-content;
        overflow: hidden;
    }

    .sidebar-section {
        border-bottom: 1px solid var(--border-light);
    }

    .sidebar-section:last-child {
        border-bottom: none;
    }

    .sidebar-section-header {
        padding: 12px 15px;
        background: var(--light-bg);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
        font-size: 13px;
        color: var(--heading-color);
        transition: all 0.15s ease;
    }

    .sidebar-section-header:hover {
        background: var(--border-light);
    }

    .sidebar-section-header i.toggle-icon {
        transition: transform 0.2s ease;
        font-size: 12px;
    }

    .sidebar-section.collapsed .sidebar-section-header i.toggle-icon {
        transform: rotate(-90deg);
    }

    .sidebar-section.collapsed .sidebar-section-content {
        display: none;
    }

    .sidebar-section-content {
        padding: 12px 15px;
        max-height: 220px;
        overflow-y: auto;
    }

    .page-checkbox-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .page-checkbox-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        background: var(--light-bg);
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.15s ease;
        border: 1px solid transparent;
    }

    .page-checkbox-item:hover {
        background: var(--info-light);
        border-color: var(--primary-light);
    }

    .page-checkbox-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--primary-color);
        cursor: pointer;
    }

    .page-checkbox-item label {
        flex: 1;
        cursor: pointer;
        font-size: 13px;
        color: var(--heading-color);
    }

    .page-checkbox-item small {
        color: var(--text-light);
        font-size: 10px;
    }

    .sidebar-section-footer {
        padding: 10px 15px;
        background: var(--light-bg);
        border-top: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .select-all-btn {
        font-size: 11px;
        color: var(--primary-color);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .select-all-btn:hover {
        text-decoration: underline;
    }

    .add-to-menu-btn {
        padding: 6px 12px;
        background: var(--primary-color);
        color: white;
        border: 1px solid var(--primary-dark);
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.15s ease;
    }

    .add-to-menu-btn:hover {
        background: var(--primary-dark);
    }

    .add-to-menu-btn:disabled {
        background: var(--border-color);
        border-color: var(--border-color);
        cursor: not-allowed;
    }

    /* Custom Link Section */
    .custom-link-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .custom-link-form label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 2px;
    }

    .custom-link-form input {
        padding: 8px 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 13px;
        transition: all 0.15s ease;
    }

    .custom-link-form input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 1px var(--primary-color);
    }

    /* Menu Canvas */
    .menu-canvas {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        display: flex;
        flex-direction: column;
    }

    .menu-canvas-header {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .menu-canvas-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 14px;
        color: var(--heading-color);
    }

    .menu-canvas-body {
        padding: 20px;
        flex: 1;
        min-height: 400px;
        max-height: 600px;
        overflow-y: auto;
        position: relative;
    }

    .menu-canvas.drag-over .menu-canvas-body {
        background: var(--info-light);
        border: 2px dashed var(--primary-color);
        border-radius: 4px;
    }

    .menu-drop-zone {
        min-height: 350px;
    }

    /* WordPress Style Menu Items */
    .wp-menu-item {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 4px;
        margin-bottom: 6px;
        overflow: hidden;
        transition: all 0.15s ease;
    }

    .wp-menu-item:hover {
        border-color: var(--primary-light);
    }

    .wp-menu-item.dragging {
        opacity: 0.5;
        border-style: dashed;
    }

    .wp-menu-item-bar {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        cursor: move;
        gap: 10px;
        background: var(--light-bg);
    }

    .wp-menu-item-handle {
        color: var(--text-light);
        font-size: 12px;
    }

    .wp-menu-item-title {
        flex: 1;
        font-weight: 600;
        color: var(--heading-color);
        font-size: 13px;
    }

    .wp-menu-item-type {
        font-size: 10px;
        color: var(--text-light);
        padding: 2px 6px;
        background: var(--white);
        border-radius: 3px;
        border: 1px solid var(--border-light);
    }

    .wp-menu-item-toggle {
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        padding: 4px;
        transition: all 0.15s ease;
    }

    .wp-menu-item-toggle:hover {
        color: var(--primary-color);
    }

    .wp-menu-item-toggle i {
        transition: transform 0.2s ease;
        font-size: 12px;
    }

    .wp-menu-item.expanded .wp-menu-item-toggle i {
        transform: rotate(180deg);
    }

    .wp-menu-item-settings {
        display: none;
        padding: 12px;
        background: var(--white);
        border-top: 1px solid var(--border-light);
    }

    .wp-menu-item.expanded .wp-menu-item-settings {
        display: block;
    }

    .wp-setting-row {
        margin-bottom: 10px;
    }

    .wp-setting-row:last-child {
        margin-bottom: 0;
    }

    .wp-setting-row label {
        display: block;
        font-size: 11px;
        color: var(--text-light);
        margin-bottom: 4px;
    }

    .wp-setting-row input {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 13px;
    }

    .wp-setting-row input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 1px var(--primary-color);
    }

    .wp-menu-item-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid var(--border-light);
    }

    .wp-item-action-btns {
        display: flex;
        gap: 6px;
    }

    .wp-action-btn {
        padding: 5px 10px;
        border: 1px solid var(--border-color);
        background: var(--white);
        border-radius: 4px;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .wp-action-btn:hover {
        background: var(--light-bg);
        border-color: var(--primary-light);
    }

    .wp-action-btn.danger {
        color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .wp-action-btn.danger:hover {
        background: var(--danger-color);
        color: white;
    }

    /* Submenu Styling */
    .wp-submenu-container {
        margin-left: 30px;
        margin-top: 6px;
        padding-left: 12px;
        border-left: 2px solid var(--primary-light);
    }

    .wp-submenu-container .wp-menu-item {
        background: var(--white);
    }

    .wp-submenu-drop-zone {
        min-height: 30px;
        border: 2px dashed transparent;
        border-radius: 4px;
        margin-top: 6px;
        transition: all 0.15s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wp-submenu-drop-zone.active {
        border-color: var(--primary-color);
        background: var(--info-light);
    }

    .wp-submenu-drop-zone span {
        font-size: 11px;
        color: var(--text-light);
        display: none;
    }

    .wp-submenu-drop-zone.active span {
        display: block;
    }

    /* Menu Empty State */
    .menu-empty-state {
        text-align: center;
        padding: 60px 30px;
        color: var(--text-light);
    }

    .menu-empty-state i {
        font-size: 48px;
        color: var(--border-color);
        margin-bottom: 15px;
    }

    .menu-empty-state h4 {
        color: var(--heading-color);
        margin-bottom: 8px;
        font-size: 16px;
    }

    .menu-empty-state p {
        color: var(--text-light);
        max-width: 280px;
        margin: 0 auto;
        font-size: 13px;
    }

    /* Drag & Drop Preview */
    .drag-preview {
        position: fixed;
        pointer-events: none;
        z-index: 9999;
        background: var(--primary-color);
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        font-weight: 500;
        font-size: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    /* WordPress-style Drag Indent Indicator */
    .wp-drop-indicator {
        position: absolute;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--primary-color);
        border-radius: 2px;
        pointer-events: none;
        z-index: 100;
        display: none;
    }

    .wp-drop-indicator.show {
        display: block;
    }

    .wp-drop-indicator::before {
        content: '';
        position: absolute;
        left: 0;
        top: -4px;
        width: 10px;
        height: 10px;
        background: var(--primary-color);
        border-radius: 50%;
    }

    .wp-menu-item.drop-target {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 2px rgba(179, 9, 9, 0.2);
    }

    .wp-menu-item.drop-as-child {
        background: var(--info-light);
        border-left: 3px solid var(--primary-color);
    }

    /* Menu Depth Indicators */
    .depth-indicator {
        display: inline-block;
        width: 18px;
        height: 18px;
        background: var(--light-bg);
        border-radius: 4px;
        text-align: center;
        line-height: 18px;
        font-size: 10px;
        color: var(--text-light);
        margin-right: 6px;
    }

    .depth-0 .depth-indicator { background: var(--primary-color); color: white; }
    .depth-1 .depth-indicator { background: var(--secondary-light); color: white; }
    .depth-2 .depth-indicator { background: var(--text-light); color: white; }
    .depth-3 .depth-indicator { background: var(--warning-color); color: white; }
    .depth-4 .depth-indicator { background: var(--info-color); color: white; }
    .depth-5 .depth-indicator { background: #6f42c1; color: white; }
    .depth-6 .depth-indicator { background: #20c997; color: white; }

    @media (max-width: 992px) {
        .menu-builder-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-file-alt me-3"></i>Page Manager</h1>
        <p>Manage pages and build your navigation menus</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
    <div class="alert-custom alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- Tabs Navigation -->
    <div class="tabs-nav">
        <button class="tab-btn active" data-tab="pages">
            <i class="fas fa-file-alt me-2"></i>Pages
        </button>
        <button class="tab-btn" data-tab="menu">
            <i class="fas fa-bars me-2"></i>Menu Builder
        </button>
    </div>

    <!-- TAB 1: Pages Management -->
    <div class="custom-tab-content active" id="pages-tab">
        <!-- Statistics -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-value">{{ count($pages) }}</div>
                <div class="stat-label"><i class="fas fa-file-alt me-1"></i>Total Pages</div>
            </div>
            <div class="stat-card success">
                <div class="stat-value">{{ $pages->where('is_active', true)->count() }}</div>
                <div class="stat-label"><i class="fas fa-check-circle me-1"></i>Active Pages</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-value">{{ $pages->where('in_menu', true)->count() }}</div>
                <div class="stat-label"><i class="fas fa-bars me-1"></i>In Menu</div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="controls-section">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="Search pages by name or URL...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-chips">
                        <span class="filter-chip active" data-filter="all">
                            <i class="fas fa-globe me-1"></i>All Pages
                        </span>
                        <span class="filter-chip" data-filter="active">
                            <i class="fas fa-check-circle me-1"></i>Active
                        </span>
                        <span class="filter-chip" data-filter="inactive">
                            <i class="fas fa-times-circle me-1"></i>Inactive
                        </span>
                        <span class="filter-chip" data-filter="menu">
                            <i class="fas fa-bars me-1"></i>In Menu
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pages Table -->
        <form method="POST" action="/admin/page-manager/save" id="pageManagerForm">
            @csrf

            <div class="table-card">
                <div class="table-responsive">
                    <table class="pages-table">
                        <thead>
                            <tr>
                                <th style="width: 40%;"><i class="fas fa-file me-2"></i>Page Details</th>
                                <th style="width: 25%;"><i class="fas fa-link me-2"></i>URL Path</th>
                                <th style="width: 12%; text-align: center;"><i class="fas fa-bars me-2"></i>Show in Menu</th>
                                <th style="width: 12%; text-align: center;"><i class="fas fa-toggle-on me-2"></i>Live Status</th>
                                <th style="width: 11%; text-align: center;"><i class="fas fa-info-circle me-2"></i>Status</th>
                            </tr>
                        </thead>
                        <tbody id="pagesTableBody">
                            @foreach($pages as $page)
                            <tr class="page-row"
                                data-page-name="{{ strtolower($page->title) }}"
                                data-page-url="{{ strtolower($page->route_uri) }}"
                                data-is-active="{{ $page->is_active ? 'true' : 'false' }}"
                                data-in-menu="{{ $page->in_menu ? 'true' : 'false' }}">

                                <!-- Page Details -->
                                <td>
                                    <div class="page-info">
                                        <div class="page-icon">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="page-details">
                                            <h6>{{ $page->title }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <!-- URL Path -->
                                <td>
                                    <span class="page-url">
                                        <i class="fas fa-link"></i>
                                        {{ $page->route_uri }}
                                    </span>
                                </td>

                                <!-- Show in Menu Toggle -->
                                <td style="text-align: center;">
                                    <label class="toggle-switch tooltip-custom">
                                        <input type="checkbox"
                                               name="pages[{{ $page->id }}][in_menu]"
                                               {{ $page->in_menu ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                        <span class="tooltiptext">Toggle Menu Visibility</span>
                                    </label>
                                </td>

                                <!-- Live Status Toggle -->
                                <td style="text-align: center;">
                                    <label class="toggle-switch tooltip-custom">
                                        <input type="checkbox"
                                               name="pages[{{ $page->id }}][is_active]"
                                               {{ $page->is_active ? 'checked' : '' }}>
                                        <span class="toggle-slider"></span>
                                        <span class="tooltiptext">Toggle Page Status</span>
                                    </label>
                                </td>

                                <!-- Status Badge -->
                                <td style="text-align: center;">
                                    @if($page->is_active)
                                        <span class="status-badge live">
                                            <i class="fas fa-circle"></i>
                                            Live
                                        </span>
                                    @else
                                        <span class="status-badge offline">
                                            <i class="fas fa-circle"></i>
                                            Offline
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="empty-state" style="display: none;">
                    <i class="fas fa-search"></i>
                    <h4>No Pages Found</h4>
                    <p>Try adjusting your search or filter criteria</p>
                </div>
            </div>

            <!-- Save Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i>
                    Save All Changes
                </button>
            </div>
        </form>
    </div>
    <!-- END TAB 1 -->

    <!-- TAB 2: Menu Builder (WordPress Style) -->
    <div class="custom-tab-content" id="menu-tab">
        <div class="menu-builder-container">
            <!-- Sidebar: Add Menu Items -->
            <div class="menu-sidebar">
                <!-- Pages Section -->
                <div class="sidebar-section" id="pagesSection">
                    <div class="sidebar-section-header" onclick="toggleSection('pagesSection')">
                        <span><i class="fas fa-file-alt me-2"></i>Pages</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="sidebar-section-content">
                        <div class="page-checkbox-list" id="pagesList">
                            @foreach($pages as $page)
                            <div class="page-checkbox-item">
                                <input type="checkbox" id="page-{{ $page->id }}"
                                       data-page-id="{{ $page->id }}"
                                       data-page-title="{{ $page->title }}"
                                       data-page-url="{{ $page->route_uri }}">
                                <label for="page-{{ $page->id }}">{{ $page->title }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="sidebar-section-footer">
                        <button class="select-all-btn" onclick="selectAllPages()">Select All</button>
                        <button class="add-to-menu-btn" onclick="addSelectedPages()">
                            <i class="fas fa-plus me-1"></i>Add to Menu
                        </button>
                    </div>
                </div>

                <!-- Custom Links Section -->
                <div class="sidebar-section" id="customLinksSection">
                    <div class="sidebar-section-header" onclick="toggleSection('customLinksSection')">
                        <span><i class="fas fa-link me-2"></i>Custom Links</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="sidebar-section-content">
                        <div class="custom-link-form">
                            <div>
                                <label>URL</label>
                                <input type="text" id="customLinkUrl" placeholder="https://">
                            </div>
                            <div>
                                <label>Link Text</label>
                                <input type="text" id="customLinkText" placeholder="Menu item title">
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-section-footer">
                        <span></span>
                        <button class="add-to-menu-btn" onclick="addCustomLink()">
                            <i class="fas fa-plus me-1"></i>Add to Menu
                        </button>
                    </div>
                </div>

                <!-- Categories Section (Optional) -->
                <div class="sidebar-section collapsed" id="categoriesSection">
                    <div class="sidebar-section-header" onclick="toggleSection('categoriesSection')">
                        <span><i class="fas fa-folder me-2"></i>Categories</span>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="sidebar-section-content">
                        <p class="text-muted small mb-0">No categories available.</p>
                    </div>
                </div>
            </div>

            <!-- Canvas: Menu Structure -->
            <div class="menu-canvas" id="menuCanvasContainer">
                <div class="menu-canvas-header">
                    <h5><i class="fas fa-bars me-2"></i>Menu Structure</h5>
                    <div class="d-flex gap-2">
                        <button class="wp-action-btn" onclick="expandAllItems()">
                            <i class="fas fa-expand-alt"></i> Expand All
                        </button>
                        <button class="wp-action-btn" onclick="collapseAllItems()">
                            <i class="fas fa-compress-alt"></i> Collapse All
                        </button>
                        <button class="btn-save" onclick="saveMenu()">
                            <i class="fas fa-save"></i> Save Menu
                        </button>
                    </div>
                </div>

                <div class="menu-canvas-body">
                    <div id="menuCanvas" class="menu-drop-zone">
                        <div class="menu-empty-state" id="emptyMenuState">
                            <i class="fas fa-mouse-pointer"></i>
                            <h4>Add Menu Items</h4>
                            <p>Select pages from the left panel and click "Add to Menu" or drag items to reorder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END TAB 2 -->
@endsection

@section('scripts')
<script>
    // ===== PAGE TAB: Search Functionality =====
    document.getElementById('searchInput').addEventListener('input', function(e) {
        filterPages();
    });

    // Filter Functionality
    document.querySelectorAll('.filter-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            filterPages();
        });
    });

    function filterPages() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const activeFilter = document.querySelector('.filter-chip.active').dataset.filter;
        const rows = document.querySelectorAll('.page-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const pageName = row.dataset.pageName;
            const pageUrl = row.dataset.pageUrl;
            const isActive = row.dataset.isActive === 'true';
            const inMenu = row.dataset.inMenu === 'true';

            const matchesSearch = pageName.includes(searchTerm) || pageUrl.includes(searchTerm);

            let matchesFilter = true;
            if (activeFilter === 'active') matchesFilter = isActive;
            else if (activeFilter === 'inactive') matchesFilter = !isActive;
            else if (activeFilter === 'menu') matchesFilter = inMenu;

            if (matchesSearch && matchesFilter) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const emptyState = document.getElementById('emptyState');
        emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Auto-hide success message
    (function() {
        const pageSuccessAlert = document.querySelector('#pages-tab .alert-custom');
        if (pageSuccessAlert) {
            setTimeout(() => {
                pageSuccessAlert.style.animation = 'slideInDown 0.5s ease reverse';
                setTimeout(() => pageSuccessAlert.remove(), 500);
            }, 5000);
        }
    })();

    // ===== TAB SWITCHING =====
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.custom-tab-content').forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            const tabId = this.dataset.tab + '-tab';
            document.getElementById(tabId).classList.add('active');

            if (this.dataset.tab === 'menu' && !menuLoaded) {
                loadExistingMenu();
            }
        });
    });

    // ===== WORDPRESS-STYLE MENU BUILDER =====
    let menuStructure = [];
    let menuLoaded = false;
    let draggedItem = null;

    // Toggle sidebar sections
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        section.classList.toggle('collapsed');
    }

    // Select all pages
    function selectAllPages() {
        const checkboxes = document.querySelectorAll('#pagesList input[type="checkbox"]');
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
        checkboxes.forEach(cb => cb.checked = !allChecked);
    }

    // Add selected pages to menu
    function addSelectedPages() {
        const checkboxes = document.querySelectorAll('#pagesList input[type="checkbox"]:checked');

        if (checkboxes.length === 0) {
            showToast('Please select at least one page', 'warning');
            return;
        }

        checkboxes.forEach(cb => {
            const newItem = {
                id: 'page-' + cb.dataset.pageId + '-' + Date.now() + Math.random(),
                title: cb.dataset.pageTitle,
                url: cb.dataset.pageUrl,
                type: 'Page',
                children: []
            };
            menuStructure.push(newItem);
            cb.checked = false;
        });

        renderMenu();
        showToast(checkboxes.length + ' item(s) added to menu', 'success');
    }

    // Add custom link to menu
    function addCustomLink() {
        const urlInput = document.getElementById('customLinkUrl');
        const textInput = document.getElementById('customLinkText');

        const url = urlInput.value.trim();
        const text = textInput.value.trim();

        if (!url || !text) {
            showToast('Please fill in both URL and Link Text', 'warning');
            return;
        }

        const newItem = {
            id: 'custom-' + Date.now(),
            title: text,
            url: url,
            type: 'Custom Link',
            children: []
        };

        menuStructure.push(newItem);
        urlInput.value = '';
        textInput.value = '';

        renderMenu();
        showToast('Custom link added to menu', 'success');
    }

    // Load existing menu from backend
    async function loadExistingMenu() {
        try {
            const response = await fetch('/admin/page-manager/get-menu');
            const data = await response.json();
            if (data.success && data.menu && data.menu.length > 0) {
                menuStructure = convertNavToMenuStructure(data.menu);
                renderMenu();
            }
            menuLoaded = true;
        } catch (error) {
            console.error('Error loading menu:', error);
            menuLoaded = true;
        }
    }

    // Convert navigation format to menu structure format
    function convertNavToMenuStructure(navItems) {
        return navItems.map((item, index) => ({
            id: 'nav-' + index + '-' + Date.now() + Math.random(),
            title: item.label,
            url: item.url,
            type: item.url.startsWith('http') ? 'Custom Link' : 'Page',
            children: item.children ? convertNavToMenuStructure(item.children) : []
        }));
    }

    // Toggle menu item expand/collapse
    function toggleMenuItem(itemId) {
        const itemEl = document.querySelector(`.wp-menu-item[data-item-id="${itemId}"]`);
        if (itemEl) {
            itemEl.classList.toggle('expanded');
        }
    }

    // Expand all menu items
    function expandAllItems() {
        document.querySelectorAll('.wp-menu-item').forEach(item => {
            item.classList.add('expanded');
        });
    }

    // Collapse all menu items
    function collapseAllItems() {
        document.querySelectorAll('.wp-menu-item').forEach(item => {
            item.classList.remove('expanded');
        });
    }

    // Update item title
    function updateItemTitle(itemId, newTitle) {
        const item = findMenuItem(menuStructure, itemId);
        if (item) {
            item.title = newTitle;
            // Update the bar title as well
            const titleEl = document.querySelector(`.wp-menu-item[data-item-id="${itemId}"] .wp-menu-item-title`);
            if (titleEl) titleEl.textContent = newTitle;
        }
    }

    // Update item URL
    function updateItemUrl(itemId, newUrl) {
        const item = findMenuItem(menuStructure, itemId);
        if (item) {
            item.url = newUrl;
        }
    }

    // Find menu item by ID
    function findMenuItem(items, id) {
        for (let item of items) {
            if (item.id == id) return item;
            if (item.children && item.children.length > 0) {
                const found = findMenuItem(item.children, id);
                if (found) return found;
            }
        }
        return null;
    }

    // Move item up
    function moveItemUp(itemId) {
        moveItem(itemId, -1);
    }

    // Move item down
    function moveItemDown(itemId) {
        moveItem(itemId, 1);
    }

    // Generic move item function
    function moveItem(itemId, direction) {
        // Find item in menu structure
        function findAndMove(items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId) {
                    const newIndex = i + direction;
                    if (newIndex >= 0 && newIndex < items.length) {
                        [items[i], items[newIndex]] = [items[newIndex], items[i]];
                        return true;
                    }
                    return false;
                }
                if (items[i].children && findAndMove(items[i].children)) {
                    return true;
                }
            }
            return false;
        }

        if (findAndMove(menuStructure)) {
            renderMenu();
        }
    }

    // Make item a submenu (indent right)
    function makeSubmenuItem(itemId) {
        // Find item and its index
        function findAndIndent(items, parent = null) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId) {
                    if (i === 0) return false; // Can't indent first item

                    const item = items.splice(i, 1)[0];
                    const prevItem = items[i - 1];

                    if (!prevItem.children) prevItem.children = [];
                    prevItem.children.push(item);
                    return true;
                }
                if (items[i].children && findAndIndent(items[i].children, items[i])) {
                    return true;
                }
            }
            return false;
        }

        if (findAndIndent(menuStructure)) {
            renderMenu();
            showToast('Item moved to submenu', 'success');
        }
    }

    // Remove item from submenu (outdent left)
    function removeFromSubmenu(itemId) {
        function findAndOutdent(items, parentItems = null, grandparentItems = null) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId && parentItems !== null) {
                    const item = items.splice(i, 1)[0];
                    // Find parent index in grandparent
                    const parentIndex = grandparentItems ? grandparentItems.findIndex(p =>
                        p.children && p.children.includes(items[0]) || p.children === items
                    ) : -1;

                    if (grandparentItems && parentIndex !== -1) {
                        grandparentItems.splice(parentIndex + 1, 0, item);
                    } else {
                        menuStructure.push(item);
                    }
                    return true;
                }
                if (items[i].children && findAndOutdent(items[i].children, items, parentItems || menuStructure)) {
                    return true;
                }
            }
            return false;
        }

        if (findAndOutdent(menuStructure)) {
            renderMenu();
            showToast('Item moved out of submenu', 'success');
        }
    }

    // Remove item from menu
    function removeItem(itemId) {
        function removeFromArray(items) {
            return items.filter(item => {
                if (item.id == itemId) return false;
                if (item.children) item.children = removeFromArray(item.children);
                return true;
            });
        }

        menuStructure = removeFromArray(menuStructure);
        renderMenu();
        showToast('Item removed from menu', 'success');
    }

    // Render menu
    function renderMenu() {
        const canvas = document.getElementById('menuCanvas');

        if (menuStructure.length === 0) {
            canvas.innerHTML = `
                <div class="menu-empty-state" id="emptyMenuState">
                    <i class="fas fa-mouse-pointer"></i>
                    <h4>Add Menu Items</h4>
                    <p>Select pages from the left panel and click "Add to Menu" or add custom links</p>
                </div>
            `;
            return;
        }

        canvas.innerHTML = renderMenuItems(menuStructure, 0);
        setupDragAndDrop();
    }

    // Render menu items recursively (WordPress style)
    function renderMenuItems(items, depth = 0) {
        let html = '';

        items.forEach((item, index) => {
            const isFirst = index === 0;
            const isLast = index === items.length - 1;
            const hasChildren = item.children && item.children.length > 0;

            html += `
                <div class="wp-menu-item depth-${depth}" data-item-id="${item.id}" data-depth="${depth}" draggable="true">
                    <div class="wp-menu-item-bar">
                        <span class="wp-menu-item-handle"><i class="fas fa-grip-vertical"></i></span>
                        <span class="depth-indicator">${depth + 1}</span>
                        <span class="wp-menu-item-title">${item.title}</span>
                        <span class="wp-menu-item-type">${item.type || 'Page'}</span>
                        <button class="wp-menu-item-toggle" onclick="toggleMenuItem('${item.id}')">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="wp-menu-item-settings">
                        <div class="wp-setting-row">
                            <label>Navigation Label</label>
                            <input type="text" value="${item.title}" onchange="updateItemTitle('${item.id}', this.value)">
                        </div>
                        <div class="wp-setting-row">
                            <label>URL</label>
                            <input type="text" value="${item.url}" onchange="updateItemUrl('${item.id}', this.value)">
                        </div>
                        <div class="wp-menu-item-actions">
                            <div class="wp-item-action-btns">
                                <button class="wp-action-btn" onclick="moveItemUp('${item.id}')" ${isFirst ? 'disabled' : ''} title="Move Up">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                                <button class="wp-action-btn" onclick="moveItemDown('${item.id}')" ${isLast ? 'disabled' : ''} title="Move Down">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                                ${!isFirst ? `<button class="wp-action-btn" onclick="makeSubmenuItem('${item.id}')" title="Make Submenu"><i class="fas fa-indent"></i></button>` : ''}
                                ${depth > 0 ? `<button class="wp-action-btn" onclick="removeFromSubmenu('${item.id}')" title="Move Out"><i class="fas fa-outdent"></i></button>` : ''}
                            </div>
                            <button class="wp-action-btn danger" onclick="removeItem('${item.id}')">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    ${hasChildren ? `<div class="wp-submenu-container">${renderMenuItems(item.children, depth + 1)}</div>` : ''}
                </div>
            `;
        });

        return html;
    }

    // WordPress-style drag-to-indent variables
    let wpDragStartX = 0;
    let wpDragCurrentX = 0;
    let wpDropTarget = null;
    let wpDropMode = 'before'; // 'before', 'after', 'child'
    const WP_INDENT_THRESHOLD = 50; // pixels to drag right to make it a child

    // Setup drag and drop for menu items (WordPress style with indent)
    function setupDragAndDrop() {
        const items = document.querySelectorAll('.wp-menu-item');
        const canvas = document.getElementById('menuCanvas');

        // Remove existing listeners by cloning
        items.forEach(item => {
            const newItem = item.cloneNode(true);
            item.parentNode.replaceChild(newItem, item);
        });

        // Re-select items after clone
        const freshItems = document.querySelectorAll('.wp-menu-item');

        freshItems.forEach(item => {
            // Drag start
            item.addEventListener('dragstart', function(e) {
                e.stopPropagation();
                draggedItem = this.dataset.itemId;
                wpDragStartX = e.clientX;
                this.classList.add('dragging');

                // Set drag image
                const dragImg = document.createElement('div');
                dragImg.className = 'drag-preview';
                dragImg.textContent = this.querySelector('.wp-menu-item-title').textContent;
                dragImg.style.position = 'absolute';
                dragImg.style.top = '-1000px';
                document.body.appendChild(dragImg);
                e.dataTransfer.setDragImage(dragImg, 0, 0);
                setTimeout(() => dragImg.remove(), 0);
            });

            // Drag end
            item.addEventListener('dragend', function(e) {
                this.classList.remove('dragging');

                // Clear all drop indicators
                document.querySelectorAll('.wp-menu-item').forEach(i => {
                    i.classList.remove('drop-target', 'drop-as-child');
                });

                // Perform the drop if we have a target
                if (draggedItem && wpDropTarget && draggedItem !== wpDropTarget) {
                    if (wpDropMode === 'child') {
                        // Make dragged item a child of target
                        makeChildOf(draggedItem, wpDropTarget);
                    } else {
                        // Reorder items (place before target)
                        reorderItems(draggedItem, wpDropTarget);
                    }
                }

                draggedItem = null;
                wpDropTarget = null;
                wpDropMode = 'before';
            });

            // Drag over - detect horizontal position for indent
            item.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();

                if (!draggedItem || draggedItem === this.dataset.itemId) return;

                wpDragCurrentX = e.clientX;
                wpDropTarget = this.dataset.itemId;

                // Clear previous indicators
                document.querySelectorAll('.wp-menu-item').forEach(i => {
                    i.classList.remove('drop-target', 'drop-as-child');
                });

                // Calculate horizontal offset from drag start
                const horizontalOffset = wpDragCurrentX - wpDragStartX;

                // Get the item's bounding rect for position detection
                const rect = this.getBoundingClientRect();
                const relativeX = e.clientX - rect.left;

                // Determine drop mode based on horizontal drag distance
                if (horizontalOffset > WP_INDENT_THRESHOLD || relativeX > 100) {
                    // Dragging right = make it a child
                    wpDropMode = 'child';
                    this.classList.add('drop-as-child');
                } else {
                    // Normal drop = place before
                    wpDropMode = 'before';
                    this.classList.add('drop-target');
                }
            });

            // Drag leave
            item.addEventListener('dragleave', function(e) {
                this.classList.remove('drop-target', 'drop-as-child');
            });
        });

        // Handle drop on canvas (for root level)
        if (canvas) {
            canvas.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            canvas.addEventListener('drop', function(e) {
                // Only handle if dropped directly on canvas (not on an item)
                if (e.target === canvas || e.target.classList.contains('menu-drop-zone')) {
                    e.preventDefault();
                    // Move to root level at end
                    if (draggedItem) {
                        moveToRootEnd(draggedItem);
                    }
                }
            });
        }
    }

    // Make item a child of another item
    function makeChildOf(itemId, parentId) {
        let itemToMove = null;

        // Remove from current position
        function removeItem(items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId) {
                    itemToMove = items.splice(i, 1)[0];
                    return true;
                }
                if (items[i].children && removeItem(items[i].children)) {
                    return true;
                }
            }
            return false;
        }

        // Add as child
        function addAsChild(items) {
            for (let item of items) {
                if (item.id == parentId) {
                    if (!item.children) item.children = [];
                    item.children.push(itemToMove);
                    return true;
                }
                if (item.children && addAsChild(item.children)) {
                    return true;
                }
            }
            return false;
        }

        removeItem(menuStructure);
        if (itemToMove) {
            if (addAsChild(menuStructure)) {
                renderMenu();
                showToast('Item moved to submenu', 'success');
            }
        }
    }

    // Move item to root level at end
    function moveToRootEnd(itemId) {
        let itemToMove = null;

        function removeItem(items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId) {
                    itemToMove = items.splice(i, 1)[0];
                    return true;
                }
                if (items[i].children && removeItem(items[i].children)) {
                    return true;
                }
            }
            return false;
        }

        removeItem(menuStructure);
        if (itemToMove) {
            menuStructure.push(itemToMove);
            renderMenu();
        }
    }

    // Reorder items (simple swap for now)
    function reorderItems(sourceId, targetId) {
        let sourceItem = null;
        let sourceParent = null;
        let sourceIndex = -1;

        // Remove source item
        function findAndRemove(items, parent = null) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == sourceId) {
                    sourceItem = items.splice(i, 1)[0];
                    sourceParent = parent;
                    sourceIndex = i;
                    return true;
                }
                if (items[i].children && findAndRemove(items[i].children, items[i])) {
                    return true;
                }
            }
            return false;
        }

        // Find target and insert
        function findAndInsert(items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == targetId) {
                    items.splice(i, 0, sourceItem);
                    return true;
                }
                if (items[i].children && findAndInsert(items[i].children)) {
                    return true;
                }
            }
            return false;
        }

        findAndRemove(menuStructure);
        if (sourceItem) {
            findAndInsert(menuStructure);
            renderMenu();
        }
    }

    // Show toast notification
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 25px;
            background: ${type === 'success' ? 'var(--success-color)' : type === 'warning' ? 'var(--warning-color)' : 'var(--danger-color)'};
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 9999;
            animation: slideInRight 0.3s ease;
        `;
        toast.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'times-circle'} me-2"></i>${message}`;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideInRight 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Save menu to backend
    function saveMenu() {
        // Convert to the format expected by backend (expects 'title' key)
        function convertToSaveFormat(items) {
            return items.map(item => ({
                title: item.title,
                url: item.url,
                children: item.children && item.children.length > 0 ? convertToSaveFormat(item.children) : []
            }));
        }

        const menuData = convertToSaveFormat(menuStructure);

        fetch('/admin/page-manager/save-menu', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ menu: menuData })
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Server response:', text);
                    throw new Error('Server error: ' + response.status);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showToast('Menu saved successfully!', 'success');
            } else {
                showToast('Error saving menu: ' + (data.message || 'Unknown error'), 'error');
            }
        })
        .catch(error => {
            showToast('Error saving menu: ' + error.message, 'error');
            console.error(error);
        });
    }

    // Add keyframe animation for toast
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);

    // Auto-switch to menu tab if URL has ?tab=menu or #menu-tab
    (function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab');
        const hash = window.location.hash;

        if (tabParam === 'menu' || hash === '#menu-tab') {
            // Switch to menu tab
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.custom-tab-content').forEach(c => c.classList.remove('active'));

            const menuTabBtn = document.querySelector('.tab-btn[data-tab="menu"]');
            const menuTabContent = document.getElementById('menu-tab');

            if (menuTabBtn) menuTabBtn.classList.add('active');
            if (menuTabContent) menuTabContent.classList.add('active');

            // Load menu if not loaded
            if (!menuLoaded) {
                loadExistingMenu();
            }
        }
    })();
</script>
@endsection
