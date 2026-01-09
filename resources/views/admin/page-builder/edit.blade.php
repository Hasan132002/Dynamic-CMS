@extends('admin.layouts.app')

@section('title', 'Edit: ' . $page['title'])

@section('styles')
<style>
    .builder-container {
        display: flex;
        gap: 20px;
        min-height: calc(100vh - 150px);
    }

    /* Section Library Sidebar */
    .section-library {
        width: 300px;
        flex-shrink: 0;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 150px);
        position: sticky;
        top: 20px;
    }

    .library-header {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .library-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .library-search {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }

    .library-search input {
        width: 100%;
        padding: 10px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 13px;
    }

    .library-search input:focus {
        border-color: #667eea;
        outline: none;
    }

    .library-content {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
    }

    .library-category {
        margin-bottom: 15px;
    }

    .library-category-title {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: #888;
        padding: 8px 10px;
        letter-spacing: 0.5px;
    }

    .section-item {
        background: #f8f9fa;
        border: 2px solid transparent;
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 8px;
        cursor: grab;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-item:hover {
        border-color: #667eea;
        background: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
    }

    .section-item:active {
        cursor: grabbing;
    }

    .section-item-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        flex-shrink: 0;
    }

    .section-item-info h4 {
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 3px 0;
    }

    .section-item-info p {
        font-size: 11px;
        color: #888;
        margin: 0;
        line-height: 1.3;
    }

    /* Page Canvas */
    .page-canvas {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .canvas-header {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        padding: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .canvas-header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .canvas-header h2 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
        color: #1a1a2e;
    }

    .page-status-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .page-status-badge.published {
        background: #d4edda;
        color: #155724;
    }

    .page-status-badge.draft {
        background: #fff3cd;
        color: #856404;
    }

    .canvas-header-right {
        display: flex;
        gap: 10px;
    }

    .btn-canvas {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-settings {
        background: #f0f0f0;
        color: #555;
    }

    .btn-settings:hover {
        background: #e0e0e0;
    }

    .btn-preview {
        background: #e8f4fd;
        color: #0d6efd;
    }

    .btn-preview:hover {
        background: #0d6efd;
        color: white;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-save:hover {
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-save.saving {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Sections Area */
    .sections-area {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        flex: 1;
        min-height: 400px;
        position: relative;
    }

    .sections-list {
        padding: 20px;
        min-height: 300px;
    }

    .section-block {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        margin-bottom: 15px;
        overflow: hidden;
        transition: all 0.2s ease;
    }

    .section-block:hover {
        border-color: #667eea;
    }

    .section-block.sortable-ghost {
        opacity: 0.4;
        background: #667eea;
    }

    .section-block.sortable-chosen {
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }

    .section-block-header {
        padding: 15px 20px;
        background: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e0e0e0;
        cursor: grab;
    }

    .section-block-header:active {
        cursor: grabbing;
    }

    .section-block-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .drag-handle {
        color: #ccc;
        cursor: grab;
    }

    .section-type-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
    }

    .section-block-info h4 {
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 3px 0;
        color: #1a1a2e;
    }

    .section-block-info span {
        font-size: 11px;
        color: #888;
    }

    .section-block-actions {
        display: flex;
        gap: 5px;
    }

    .section-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        font-size: 13px;
    }

    .section-btn.btn-visibility {
        background: #e8f8ea;
        color: #198754;
    }

    .section-btn.btn-visibility.hidden {
        background: #f8f8f8;
        color: #999;
    }

    .section-btn.btn-edit {
        background: #e8f4fd;
        color: #0d6efd;
    }

    .section-btn.btn-duplicate {
        background: #fff8e6;
        color: #cc8a00;
    }

    .section-btn.btn-delete {
        background: #fde8e8;
        color: #dc3545;
    }

    .section-btn:hover {
        transform: scale(1.1);
    }

    /* Section Content Preview */
    .section-block-preview {
        padding: 15px 20px;
        background: #fafafa;
        font-size: 12px;
        color: #666;
        border-top: 1px dashed #e0e0e0;
    }

    /* Empty State */
    .empty-canvas {
        text-align: center;
        padding: 60px 20px;
        color: #888;
    }

    .empty-canvas-icon {
        width: 80px;
        height: 80px;
        background: #f0f0f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .empty-canvas-icon i {
        font-size: 36px;
        color: #ccc;
    }

    .empty-canvas h3 {
        font-size: 18px;
        color: #555;
        margin-bottom: 10px;
    }

    .empty-canvas p {
        margin-bottom: 0;
    }

    /* Drop Zone Indicator */
    .drop-zone {
        border: 3px dashed #667eea;
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        background: rgba(102, 126, 234, 0.05);
        margin-bottom: 15px;
        display: none;
    }

    .drop-zone.active {
        display: block;
    }

    /* Section Editor Modal */
    .section-editor-modal .modal-dialog {
        max-width: 800px;
    }

    .section-editor-modal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 0;
    }

    .section-editor-modal .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .editor-tabs {
        display: flex;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
    }

    .editor-tab {
        padding: 12px 24px;
        border: none;
        background: none;
        font-weight: 500;
        color: #888;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        transition: all 0.2s ease;
    }

    .editor-tab:hover {
        color: #667eea;
    }

    .editor-tab.active {
        color: #667eea;
        border-bottom-color: #667eea;
    }

    .editor-tab-content {
        display: none;
    }

    .editor-tab-content.active {
        display: block;
    }

    .field-group {
        margin-bottom: 20px;
    }

    .field-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #333;
    }

    .field-group .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
    }

    .field-group .form-control:focus {
        border-color: #667eea;
        outline: none;
    }

    /* Style Controls */
    .style-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .color-picker-wrapper input[type="color"] {
        width: 50px;
        height: 40px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .color-picker-wrapper input[type="text"] {
        flex: 1;
    }

    /* Image Upload */
    .image-upload-area {
        border: 2px dashed #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .image-upload-area:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .image-upload-area img {
        max-width: 100%;
        max-height: 150px;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    /* Repeater Fields */
    .repeater-items {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .repeater-item {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
        background: #fafafa;
    }

    .repeater-item:last-child {
        border-bottom: none;
    }

    .repeater-item-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .btn-add-item {
        padding: 10px 20px;
        background: #f0f0f0;
        border: 2px dashed #ccc;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        transition: all 0.2s ease;
    }

    .btn-add-item:hover {
        border-color: #667eea;
        color: #667eea;
    }

    /* Gallery Field Styles */
    .gallery-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 10px;
    }

    .gallery-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        border: 1px solid #e0e0e0;
    }

    .gallery-item-preview {
        position: relative;
        margin-bottom: 10px;
    }

    .gallery-item-preview img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
    }

    .gallery-item-remove {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 24px;
        height: 24px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.2s ease;
    }

    .gallery-item-remove:hover {
        background: #dc3545;
        transform: scale(1.1);
    }

    /* Page Settings Modal */
    .settings-modal .modal-body {
        padding: 25px;
    }

    .settings-section {
        margin-bottom: 25px;
    }

    .settings-section h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1a1a2e;
    }

    /* Saved Indicator */
    .save-indicator {
        display: none;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        background: #d4edda;
        color: #155724;
        border-radius: 8px;
        font-size: 13px;
    }

    .save-indicator.show {
        display: flex;
        animation: fadeInOut 3s ease;
    }

    @keyframes fadeInOut {
        0%, 100% { opacity: 0; }
        10%, 90% { opacity: 1; }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .builder-container {
            flex-direction: column;
        }

        .section-library {
            width: 100%;
            max-height: 300px;
            position: relative;
        }
    }
