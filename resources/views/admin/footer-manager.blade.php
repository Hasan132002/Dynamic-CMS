@extends('admin.layouts.app')

@section('title', 'Footer Manager')

@section('styles')
<style>
    /* Footer Manager - WordPress Style */

    /* Success Alert */
    .fm-alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: none;
        align-items: center;
        gap: 10px;
        animation: slideInDown 0.3s ease;
    }

    .fm-alert.show {
        display: flex;
    }

    .fm-alert-success {
        background: var(--success-light);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    /* Main Container */
    .fm-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 20px;
    }

    /* Sidebar */
    .fm-sidebar {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        height: fit-content;
        overflow: hidden;
    }

    .fm-sidebar-section {
        border-bottom: 1px solid var(--border-light);
    }

    .fm-sidebar-section:last-child {
        border-bottom: none;
    }

    .fm-sidebar-header {
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

    .fm-sidebar-header:hover {
        background: var(--border-light);
    }

    .fm-sidebar-header i.toggle-icon {
        transition: transform 0.2s ease;
        font-size: 12px;
    }

    .fm-sidebar-section.collapsed .fm-sidebar-header i.toggle-icon {
        transform: rotate(-90deg);
    }

    .fm-sidebar-section.collapsed .fm-sidebar-content {
        display: none;
    }

    .fm-sidebar-content {
        padding: 12px 15px;
        max-height: 220px;
        overflow-y: auto;
    }

    .fm-page-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .fm-page-item {
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

    .fm-page-item:hover {
        background: var(--info-light);
        border-color: var(--primary-light);
    }

    .fm-page-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--primary-color);
        cursor: pointer;
    }

    .fm-page-item label {
        flex: 1;
        cursor: pointer;
        font-size: 13px;
        color: var(--heading-color);
        margin: 0;
    }

    .fm-sidebar-footer {
        padding: 10px 15px;
        background: var(--light-bg);
        border-top: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .fm-select-all {
        font-size: 11px;
        color: var(--primary-color);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .fm-select-all:hover {
        text-decoration: underline;
    }

    .fm-add-btn {
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

    .fm-add-btn:hover {
        background: var(--primary-dark);
    }

    /* Custom Link Form */
    .fm-link-form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .fm-link-form label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 2px;
    }

    .fm-link-form input {
        padding: 8px 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 13px;
        transition: all 0.15s ease;
    }

    .fm-link-form input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 1px var(--primary-color);
    }

    /* Main Content Area */
    .fm-main {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Menu Section Cards */
    .fm-menu-card {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        overflow: hidden;
    }

    .fm-menu-header {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--light-bg);
    }

    .fm-menu-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 14px;
        color: var(--heading-color);
    }

    .fm-title-input {
        padding: 6px 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        width: 200px;
    }

    .fm-title-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 1px var(--primary-color);
    }

    .fm-menu-body {
        padding: 20px;
        min-height: 200px;
        max-height: 400px;
        overflow-y: auto;
    }

    /* Menu Items - WordPress Style */
    .fm-item {
        background: var(--white);
        border: 1px solid var(--border-color);
        border-radius: 4px;
        margin-bottom: 6px;
        overflow: hidden;
        transition: all 0.15s ease;
    }

    .fm-item:hover {
        border-color: var(--primary-light);
    }

    .fm-item.dragging {
        opacity: 0.5;
        border-style: dashed;
    }

    .fm-item-bar {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        cursor: move;
        gap: 10px;
        background: var(--light-bg);
    }

    .fm-item-handle {
        color: var(--text-light);
        font-size: 12px;
    }

    .fm-item-title {
        flex: 1;
        font-weight: 600;
        color: var(--heading-color);
        font-size: 13px;
    }

    .fm-item-type {
        font-size: 10px;
        color: var(--text-light);
        padding: 2px 6px;
        background: var(--white);
        border-radius: 3px;
        border: 1px solid var(--border-light);
    }

    .fm-item-toggle {
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        padding: 4px;
        transition: all 0.15s ease;
    }

    .fm-item-toggle:hover {
        color: var(--primary-color);
    }

    .fm-item-toggle i {
        transition: transform 0.2s ease;
        font-size: 12px;
    }

    .fm-item.expanded .fm-item-toggle i {
        transform: rotate(180deg);
    }

    .fm-item-settings {
        display: none;
        padding: 12px;
        background: var(--white);
        border-top: 1px solid var(--border-light);
    }

    .fm-item.expanded .fm-item-settings {
        display: block;
    }

    .fm-setting-row {
        margin-bottom: 10px;
    }

    .fm-setting-row:last-child {
        margin-bottom: 0;
    }

    .fm-setting-row label {
        display: block;
        font-size: 11px;
        color: var(--text-light);
        margin-bottom: 4px;
    }

    .fm-setting-row input {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 13px;
    }

    .fm-setting-row input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 1px var(--primary-color);
    }

    .fm-item-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid var(--border-light);
    }

    .fm-action-btns {
        display: flex;
        gap: 6px;
    }

    .fm-action-btn {
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

    .fm-action-btn:hover {
        background: var(--light-bg);
        border-color: var(--primary-light);
    }

    .fm-action-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .fm-action-btn.danger {
        color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .fm-action-btn.danger:hover {
        background: var(--danger-color);
        color: white;
    }

    /* Submenu Container - Unlimited Nesting */
    .fm-submenu {
        margin-left: 30px;
        margin-top: 6px;
        padding-left: 12px;
        border-left: 2px solid var(--primary-light);
    }

    .fm-submenu .fm-item {
        background: var(--white);
    }

    /* Depth Indicators */
    .fm-depth-indicator {
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

    .fm-item[data-depth="0"] .fm-depth-indicator { background: var(--primary-color); color: white; }
    .fm-item[data-depth="1"] .fm-depth-indicator { background: var(--secondary-light); color: white; }
    .fm-item[data-depth="2"] .fm-depth-indicator { background: var(--text-light); color: white; }
    .fm-item[data-depth="3"] .fm-depth-indicator { background: var(--warning-color); color: white; }
    .fm-item[data-depth="4"] .fm-depth-indicator { background: var(--info-color); color: white; }

    /* Empty State */
    .fm-empty {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }

    .fm-empty i {
        font-size: 36px;
        color: var(--border-color);
        margin-bottom: 10px;
    }

    .fm-empty p {
        margin: 0;
        font-size: 13px;
    }

    /* WordPress-style Drag Indent Indicators */
    .fm-item.drop-target {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 2px rgba(179, 9, 9, 0.2);
    }

    .fm-item.drop-as-child {
        background: var(--info-light);
        border-left: 3px solid var(--primary-color);
    }

    /* Save Button */
    .fm-save-btn {
        background: linear-gradient(135deg, var(--success-color) 0%, #1e7e34 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        display: block;
        margin: 0 auto;
    }

    .fm-save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(40, 167, 69, 0.3);
    }

    /* Toast */
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }

    @keyframes slideInDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @media (max-width: 992px) {
        .fm-container {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-shoe-prints"></i> Footer Manager</h1>
        <p>Manage footer navigation menus with drag and drop</p>
    </div>

    <!-- Success Alert -->
    <div class="fm-alert fm-alert-success" id="fmSuccessAlert">
        <i class="fas fa-check-circle"></i>
        <span id="fmSuccessMessage">Changes saved successfully!</span>
    </div>

    <div class="fm-container">
        <!-- Sidebar: Add Menu Items -->
        <div class="fm-sidebar">
            <!-- Pages Section -->
            <div class="fm-sidebar-section" id="fmPagesSection">
                <div class="fm-sidebar-header" onclick="fmToggleSection('fmPagesSection')">
                    <span><i class="fas fa-file-alt me-2"></i>Pages</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="fm-sidebar-content">
                    <div class="fm-page-list" id="fmPagesList">
                        @foreach($pages ?? [] as $page)
                        <div class="fm-page-item">
                            <input type="checkbox" id="fm-page-{{ $page->id }}"
                                   data-page-id="{{ $page->id }}"
                                   data-page-title="{{ $page->title }}"
                                   data-page-url="{{ $page->route_uri }}">
                            <label for="fm-page-{{ $page->id }}">{{ $page->title }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="fm-sidebar-footer">
                    <button class="fm-select-all" onclick="fmSelectAllPages()">Select All</button>
                    <button class="fm-add-btn" onclick="fmAddSelectedPages()">
                        <i class="fas fa-plus me-1"></i>Add
                    </button>
                </div>
            </div>

            <!-- Custom Links Section -->
            <div class="fm-sidebar-section" id="fmCustomSection">
                <div class="fm-sidebar-header" onclick="fmToggleSection('fmCustomSection')">
                    <span><i class="fas fa-link me-2"></i>Custom Links</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="fm-sidebar-content">
                    <div class="fm-link-form">
                        <div>
                            <label>URL</label>
                            <input type="text" id="fmCustomUrl" placeholder="https://">
                        </div>
                        <div>
                            <label>Link Text</label>
                            <input type="text" id="fmCustomText" placeholder="Menu item title">
                        </div>
                    </div>
                </div>
                <div class="fm-sidebar-footer">
                    <span></span>
                    <button class="fm-add-btn" onclick="fmAddCustomLink()">
                        <i class="fas fa-plus me-1"></i>Add
                    </button>
                </div>
            </div>

            <!-- Target Menu Selection -->
            <div class="fm-sidebar-section" id="fmTargetSection">
                <div class="fm-sidebar-header" onclick="fmToggleSection('fmTargetSection')">
                    <span><i class="fas fa-bullseye me-2"></i>Add To</span>
                    <i class="fas fa-chevron-down toggle-icon"></i>
                </div>
                <div class="fm-sidebar-content">
                    <div class="fm-page-list">
                        <div class="fm-page-item">
                            <input type="radio" name="targetMenu" id="targetNavigate" value="navigate" checked>
                            <label for="targetNavigate">Navigate Menu</label>
                        </div>
                        <div class="fm-page-item">
                            <input type="radio" name="targetMenu" id="targetCourses" value="courses">
                            <label for="targetCourses">Courses Menu</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content: Menu Sections -->
        <div class="fm-main">
            <!-- Navigate Menu Card -->
            <div class="fm-menu-card">
                <div class="fm-menu-header">
                    <h5><i class="fas fa-compass me-2"></i>Navigate Menu</h5>
                    <input type="text" class="fm-title-input" id="fmNavigateTitle" value="Navigate" placeholder="Section Title">
                </div>
                <div class="fm-menu-body" id="fmNavigateMenu">
                    <div class="fm-empty" id="fmNavigateEmpty">
                        <i class="fas fa-mouse-pointer"></i>
                        <p>Add items from the left panel</p>
                    </div>
                </div>
            </div>

            <!-- Courses Menu Card -->
            <div class="fm-menu-card">
                <div class="fm-menu-header">
                    <h5><i class="fas fa-graduation-cap me-2"></i>Courses Menu</h5>
                    <input type="text" class="fm-title-input" id="fmCoursesTitle" value="Courses" placeholder="Section Title">
                </div>
                <div class="fm-menu-body" id="fmCoursesMenu">
                    <div class="fm-empty" id="fmCoursesEmpty">
                        <i class="fas fa-mouse-pointer"></i>
                        <p>Add items from the left panel</p>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <button class="fm-save-btn" onclick="fmSaveAll()">
                <i class="fas fa-save me-2"></i>Save All Footer Menus
            </button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Footer Manager Data
    let fmNavigateData = [];
    let fmCoursesData = [];
    let fmDraggedItem = null;
    let fmDraggedMenu = null;

    // Toggle sidebar sections
    function fmToggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        section.classList.toggle('collapsed');
    }

    // Select all pages
    function fmSelectAllPages() {
        const checkboxes = document.querySelectorAll('#fmPagesList input[type="checkbox"]');
        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
        checkboxes.forEach(cb => cb.checked = !allChecked);
    }

    // Get target menu
    function fmGetTargetMenu() {
        const target = document.querySelector('input[name="targetMenu"]:checked').value;
        return target;
    }

    // Add selected pages to menu
    function fmAddSelectedPages() {
        const checkboxes = document.querySelectorAll('#fmPagesList input[type="checkbox"]:checked');
        const target = fmGetTargetMenu();

        if (checkboxes.length === 0) {
            fmShowToast('Please select at least one page', 'warning');
            return;
        }

        checkboxes.forEach(cb => {
            const newItem = {
                id: 'page-' + cb.dataset.pageId + '-' + Date.now() + Math.random(),
                label: cb.dataset.pageTitle,
                url: cb.dataset.pageUrl,
                type: 'Page',
                children: []
            };

            if (target === 'navigate') {
                fmNavigateData.push(newItem);
            } else {
                fmCoursesData.push(newItem);
            }
            cb.checked = false;
        });

        fmRenderMenus();
        fmShowToast(checkboxes.length + ' item(s) added', 'success');
    }

    // Add custom link
    function fmAddCustomLink() {
        const urlInput = document.getElementById('fmCustomUrl');
        const textInput = document.getElementById('fmCustomText');
        const target = fmGetTargetMenu();

        const url = urlInput.value.trim();
        const text = textInput.value.trim();

        if (!url || !text) {
            fmShowToast('Please fill in both URL and Link Text', 'warning');
            return;
        }

        const newItem = {
            id: 'custom-' + Date.now(),
            label: text,
            url: url,
            type: 'Custom Link',
            children: []
        };

        if (target === 'navigate') {
            fmNavigateData.push(newItem);
        } else {
            fmCoursesData.push(newItem);
        }

        urlInput.value = '';
        textInput.value = '';

        fmRenderMenus();
        fmShowToast('Custom link added', 'success');
    }

    // Render both menus
    function fmRenderMenus() {
        fmRenderMenu('navigate', fmNavigateData, 'fmNavigateMenu', 'fmNavigateEmpty');
        fmRenderMenu('courses', fmCoursesData, 'fmCoursesMenu', 'fmCoursesEmpty');
    }

    // Render a single menu
    function fmRenderMenu(menuName, data, containerId, emptyId) {
        const container = document.getElementById(containerId);
        const emptyState = document.getElementById(emptyId);

        if (data.length === 0) {
            container.innerHTML = '';
            container.appendChild(emptyState);
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';
        container.innerHTML = fmRenderItems(data, 0, menuName);
        fmSetupDragAndDrop(menuName);
    }

    // Render menu items recursively (unlimited nesting)
    function fmRenderItems(items, depth, menuName) {
        let html = '';

        items.forEach((item, index) => {
            const isFirst = index === 0;
            const isLast = index === items.length - 1;
            const hasChildren = item.children && item.children.length > 0;

            html += `
                <div class="fm-item" data-item-id="${item.id}" data-depth="${depth}" data-menu="${menuName}" draggable="true">
                    <div class="fm-item-bar">
                        <span class="fm-item-handle"><i class="fas fa-grip-vertical"></i></span>
                        <span class="fm-depth-indicator">${depth + 1}</span>
                        <span class="fm-item-title">${item.label}</span>
                        <span class="fm-item-type">${item.type || 'Page'}</span>
                        <button class="fm-item-toggle" onclick="fmToggleItem('${item.id}', '${menuName}')">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    <div class="fm-item-settings">
                        <div class="fm-setting-row">
                            <label>Navigation Label</label>
                            <input type="text" value="${item.label}" onchange="fmUpdateItemLabel('${item.id}', this.value, '${menuName}')">
                        </div>
                        <div class="fm-setting-row">
                            <label>URL</label>
                            <input type="text" value="${item.url}" onchange="fmUpdateItemUrl('${item.id}', this.value, '${menuName}')">
                        </div>
                        <div class="fm-item-actions">
                            <div class="fm-action-btns">
                                <button class="fm-action-btn" onclick="fmMoveItem('${item.id}', -1, '${menuName}')" ${isFirst ? 'disabled' : ''} title="Move Up">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                                <button class="fm-action-btn" onclick="fmMoveItem('${item.id}', 1, '${menuName}')" ${isLast ? 'disabled' : ''} title="Move Down">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                                ${!isFirst ? `<button class="fm-action-btn" onclick="fmIndentItem('${item.id}', '${menuName}')" title="Make Sub-item"><i class="fas fa-indent"></i></button>` : ''}
                                ${depth > 0 ? `<button class="fm-action-btn" onclick="fmOutdentItem('${item.id}', '${menuName}')" title="Move Out"><i class="fas fa-outdent"></i></button>` : ''}
                            </div>
                            <button class="fm-action-btn danger" onclick="fmRemoveItem('${item.id}', '${menuName}')">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                    ${hasChildren ? `<div class="fm-submenu">${fmRenderItems(item.children, depth + 1, menuName)}</div>` : ''}
                </div>
            `;
        });

        return html;
    }

    // Toggle item expand/collapse
    function fmToggleItem(itemId, menuName) {
        const itemEl = document.querySelector(`.fm-item[data-item-id="${itemId}"][data-menu="${menuName}"]`);
        if (itemEl) {
            itemEl.classList.toggle('expanded');
        }
    }

    // Get menu data by name
    function fmGetMenuData(menuName) {
        return menuName === 'navigate' ? fmNavigateData : fmCoursesData;
    }

    // Find item in menu
    function fmFindItem(items, id) {
        for (let item of items) {
            if (item.id == id) return item;
            if (item.children && item.children.length > 0) {
                const found = fmFindItem(item.children, id);
                if (found) return found;
            }
        }
        return null;
    }

    // Update item label
    function fmUpdateItemLabel(itemId, newLabel, menuName) {
        const data = fmGetMenuData(menuName);
        const item = fmFindItem(data, itemId);
        if (item) {
            item.label = newLabel;
            const titleEl = document.querySelector(`.fm-item[data-item-id="${itemId}"] .fm-item-title`);
            if (titleEl) titleEl.textContent = newLabel;
        }
    }

    // Update item URL
    function fmUpdateItemUrl(itemId, newUrl, menuName) {
        const data = fmGetMenuData(menuName);
        const item = fmFindItem(data, itemId);
        if (item) {
            item.url = newUrl;
        }
    }

    // Move item up/down
    function fmMoveItem(itemId, direction, menuName) {
        const data = fmGetMenuData(menuName);

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

        if (findAndMove(data)) {
            fmRenderMenus();
        }
    }

    // Indent item (make submenu) - unlimited nesting
    function fmIndentItem(itemId, menuName) {
        const data = fmGetMenuData(menuName);

        function findAndIndent(items, parent = null) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId) {
                    if (i === 0) return false;

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

        if (findAndIndent(data)) {
            fmRenderMenus();
            fmShowToast('Item moved to submenu', 'success');
        }
    }

    // Outdent item (remove from submenu)
    function fmOutdentItem(itemId, menuName) {
        const data = fmGetMenuData(menuName);

        function findAndOutdent(items, parentItems = null, grandparentItems = null) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == itemId && parentItems !== null) {
                    const item = items.splice(i, 1)[0];

                    if (grandparentItems) {
                        const parentIndex = grandparentItems.findIndex(p => p.children === items);
                        if (parentIndex !== -1) {
                            grandparentItems.splice(parentIndex + 1, 0, item);
                        }
                    } else {
                        data.push(item);
                    }
                    return true;
                }
                if (items[i].children && findAndOutdent(items[i].children, items, parentItems || data)) {
                    return true;
                }
            }
            return false;
        }

        if (findAndOutdent(data)) {
            fmRenderMenus();
            fmShowToast('Item moved out of submenu', 'success');
        }
    }

    // Remove item
    function fmRemoveItem(itemId, menuName) {
        if (!confirm('Remove this item?')) return;

        function removeFromArray(items) {
            return items.filter(item => {
                if (item.id == itemId) return false;
                if (item.children) item.children = removeFromArray(item.children);
                return true;
            });
        }

        if (menuName === 'navigate') {
            fmNavigateData = removeFromArray(fmNavigateData);
        } else {
            fmCoursesData = removeFromArray(fmCoursesData);
        }

        fmRenderMenus();
        fmShowToast('Item removed', 'success');
    }

    // WordPress-style drag-to-indent variables for footer
    let fmDragStartX = 0;
    let fmDragCurrentX = 0;
    let fmDropTarget = null;
    let fmDropMode = 'before'; // 'before', 'after', 'child'
    const FM_INDENT_THRESHOLD = 50; // pixels to drag right to make it a child

    // Setup drag and drop (WordPress style with indent)
    function fmSetupDragAndDrop(menuName) {
        const items = document.querySelectorAll(`.fm-item[data-menu="${menuName}"]`);
        const container = document.getElementById(menuName === 'navigate' ? 'fmNavigateMenu' : 'fmCoursesMenu');

        // Remove existing listeners by cloning
        items.forEach(item => {
            const newItem = item.cloneNode(true);
            item.parentNode.replaceChild(newItem, item);
        });

        // Re-select items after clone
        const freshItems = document.querySelectorAll(`.fm-item[data-menu="${menuName}"]`);

        freshItems.forEach(item => {
            // Drag start
            item.addEventListener('dragstart', function(e) {
                e.stopPropagation();
                fmDraggedItem = this.dataset.itemId;
                fmDraggedMenu = this.dataset.menu;
                fmDragStartX = e.clientX;
                this.classList.add('dragging');

                // Set drag image
                const dragImg = document.createElement('div');
                dragImg.style.cssText = `
                    position: absolute;
                    top: -1000px;
                    padding: 8px 12px;
                    background: var(--primary-color);
                    color: white;
                    border-radius: 4px;
                    font-weight: 500;
                    font-size: 12px;
                `;
                dragImg.textContent = this.querySelector('.fm-item-title').textContent;
                document.body.appendChild(dragImg);
                e.dataTransfer.setDragImage(dragImg, 0, 0);
                setTimeout(() => dragImg.remove(), 0);
            });

            // Drag end
            item.addEventListener('dragend', function(e) {
                this.classList.remove('dragging');

                // Clear all drop indicators
                document.querySelectorAll('.fm-item').forEach(i => {
                    i.classList.remove('drop-target', 'drop-as-child');
                });

                // Perform the drop if we have a target
                if (fmDraggedItem && fmDropTarget && fmDraggedItem !== fmDropTarget && fmDraggedMenu === this.dataset.menu) {
                    if (fmDropMode === 'child') {
                        // Make dragged item a child of target
                        fmMakeChildOf(fmDraggedItem, fmDropTarget, fmDraggedMenu);
                    } else {
                        // Reorder items (place before target)
                        fmReorderItems(fmDraggedItem, fmDropTarget, fmDraggedMenu);
                    }
                }

                fmDraggedItem = null;
                fmDraggedMenu = null;
                fmDropTarget = null;
                fmDropMode = 'before';
            });

            // Drag over - detect horizontal position for indent
            item.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();

                if (!fmDraggedItem || fmDraggedItem === this.dataset.itemId || fmDraggedMenu !== this.dataset.menu) return;

                fmDragCurrentX = e.clientX;
                fmDropTarget = this.dataset.itemId;

                // Clear previous indicators
                document.querySelectorAll('.fm-item').forEach(i => {
                    i.classList.remove('drop-target', 'drop-as-child');
                });

                // Calculate horizontal offset from drag start
                const horizontalOffset = fmDragCurrentX - fmDragStartX;

                // Get the item's bounding rect for position detection
                const rect = this.getBoundingClientRect();
                const relativeX = e.clientX - rect.left;

                // Determine drop mode based on horizontal drag distance
                if (horizontalOffset > FM_INDENT_THRESHOLD || relativeX > 100) {
                    // Dragging right = make it a child
                    fmDropMode = 'child';
                    this.classList.add('drop-as-child');
                } else {
                    // Normal drop = place before
                    fmDropMode = 'before';
                    this.classList.add('drop-target');
                }
            });

            // Drag leave
            item.addEventListener('dragleave', function(e) {
                this.classList.remove('drop-target', 'drop-as-child');
            });
        });

        // Handle drop on container (for root level)
        if (container) {
            container.addEventListener('dragover', function(e) {
                e.preventDefault();
            });

            container.addEventListener('drop', function(e) {
                // Only handle if dropped directly on container
                if (e.target === container || e.target.classList.contains('fm-menu-body')) {
                    e.preventDefault();
                    if (fmDraggedItem && fmDraggedMenu) {
                        fmMoveToRootEnd(fmDraggedItem, fmDraggedMenu);
                    }
                }
            });
        }
    }

    // Make item a child of another item
    function fmMakeChildOf(itemId, parentId, menuName) {
        const data = fmGetMenuData(menuName);
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

        removeItem(data);
        if (itemToMove) {
            if (addAsChild(data)) {
                fmRenderMenus();
                fmShowToast('Item moved to submenu', 'success');
            }
        }
    }

    // Move item to root level at end
    function fmMoveToRootEnd(itemId, menuName) {
        const data = fmGetMenuData(menuName);
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

        removeItem(data);
        if (itemToMove) {
            data.push(itemToMove);
            fmRenderMenus();
        }
    }

    // Reorder items
    function fmReorderItems(sourceId, targetId, menuName) {
        const data = fmGetMenuData(menuName);
        let sourceItem = null;

        function findAndRemove(items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].id == sourceId) {
                    sourceItem = items.splice(i, 1)[0];
                    return true;
                }
                if (items[i].children && findAndRemove(items[i].children)) {
                    return true;
                }
            }
            return false;
        }

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

        findAndRemove(data);
        if (sourceItem) {
            findAndInsert(data);
            fmRenderMenus();
        }
    }

    // Load existing menus
    async function fmLoadMenus() {
        try {
            const response = await fetch('/admin/footer-manager/get-menus');
            const data = await response.json();

            if (data.success) {
                document.getElementById('fmNavigateTitle').value = data.menus.navigate.title || 'Navigate';
                document.getElementById('fmCoursesTitle').value = data.menus.courses.title || 'Courses';

                fmNavigateData = fmConvertToMenuFormat(data.menus.navigate.links || []);
                fmCoursesData = fmConvertToMenuFormat(data.menus.courses.links || []);

                fmRenderMenus();
            }
        } catch (error) {
            console.error('Error loading menus:', error);
        }
    }

    // Convert backend format to menu format
    function fmConvertToMenuFormat(items) {
        return items.map((item, index) => ({
            id: 'loaded-' + index + '-' + Date.now() + Math.random(),
            label: item.label,
            url: item.url,
            type: item.url && item.url.startsWith('http') ? 'Custom Link' : 'Page',
            children: item.children ? fmConvertToMenuFormat(item.children) : []
        }));
    }

    // Convert to save format
    function fmConvertToSaveFormat(items) {
        return items.map(item => ({
            label: item.label,
            url: item.url,
            children: item.children && item.children.length > 0 ? fmConvertToSaveFormat(item.children) : []
        }));
    }

    // Save all menus
    async function fmSaveAll() {
        const data = {
            navigate: {
                title: document.getElementById('fmNavigateTitle').value,
                links: fmConvertToSaveFormat(fmNavigateData)
            },
            courses: {
                title: document.getElementById('fmCoursesTitle').value,
                links: fmConvertToSaveFormat(fmCoursesData)
            }
        };

        try {
            const response = await fetch('/admin/footer-manager/save-menus', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                fmShowSuccess(result.message || 'Footer menus saved successfully!');
            } else {
                fmShowToast('Error saving menus', 'error');
            }
        } catch (error) {
            fmShowToast('Error saving menus', 'error');
            console.error(error);
        }
    }

    // Show success alert
    function fmShowSuccess(message) {
        const alert = document.getElementById('fmSuccessAlert');
        const msgEl = document.getElementById('fmSuccessMessage');

        if (alert && msgEl) {
            msgEl.textContent = message;
            alert.classList.add('show');

            setTimeout(() => {
                alert.classList.remove('show');
            }, 5000);
        }
    }

    // Show toast notification
    function fmShowToast(message, type = 'success') {
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

    // Load menus on page load
    window.addEventListener('DOMContentLoaded', fmLoadMenus);
</script>
@endsection