</style>
@endsection

@section('content')
<div class="builder-container">
    <!-- Section Library Sidebar -->
    <aside class="section-library">
        <div class="library-header">
            <h3><i class="fas fa-puzzle-piece me-2"></i>Section Library</h3>
        </div>
        <div class="library-search">
            <input type="text" id="sectionSearch" placeholder="Search sections...">
        </div>
        <div class="library-content">
            @foreach($sectionLibrary as $categoryKey => $category)
                <div class="library-category" data-category="{{ $categoryKey }}">
                    <div class="library-category-title">{{ $category['category'] }}</div>
                    @foreach($category['sections'] as $sectionKey => $section)
                        <div class="section-item" draggable="true" data-section-type="{{ $sectionKey }}" data-section-name="{{ $section['name'] }}">
                            <div class="section-item-icon">
                                @if(str_contains($sectionKey, 'hero'))
                                    <i class="fas fa-image"></i>
                                @elseif(str_contains($sectionKey, 'about'))
                                    <i class="fas fa-info-circle"></i>
                                @elseif(str_contains($sectionKey, 'feature'))
                                    <i class="fas fa-star"></i>
                                @elseif(str_contains($sectionKey, 'text'))
                                    <i class="fas fa-align-left"></i>
                                @elseif(str_contains($sectionKey, 'image'))
                                    <i class="fas fa-image"></i>
                                @elseif(str_contains($sectionKey, 'cta'))
                                    <i class="fas fa-bullhorn"></i>
                                @elseif(str_contains($sectionKey, 'testimonial'))
                                    <i class="fas fa-quote-left"></i>
                                @elseif(str_contains($sectionKey, 'contact'))
                                    <i class="fas fa-envelope"></i>
                                @elseif(str_contains($sectionKey, 'gallery'))
                                    <i class="fas fa-images"></i>
                                @elseif(str_contains($sectionKey, 'team'))
                                    <i class="fas fa-users"></i>
                                @elseif(str_contains($sectionKey, 'faq'))
                                    <i class="fas fa-question-circle"></i>
                                @elseif(str_contains($sectionKey, 'spacer'))
                                    <i class="fas fa-arrows-alt-v"></i>
                                @elseif(str_contains($sectionKey, 'divider'))
                                    <i class="fas fa-minus"></i>
                                @else
                                    <i class="fas fa-cube"></i>
                                @endif
                            </div>
                            <div class="section-item-info">
                                <h4>{{ $section['name'] }}</h4>
                                <p>{{ Str::limit($section['description'], 40) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </aside>

    <!-- Page Canvas -->
    <main class="page-canvas">
        <div class="canvas-header">
            <div class="canvas-header-left">
                <a href="{{ route('admin.page-builder.index') }}" class="btn-canvas btn-settings">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2>{{ $page['title'] }}</h2>
                <span class="page-status-badge {{ $page['status'] }}">{{ ucfirst($page['status']) }}</span>
            </div>
            <div class="canvas-header-right">
                <div class="save-indicator" id="saveIndicator">
                    <i class="fas fa-check"></i> Saved
                </div>
                <button class="btn-canvas btn-settings" onclick="openPageSettings()">
                    <i class="fas fa-cog"></i> Settings
                </button>
                @if($page['status'] === 'published')
                    <a href="/{{ $page['slug'] }}" target="_blank" class="btn-canvas btn-preview">
                        <i class="fas fa-external-link-alt"></i> View Page
                    </a>
                @endif
                <button class="btn-canvas btn-save" id="saveBtn" onclick="saveSections()">
                    <i class="fas fa-save"></i> Save
                </button>
            </div>
        </div>

        <div class="sections-area">
            <div class="sections-list" id="sectionsList">
                @if(count($page['sections'] ?? []) > 0)
                    @foreach($page['sections'] as $section)
                        @include('admin.page-builder.partials.section-block', ['section' => $section, 'sectionLibrary' => $sectionLibrary])
                    @endforeach
                @else
                    <div class="empty-canvas" id="emptyCanvas">
                        <div class="empty-canvas-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <h3>Start Building Your Page</h3>
                        <p>Drag sections from the library and drop them here</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

<!-- Section Editor Modal -->
<div class="modal fade section-editor-modal" id="sectionEditorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i><span id="editorSectionName">Edit Section</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="editor-tabs">
                    <button class="editor-tab active" data-tab="content">Content</button>
                    <button class="editor-tab" data-tab="styles">Styles</button>
                </div>

                <div class="editor-tab-content active" id="contentTab">
                    <div id="sectionFields">
                        <!-- Dynamic fields will be loaded here -->
                    </div>
                </div>

                <div class="editor-tab-content" id="stylesTab">
                    <div class="style-row">
                        <div class="field-group">
                            <label>Background Color</label>
                            <div class="color-picker-wrapper">
                                <input type="color" id="styleBgColor" value="#ffffff">
                                <input type="text" class="form-control" id="styleBgColorText" placeholder="#ffffff">
                            </div>
                        </div>
                        <div class="field-group">
                            <label>Text Color</label>
                            <div class="color-picker-wrapper">
                                <input type="color" id="styleTextColor" value="#333333">
                                <input type="text" class="form-control" id="styleTextColorText" placeholder="#333333">
                            </div>
                        </div>
                    </div>
                    <div class="style-row">
                        <div class="field-group">
                            <label>Padding Top (px)</label>
                            <input type="number" class="form-control" id="stylePaddingTop" value="60">
                        </div>
                        <div class="field-group">
                            <label>Padding Bottom (px)</label>
                            <input type="number" class="form-control" id="stylePaddingBottom" value="60">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveSectionChanges()">
                    <i class="fas fa-check me-1"></i> Apply Changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Page Settings Modal -->
<div class="modal fade settings-modal" id="pageSettingsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-cog me-2"></i>Page Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="settings-section">
                    <h4>Basic Information</h4>
                    <div class="field-group">
                        <label>Page Title</label>
                        <input type="text" class="form-control" id="settingsTitle" value="{{ $page['title'] }}">
                    </div>
                    <div class="field-group">
                        <label>URL Slug</label>
                        <input type="text" class="form-control" id="settingsSlug" value="{{ $page['slug'] }}">
                    </div>
                </div>

                <div class="settings-section">
                    <h4>SEO Settings</h4>
                    <div class="field-group">
                        <label>Meta Title</label>
                        <input type="text" class="form-control" id="settingsMetaTitle" value="{{ $page['meta']['title'] ?? '' }}">
                    </div>
                    <div class="field-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" id="settingsMetaDesc" rows="3">{{ $page['meta']['description'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Template</h4>
                    <div class="field-group">
                        <select class="form-control" id="settingsTemplate">
                            @foreach($templates as $key => $template)
                                <option value="{{ $key }}" {{ ($page['template'] ?? 'default') === $key ? 'selected' : '' }}>
                                    {{ $template['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Status</h4>
                    <div class="field-group">
                        <select class="form-control" id="settingsStatus">
                            <option value="draft" {{ $page['status'] === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $page['status'] === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="savePageSettings()">
                    <i class="fas fa-check me-1"></i> Save Settings
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Media Library Modal -->
<div class="modal fade" id="mediaLibraryModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <h5 class="modal-title"><i class="fas fa-images me-2"></i>Media Library</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <!-- Search and Filter Bar -->
                <div class="media-toolbar p-3 border-bottom bg-light">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="mediaSearchInput" placeholder="Search images...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="mediaFolderFilter">
                                <option value="">All Folders</option>
                            </select>
                        </div>
                        <div class="col-md-3 text-end">
                            <span class="text-muted" id="mediaCount">0 images</span>
                        </div>
                    </div>
                </div>
                <!-- Media Grid -->
                <div id="mediaLibraryContent" style="max-height: 60vh; overflow-y: auto; padding: 20px;">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Loading media library...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }

    .media-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.2s ease;
        background: #f8f9fa;
    }

    .media-item:hover {
        border-color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
    }

    .media-item.selected {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
    }

    .media-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        display: block;
    }

    .media-item-info {
        padding: 8px 10px;
        background: white;
        border-top: 1px solid #eee;
    }

    .media-item-name {
        font-size: 11px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 500;
    }

    .media-item-meta {
        font-size: 10px;
        color: #888;
        margin-top: 2px;
    }

    .media-item-overlay {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 24px;
        height: 24px;
        background: #667eea;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .media-item.selected .media-item-overlay {
        display: flex;
    }

    .media-empty {
        text-align: center;
        padding: 60px 20px;
        color: #888;
    }

    .media-empty i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #ddd;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const pageSlug = '{{ $page['slug'] }}';
    let currentEditingSection = null;
    let sectionsData = @json($page['sections'] ?? []);
    const sectionLibrary = @json($sectionLibrary);

    // Initialize Sortable for sections list
    const sectionsList = document.getElementById('sectionsList');
    const sortable = new Sortable(sectionsList, {
        animation: 150,
        handle: '.section-block-header',
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd: function(evt) {
            updateSectionsOrder();
        }
    });

    // Make section items draggable to canvas
    document.querySelectorAll('.section-item').forEach(item => {
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('click', () => addSectionToCanvas(item.dataset.sectionType));
    });

    sectionsList.addEventListener('dragover', handleDragOver);
    sectionsList.addEventListener('drop', handleDrop);

    function handleDragStart(e) {
        e.dataTransfer.setData('text/plain', e.target.dataset.sectionType);
    }

    function handleDragOver(e) {
        e.preventDefault();
    }

    function handleDrop(e) {
        e.preventDefault();
        const sectionType = e.dataTransfer.getData('text/plain');
        if (sectionType) {
            addSectionToCanvas(sectionType);
        }
    }

    // Add section to canvas
    function addSectionToCanvas(sectionType) {
        const saveBtn = document.getElementById('saveBtn');
        saveBtn.classList.add('saving');
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

        fetch(`/admin/page-builder/${pageSlug}/sections/add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ section_type: sectionType })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove empty state if exists
                const emptyCanvas = document.getElementById('emptyCanvas');
                if (emptyCanvas) emptyCanvas.remove();

                // Add new section block
                sectionsData.push(data.section);
                const sectionHtml = createSectionBlockHtml(data.section);
                sectionsList.insertAdjacentHTML('beforeend', sectionHtml);

                showSaveIndicator();
            } else {
                alert(data.message || 'Failed to add section');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        })
        .finally(() => {
            saveBtn.classList.remove('saving');
            saveBtn.innerHTML = '<i class="fas fa-save"></i> Save';
        });
    }

    // Create section block HTML
    function createSectionBlockHtml(section) {
        const sectionName = getSectionName(section.type);
        const isVisible = section.visible !== false;

        return `
            <div class="section-block" data-section-id="${section.id}">
                <div class="section-block-header">
                    <div class="section-block-left">
                        <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
                        <div class="section-type-icon">
                            <i class="fas fa-cube"></i>
                        </div>
                        <div class="section-block-info">
                            <h4>${sectionName}</h4>
                            <span>${section.type}</span>
                        </div>
                    </div>
                    <div class="section-block-actions">
                        <button class="section-btn btn-visibility ${isVisible ? '' : 'hidden'}"
                                onclick="toggleSectionVisibility('${section.id}')"
                                title="${isVisible ? 'Hide' : 'Show'}">
                            <i class="fas fa-eye${isVisible ? '' : '-slash'}"></i>
                        </button>
                        <button class="section-btn btn-edit" onclick="editSection('${section.id}')" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="section-btn btn-duplicate" onclick="duplicateSection('${section.id}')" title="Duplicate">
                            <i class="fas fa-copy"></i>
                        </button>
                        <button class="section-btn btn-delete" onclick="deleteSection('${section.id}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Get section name from library
    function getSectionName(type) {
        for (const category of Object.values(sectionLibrary)) {
            if (category.sections && category.sections[type]) {
                return category.sections[type].name;
            }
        }
        return type;
    }

    // Update sections order after drag
    function updateSectionsOrder() {
        const newOrder = [];
        document.querySelectorAll('.section-block').forEach(block => {
            newOrder.push(block.dataset.sectionId);
        });

        fetch(`/admin/page-builder/${pageSlug}/sections/reorder`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ order: newOrder })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSaveIndicator();
            }
        });
    }

    // Toggle section visibility
    function toggleSectionVisibility(sectionId) {
        const section = sectionsData.find(s => s.id === sectionId);
        if (!section) return;

        const newVisibility = section.visible === false ? true : false;

        fetch(`/admin/page-builder/${pageSlug}/sections/${sectionId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ visible: newVisibility })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                section.visible = newVisibility;
                const btn = document.querySelector(`.section-block[data-section-id="${sectionId}"] .btn-visibility`);
                btn.classList.toggle('hidden', !newVisibility);
                btn.querySelector('i').className = `fas fa-eye${newVisibility ? '' : '-slash'}`;
                btn.title = newVisibility ? 'Hide' : 'Show';
                showSaveIndicator();
            }
        });
    }

    // Edit section
    function editSection(sectionId) {
        currentEditingSection = sectionsData.find(s => s.id === sectionId);
        if (!currentEditingSection) return;

        // Get section template
        let template = null;
        for (const category of Object.values(sectionLibrary)) {
            if (category.sections && category.sections[currentEditingSection.type]) {
                template = category.sections[currentEditingSection.type];
                break;
            }
        }

        if (!template) {
            alert('Section template not found');
            return;
        }

        // Update modal title
        document.getElementById('editorSectionName').textContent = template.name;

        // Generate content fields
        const fieldsContainer = document.getElementById('sectionFields');
        fieldsContainer.innerHTML = generateFieldsHtml(template.fields, currentEditingSection.data);

        // Update style fields
        const styles = currentEditingSection.styles || {};
        document.getElementById('styleBgColor').value = styles.background_color || '#ffffff';
        document.getElementById('styleBgColorText').value = styles.background_color || '';
        document.getElementById('styleTextColor').value = styles.text_color || '#333333';
        document.getElementById('styleTextColorText').value = styles.text_color || '';
        document.getElementById('stylePaddingTop').value = styles.padding_top || '60';
        document.getElementById('stylePaddingBottom').value = styles.padding_bottom || '60';

        // Show modal
        new bootstrap.Modal(document.getElementById('sectionEditorModal')).show();
    }

    // Generate fields HTML
    function generateFieldsHtml(fields, data) {
        let html = '';

        // Handle sections without fields (partial-only sections)
        if (!fields || !Array.isArray(fields) || fields.length === 0) {
            return `
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Template-based Section</strong>
                    <p class="mb-0 mt-2">This section uses a pre-designed template and doesn't have custom editable fields.
                    You can still adjust the styles using the Styles tab.</p>
                </div>
            `;
        }

        fields.forEach(field => {
            const value = getNestedValue(data, field.name) || '';

            switch (field.type) {
                case 'text':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <input type="text" class="form-control" data-field="${field.name}" value="${escapeHtml(value)}">
                        </div>
                    `;
                    break;

                case 'textarea':
                case 'wysiwyg':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <textarea class="form-control" data-field="${field.name}" rows="4">${escapeHtml(value)}</textarea>
                        </div>
                    `;
                    break;

                case 'richtext':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <textarea class="form-control" data-field="${field.name}" rows="3">${escapeHtml(value)}</textarea>
                            <small class="text-muted">HTML allowed (e.g., &lt;span&gt;, &lt;br&gt;)</small>
                        </div>
                    `;
                    break;

                case 'image':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <div class="image-upload-area" onclick="openMediaLibrary('${field.name}')">
                                ${value ? `<img src="/${value}" alt="">` : '<i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>'}
                                <div>${value ? 'Click to change image' : 'Click to select image'}</div>
                            </div>
                            <input type="hidden" data-field="${field.name}" value="${escapeHtml(value)}">
                        </div>
                    `;
                    break;

                case 'color':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <div class="color-picker-wrapper">
                                <input type="color" data-field="${field.name}-picker" value="${value || '#000000'}"
                                       onchange="document.querySelector('[data-field=\\'${field.name}\\']').value = this.value">
                                <input type="text" class="form-control" data-field="${field.name}" value="${escapeHtml(value)}" placeholder="#000000">
                            </div>
                        </div>
                    `;
                    break;

                case 'number':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <input type="number" class="form-control" data-field="${field.name}" value="${value}">
                        </div>
                    `;
                    break;

                case 'select':
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <select class="form-control" data-field="${field.name}">
                                ${Object.entries(field.options || {}).map(([k, v]) =>
                                    `<option value="${k}" ${value === k ? 'selected' : ''}>${v}</option>`
                                ).join('')}
                            </select>
                        </div>
                    `;
                    break;

                case 'toggle':
                    html += `
                        <div class="field-group">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" data-field="${field.name}"
                                       ${value ? 'checked' : ''}>
                                <label class="form-check-label">${field.label}</label>
                            </div>
                        </div>
                    `;
                    break;

                case 'button':
                    const btnData = value || { text: '', link: '' };
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="text" class="form-control" data-field="${field.name}.text"
                                           value="${escapeHtml(btnData.text || '')}" placeholder="Button Text">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" data-field="${field.name}.link"
                                           value="${escapeHtml(btnData.link || '')}" placeholder="Button Link">
                                </div>
                            </div>
                        </div>
                    `;
                    break;

                case 'repeater':
                    const items = Array.isArray(value) ? value : [];
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <div class="repeater-items" data-field="${field.name}" data-repeater-fields='${JSON.stringify(field.fields || [])}'>
                                ${items.map((item, idx) => generateRepeaterItemHtml(field.name, field.fields || [], item, idx)).join('')}
                            </div>
                            <button type="button" class="btn-add-item" onclick="addRepeaterItem('${field.name}')">
                                <i class="fas fa-plus me-1"></i> Add Item
                            </button>
                        </div>
                    `;
                    break;

                case 'gallery':
                    const galleryImages = Array.isArray(value) ? value : [];
                    html += `
                        <div class="field-group">
                            <label>${field.label}</label>
                            <div class="gallery-items" data-field="${field.name}">
                                ${galleryImages.map((img, idx) => {
                                    const imgSrc = typeof img === 'string' ? img : (img.src || img.url || '');
                                    const imgAlt = typeof img === 'object' ? (img.alt || '') : '';
                                    const imgCaption = typeof img === 'object' ? (img.caption || '') : '';
                                    return `
                                        <div class="gallery-item" data-index="${idx}">
                                            <div class="gallery-item-preview" style="cursor: pointer;" onclick="selectGalleryImage('${field.name}', ${idx})">
                                                <img src="/${imgSrc}" alt="${escapeHtml(imgAlt)}" style="pointer-events: none;">
                                                <button type="button" class="gallery-item-remove" onclick="event.stopPropagation(); removeGalleryItem('${field.name}', ${idx})">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                            <input type="hidden" data-field="${field.name}[${idx}].src" value="${escapeHtml(imgSrc)}">
                                            <input type="text" class="form-control form-control-sm mt-1" data-field="${field.name}[${idx}].alt" value="${escapeHtml(imgAlt)}" placeholder="Alt text">
                                            <input type="text" class="form-control form-control-sm mt-1" data-field="${field.name}[${idx}].caption" value="${escapeHtml(imgCaption)}" placeholder="Caption (optional)">
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                            <button type="button" class="btn-add-item" onclick="addGalleryImage('${field.name}')">
                                <i class="fas fa-plus me-1"></i> Add Image
                            </button>
                        </div>
                    `;
                    break;
            }
        });

        return html;
    }

    // Generate repeater item HTML
    function generateRepeaterItemHtml(fieldName, fields, data, index) {
        let html = `
            <div class="repeater-item" data-index="${index}">
                <div class="repeater-item-header">
                    <strong>Item ${index + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRepeaterItem(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
        `;

        fields.forEach(field => {
            const value = data ? data[field.name] || '' : '';

            if (field.type === 'image') {
                html += `
                    <div class="field-group mb-2">
                        <label class="small">${field.label}</label>
                        <div class="image-upload-area p-2" onclick="openMediaLibrary('${fieldName}[${index}].${field.name}')" style="min-height: 60px;">
                            ${value ? `<img src="/${value}" alt="" style="max-height: 60px;">` : '<i class="fas fa-image text-muted"></i>'}
                        </div>
                        <input type="hidden" data-field="${fieldName}[${index}].${field.name}" value="${escapeHtml(value)}">
                    </div>
                `;
            } else if (field.type === 'textarea') {
                html += `
                    <div class="field-group mb-2">
                        <label class="small">${field.label}</label>
                        <textarea class="form-control form-control-sm" data-field="${fieldName}[${index}].${field.name}" rows="2">${escapeHtml(value)}</textarea>
                    </div>
                `;
            } else {
                html += `
                    <div class="field-group mb-2">
                        <label class="small">${field.label}</label>
                        <input type="${field.type === 'number' ? 'number' : 'text'}" class="form-control form-control-sm"
                               data-field="${fieldName}[${index}].${field.name}" value="${escapeHtml(value)}">
                    </div>
                `;
            }
        });

        html += '</div>';
        return html;
    }

    // Add repeater item
    function addRepeaterItem(fieldName) {
        const container = document.querySelector(`.repeater-items[data-field="${fieldName}"]`);
        const fields = JSON.parse(container.dataset.repeaterFields || '[]');
        const index = container.children.length;

        container.insertAdjacentHTML('beforeend', generateRepeaterItemHtml(fieldName, fields, {}, index));
    }

    // Remove repeater item
    function removeRepeaterItem(btn) {
        btn.closest('.repeater-item').remove();
    }

    // Add gallery image
    function addGalleryImage(fieldName) {
        const container = document.querySelector(`.gallery-items[data-field="${fieldName}"]`);
        const index = container.children.length;

        const newItemHtml = `
            <div class="gallery-item" data-index="${index}">
                <div class="gallery-item-preview" style="cursor: pointer;" onclick="selectGalleryImage('${fieldName}', ${index})">
                    <img src="/assets/img/placeholder.jpg" alt="" style="pointer-events: none;">
                    <button type="button" class="gallery-item-remove" onclick="event.stopPropagation(); removeGalleryItem('${fieldName}', ${index})">
                        <i class="fas fa-times"></i>
                    </button>
                    <div style="position: absolute; bottom: 5px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.7); color: white; padding: 2px 8px; border-radius: 4px; font-size: 10px;">
                        Click to select
                    </div>
                </div>
                <input type="hidden" data-field="${fieldName}[${index}].src" value="">
                <input type="text" class="form-control form-control-sm mt-1" data-field="${fieldName}[${index}].alt" value="" placeholder="Alt text">
                <input type="text" class="form-control form-control-sm mt-1" data-field="${fieldName}[${index}].caption" value="" placeholder="Caption (optional)">
            </div>
        `;

        container.insertAdjacentHTML('beforeend', newItemHtml);

        // Immediately open media library for the new image
        selectGalleryImage(fieldName, index);
    }

    // Select gallery image - now uses media library
    let currentGalleryFieldName = null;
    let currentGalleryIndex = null;

    function selectGalleryImage(fieldName, index) {
        currentMediaField = null; // Clear single field reference
        currentGalleryFieldName = fieldName;
        currentGalleryIndex = index;

        if (!mediaLibraryModal) {
            mediaLibraryModal = new bootstrap.Modal(document.getElementById('mediaLibraryModal'));
        }
        mediaLibraryModal.show();

        loadMediaLibrary();
    }

    // Remove gallery image
    function removeGalleryItem(fieldName, index) {
        const container = document.querySelector(`.gallery-items[data-field="${fieldName}"]`);
        const item = container.querySelector(`.gallery-item[data-index="${index}"]`);
        if (item) {
            item.remove();
            // Re-index remaining items
            container.querySelectorAll('.gallery-item').forEach((el, newIndex) => {
                el.dataset.index = newIndex;
                el.querySelectorAll('[data-field]').forEach(input => {
                    input.dataset.field = input.dataset.field.replace(/\[\d+\]/, `[${newIndex}]`);
                });
            });
        }
    }

    // Helper functions
    function getNestedValue(obj, path) {
        return path.split('.').reduce((acc, part) => acc && acc[part], obj);
    }

    function escapeHtml(text) {
        if (text === null || text === undefined) return '';
        const div = document.createElement('div');
        div.textContent = String(text);
        return div.innerHTML;
    }

    // Save section changes
    function saveSectionChanges() {
        if (!currentEditingSection) return;

        // Collect data from fields
        const data = {};
        document.querySelectorAll('#sectionFields [data-field]').forEach(input => {
            const fieldPath = input.dataset.field;

            // Handle repeater fields
            if (fieldPath.includes('[')) {
                const match = fieldPath.match(/^(\w+)\[(\d+)\]\.(.+)$/);
                if (match) {
                    const [, arrayName, index, propName] = match;
                    if (!data[arrayName]) data[arrayName] = [];
                    if (!data[arrayName][index]) data[arrayName][index] = {};
                    data[arrayName][index][propName] = input.type === 'checkbox' ? input.checked : input.value;
                }
            }
            // Handle button fields
            else if (fieldPath.includes('.')) {
                const parts = fieldPath.split('.');
                if (!data[parts[0]]) data[parts[0]] = {};
                data[parts[0]][parts[1]] = input.value;
            }
            // Simple fields
            else {
                data[fieldPath] = input.type === 'checkbox' ? input.checked : input.value;
            }
        });

        // Clean up repeater arrays (remove undefined)
        Object.keys(data).forEach(key => {
            if (Array.isArray(data[key])) {
                data[key] = data[key].filter(item => item !== undefined);
            }
        });

        // Collect styles
        const styles = {
            background_color: document.getElementById('styleBgColorText').value,
            text_color: document.getElementById('styleTextColorText').value,
            padding_top: document.getElementById('stylePaddingTop').value,
            padding_bottom: document.getElementById('stylePaddingBottom').value,
        };

        // Update section
        fetch(`/admin/page-builder/${pageSlug}/sections/${currentEditingSection.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ data, styles })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Update local data
                currentEditingSection.data = { ...currentEditingSection.data, ...data };
                currentEditingSection.styles = styles;

                bootstrap.Modal.getInstance(document.getElementById('sectionEditorModal')).hide();
                showSaveIndicator();
            } else {
                alert(result.message || 'Failed to save changes');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }

    // Delete section
    function deleteSection(sectionId) {
        if (!confirm('Are you sure you want to delete this section?')) return;

        fetch(`/admin/page-builder/${pageSlug}/sections/${sectionId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`.section-block[data-section-id="${sectionId}"]`).remove();
                sectionsData = sectionsData.filter(s => s.id !== sectionId);

                // Show empty state if no sections
                if (sectionsData.length === 0) {
                    sectionsList.innerHTML = `
                        <div class="empty-canvas" id="emptyCanvas">
                            <div class="empty-canvas-icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <h3>Start Building Your Page</h3>
                            <p>Drag sections from the library and drop them here</p>
                        </div>
                    `;
                }

                showSaveIndicator();
            }
        });
    }

    // Duplicate section
    function duplicateSection(sectionId) {
        const section = sectionsData.find(s => s.id === sectionId);
        if (!section) return;

        fetch(`/admin/page-builder/${pageSlug}/sections/add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                section_type: section.type,
                position: sectionsData.indexOf(section) + 1
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Copy data to new section
                data.section.data = JSON.parse(JSON.stringify(section.data));
                data.section.styles = JSON.parse(JSON.stringify(section.styles || {}));

                // Update the duplicated section with data
                fetch(`/admin/page-builder/${pageSlug}/sections/${data.section.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        data: data.section.data,
                        styles: data.section.styles
                    })
                }).then(() => {
                    location.reload();
                });
            }
        });
    }

    // Save all sections
    function saveSections() {
        const saveBtn = document.getElementById('saveBtn');
        saveBtn.classList.add('saving');
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

        fetch(`/admin/page-builder/${pageSlug}/sections`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ sections: sectionsData })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSaveIndicator();
            } else {
                alert(data.message || 'Failed to save');
            }
        })
        .finally(() => {
            saveBtn.classList.remove('saving');
            saveBtn.innerHTML = '<i class="fas fa-save"></i> Save';
        });
    }

    // Show save indicator
    function showSaveIndicator() {
        const indicator = document.getElementById('saveIndicator');
        indicator.classList.remove('show');
        void indicator.offsetWidth; // Trigger reflow
        indicator.classList.add('show');
    }

    // Open page settings modal
    function openPageSettings() {
        new bootstrap.Modal(document.getElementById('pageSettingsModal')).show();
    }

    // Save page settings
    function savePageSettings() {
        const data = {
            title: document.getElementById('settingsTitle').value,
            slug: document.getElementById('settingsSlug').value,
            template: document.getElementById('settingsTemplate').value,
            status: document.getElementById('settingsStatus').value,
            meta_title: document.getElementById('settingsMetaTitle').value,
            meta_description: document.getElementById('settingsMetaDesc').value,
        };

        fetch(`/admin/page-builder/${pageSlug}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                bootstrap.Modal.getInstance(document.getElementById('pageSettingsModal')).hide();
                if (result.redirect) {
                    window.location.href = result.redirect;
                } else {
                    location.reload();
                }
            } else {
                alert(result.message || 'Failed to save settings');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving');
        });
    }

    // Open media library
    let currentMediaField = null;
    let mediaLibraryCache = null;
    let mediaLibraryModal = null;

    function openMediaLibrary(fieldName) {
        currentMediaField = fieldName;
        currentGalleryFieldName = null;
        currentGalleryIndex = null;

        if (!mediaLibraryModal) {
            mediaLibraryModal = new bootstrap.Modal(document.getElementById('mediaLibraryModal'));
        }
        mediaLibraryModal.show();

        loadMediaLibrary();
    }

    function loadMediaLibrary() {
        const content = document.getElementById('mediaLibraryContent');

        // Show loading state
        content.innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Loading media library...</p>
            </div>
        `;

        // Fetch media from API
        fetch('/admin/media-library/json')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.media) {
                    mediaLibraryCache = data.media;
                    renderMediaGrid(data.media);
                    populateFolderFilter(data.media);
                } else {
                    content.innerHTML = `
                        <div class="media-empty">
                            <i class="fas fa-images"></i>
                            <h5>No images found</h5>
                            <p>Upload images through the Media Library to use them here.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading media:', error);
                content.innerHTML = `
                    <div class="media-empty">
                        <i class="fas fa-exclamation-triangle text-warning"></i>
                        <h5>Error loading media</h5>
                        <p>Please try again later.</p>
                    </div>
                `;
            });
    }

    function renderMediaGrid(media) {
        const content = document.getElementById('mediaLibraryContent');

        if (!media || media.length === 0) {
            content.innerHTML = `
                <div class="media-empty">
                    <i class="fas fa-images"></i>
                    <h5>No images found</h5>
                    <p>Upload images through the Media Library to use them here.</p>
                </div>
            `;
            document.getElementById('mediaCount').textContent = '0 images';
            return;
        }

        document.getElementById('mediaCount').textContent = `${media.length} images`;

        let html = '<div class="media-grid">';

        media.forEach((item, index) => {
            html += `
                <div class="media-item" data-path="${escapeHtml(item.path)}" data-url="${escapeHtml(item.url)}" onclick="selectMediaItem(this)">
                    <div class="media-item-overlay"><i class="fas fa-check"></i></div>
                    <img src="${item.url}" alt="${escapeHtml(item.name)}" loading="lazy" onerror="this.src='/assets/img/placeholder.jpg'">
                    <div class="media-item-info">
                        <div class="media-item-name" title="${escapeHtml(item.name)}">${escapeHtml(item.name)}</div>
                        <div class="media-item-meta">${item.size} | ${item.folder || 'uploads'}</div>
                    </div>
                </div>
            `;
        });

        html += '</div>';
        content.innerHTML = html;
    }

    function populateFolderFilter(media) {
        const folders = [...new Set(media.map(item => item.folder))].filter(Boolean).sort();
        const select = document.getElementById('mediaFolderFilter');

        select.innerHTML = '<option value="">All Folders</option>';
        folders.forEach(folder => {
            select.innerHTML += `<option value="${escapeHtml(folder)}">${escapeHtml(folder)}</option>`;
        });
    }

    function selectMediaItem(element) {
        const path = element.dataset.path;
        const url = element.dataset.url;

        // Remove selection from other items
        document.querySelectorAll('.media-item.selected').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');

        // Determine if this is for a gallery or a single image field
        if (currentGalleryFieldName !== null && currentGalleryIndex !== null) {
            // Gallery image selection
            const input = document.querySelector(`[data-field="${currentGalleryFieldName}[${currentGalleryIndex}].src"]`);
            if (input) {
                input.value = path;
            }

            // Update image preview
            const galleryItem = document.querySelector(`.gallery-items[data-field="${currentGalleryFieldName}"] .gallery-item[data-index="${currentGalleryIndex}"]`);
            if (galleryItem) {
                const img = galleryItem.querySelector('.gallery-item-preview img');
                if (img) {
                    img.src = url;
                }
            }
        } else if (currentMediaField) {
            // Single image field selection
            const input = document.querySelector(`[data-field="${currentMediaField}"]`);
            if (input) {
                input.value = path;
                // Update preview if it's an image field
                const uploadArea = input.previousElementSibling;
                if (uploadArea && uploadArea.classList.contains('image-upload-area')) {
                    uploadArea.innerHTML = `<img src="${url}" alt=""><div>Click to change image</div>`;
                }
            }
        }

        // Close modal after short delay
        setTimeout(() => {
            bootstrap.Modal.getInstance(document.getElementById('mediaLibraryModal')).hide();
        }, 200);
    }

    // Media search functionality
    document.getElementById('mediaSearchInput').addEventListener('input', function() {
        const term = this.value.toLowerCase();
        filterMediaItems(term, document.getElementById('mediaFolderFilter').value);
    });

    // Media folder filter
    document.getElementById('mediaFolderFilter').addEventListener('change', function() {
        const term = document.getElementById('mediaSearchInput').value.toLowerCase();
        filterMediaItems(term, this.value);
    });

    function filterMediaItems(searchTerm, folder) {
        if (!mediaLibraryCache) return;

        let filtered = mediaLibraryCache;

        if (searchTerm) {
            filtered = filtered.filter(item =>
                item.name.toLowerCase().includes(searchTerm) ||
                (item.folder && item.folder.toLowerCase().includes(searchTerm))
            );
        }

        if (folder) {
            filtered = filtered.filter(item => item.folder === folder);
        }

        renderMediaGrid(filtered);
    }

    // Editor tabs
    document.querySelectorAll('.editor-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.editor-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.editor-tab-content').forEach(c => c.classList.remove('active'));

            this.classList.add('active');
            document.getElementById(this.dataset.tab + 'Tab').classList.add('active');
        });
    });

    // Color picker sync
    document.getElementById('styleBgColor').addEventListener('input', function() {
        document.getElementById('styleBgColorText').value = this.value;
    });
    document.getElementById('styleTextColor').addEventListener('input', function() {
        document.getElementById('styleTextColorText').value = this.value;
    });

    // Section search
    document.getElementById('sectionSearch').addEventListener('input', function() {
        const term = this.value.toLowerCase();
        document.querySelectorAll('.section-item').forEach(item => {
            const name = item.dataset.sectionName.toLowerCase();
            item.style.display = name.includes(term) ? 'flex' : 'none';
        });
    });
</script>
@endsection
