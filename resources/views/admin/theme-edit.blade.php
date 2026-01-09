@extends('admin.layouts.app')

@section('title', 'Edit Theme - ' . $theme['name'])

@section('styles')
<style>
    /* Form Styles */
    .form-card {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        padding: 30px;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--heading-color);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-title i {
        color: var(--primary-color);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: var(--heading-color);
        margin-bottom: 8px;
    }

    .form-group label .required {
        color: var(--danger-color);
    }

    .form-group small {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        margin-top: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(179, 9, 9, 0.1);
    }

    .form-control:disabled {
        background: var(--light-bg);
        cursor: not-allowed;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Two Column Layout */
    .edit-layout {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
    }

    /* Theme Preview Sidebar */
    .theme-preview-sidebar {
        position: sticky;
        top: 20px;
    }

    .preview-card {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        overflow: hidden;
    }

    .preview-header {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border-light);
        font-weight: 600;
        font-size: 14px;
        color: var(--heading-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .preview-header i {
        color: var(--primary-color);
    }

    .preview-image {
        height: 200px;
        background: linear-gradient(135deg, var(--light-bg) 0%, var(--border-light) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-placeholder {
        text-align: center;
        color: var(--text-light);
    }

    .preview-placeholder i {
        font-size: 40px;
        opacity: 0.3;
        margin-bottom: 10px;
    }

    .preview-info {
        padding: 20px;
    }

    .preview-info-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid var(--border-light);
        font-size: 13px;
    }

    .preview-info-item:last-child {
        border-bottom: none;
    }

    .preview-info-item .label {
        color: var(--text-light);
    }

    .preview-info-item .value {
        color: var(--heading-color);
        font-weight: 500;
    }

    .preview-info-item .value.active {
        color: var(--success-color);
    }

    /* Version Select */
    .version-select-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    /* Color Picker */
    .color-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .color-picker-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .color-picker-group input[type="color"] {
        width: 40px;
        height: 40px;
        border: 2px solid var(--border-color);
        border-radius: 6px;
        cursor: pointer;
        padding: 2px;
    }

    .color-picker-group input[type="text"] {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 13px;
        font-family: monospace;
    }

    /* Version Preview */
    .version-preview-container {
        margin-top: 20px;
        border: 1px solid var(--border-light);
        border-radius: 8px;
        overflow: hidden;
    }

    .version-preview-tabs {
        display: flex;
        border-bottom: 1px solid var(--border-light);
        background: var(--light-bg);
    }

    .version-preview-tab {
        padding: 12px 20px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        border: none;
        background: transparent;
        color: var(--text-light);
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .version-preview-tab:hover {
        background: var(--white);
        color: var(--heading-color);
    }

    .version-preview-tab.active {
        background: var(--white);
        color: var(--primary-color);
        border-bottom: 2px solid var(--primary-color);
        margin-bottom: -1px;
    }

    .version-preview-content {
        padding: 20px;
        background: var(--white);
    }

    .preview-frame-container {
        border: 1px solid var(--border-light);
        border-radius: 6px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .preview-frame {
        width: 100%;
        height: 150px;
        border: none;
        transform: scale(0.5);
        transform-origin: top left;
        width: 200%;
        height: 300px;
    }

    .preview-thumbnail {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
    }

    .preview-item {
        border: 2px solid var(--border-light);
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .preview-item:hover {
        border-color: var(--primary-light);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .preview-item.selected {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(179, 9, 9, 0.15);
    }

    .preview-item-image {
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
    }

    .preview-item-info {
        padding: 10px;
        text-align: center;
    }

    .preview-item-name {
        font-size: 12px;
        font-weight: 500;
        color: var(--heading-color);
    }

    /* Live Preview Box */
    .live-preview-box {
        margin-top: 15px;
        border: 1px solid var(--border-light);
        border-radius: 8px;
        overflow: hidden;
    }

    .live-preview-header {
        padding: 40px 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .live-preview-footer {
        padding: 40px 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .live-preview-label {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .live-preview-version {
        font-size: 12px;
        opacity: 0.8;
    }

    /* Buttons */
    .form-actions {
        display: flex;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid var(--border-light);
        margin-top: 30px;
    }

    .btn-primary {
        background: var(--primary-color);
        color: white;
        border: 1px solid var(--primary-dark);
        padding: 12px 30px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--heading-color);
        border: 1px solid var(--border-color);
        padding: 12px 30px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-secondary:hover {
        background: var(--light-bg);
        color: var(--heading-color);
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

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .breadcrumb a {
        color: var(--primary-color);
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .breadcrumb span {
        color: var(--text-light);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-badge.active {
        background: var(--success-light);
        color: var(--success-color);
    }

    .status-badge.inactive {
        background: var(--light-bg);
        color: var(--text-light);
    }

    /* Alert */
    .alert-custom {
        border-radius: var(--card-radius);
        border: none;
        padding: 12px 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideInDown 0.5s ease;
    }

    .alert-success {
        background: var(--success-light);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    @media (max-width: 992px) {
        .edit-layout {
            grid-template-columns: 1fr;
        }

        .theme-preview-sidebar {
            position: static;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .version-select-group {
            grid-template-columns: 1fr;
        }

        .color-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.themes') }}"><i class="fas fa-palette me-1"></i>Theme Manager</a>
        <span>/</span>
        <span>Edit: {{ $theme['name'] }}</span>
    </div>

    <div class="page-header">
        <h1>
            <i class="fas fa-edit me-3"></i>Edit Theme
            @if($isActive)
                <span class="status-badge active ms-3"><i class="fas fa-check-circle"></i> Active</span>
            @else
                <span class="status-badge inactive ms-3"><i class="fas fa-circle"></i> Inactive</span>
            @endif
        </h1>
        <p>Configure theme settings and layout versions</p>
    </div>

    @if(session('success'))
    <div class="alert-custom alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="edit-layout">
        <!-- Main Form -->
        <div class="form-card">
            <form action="{{ route('admin.themes.update', $theme['slug']) }}" method="POST">
                @csrf

                <!-- Basic Information -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        Basic Information
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Theme Name <span class="required">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $theme['name']) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Theme Slug</label>
                            <input type="text" class="form-control" value="{{ $theme['slug'] }}" disabled>
                            <small>Slug cannot be changed after creation.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $theme['description']) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" name="company" class="form-control"
                               value="{{ old('company', $theme['company']) }}">
                    </div>
                </div>

                <!-- Layout Versions -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-layer-group"></i>
                        Layout Versions
                    </div>

                    <div class="version-select-group">
                        <div class="form-group">
                            <label>Home Version <span class="required">*</span></label>
                            <select name="home_version" class="form-control" required>
                                @foreach($homeVersions as $version)
                                    <option value="{{ $version }}" {{ $theme['home_version'] == $version ? 'selected' : '' }}>
                                        {{ $version }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Header Version <span class="required">*</span></label>
                            <select name="header_version" id="headerVersionSelect" class="form-control" required onchange="updateHeaderPreview()">
                                @foreach($headerVersions as $version)
                                    <option value="{{ $version }}" {{ $theme['header_version'] == $version ? 'selected' : '' }}>
                                        {{ $version }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Footer Version <span class="required">*</span></label>
                            <select name="footer_version" id="footerVersionSelect" class="form-control" required onchange="updateFooterPreview()">
                                @foreach($footerVersions as $version)
                                    <option value="{{ $version }}" {{ $theme['footer_version'] == $version ? 'selected' : '' }}>
                                        {{ $version }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Header/Footer Preview -->
                    <div class="version-preview-container">
                        <div class="version-preview-tabs">
                            <button type="button" class="version-preview-tab active" onclick="showPreviewTab('header')">
                                <i class="fas fa-window-maximize"></i> Header Preview
                            </button>
                            <button type="button" class="version-preview-tab" onclick="showPreviewTab('footer')">
                                <i class="fas fa-window-minimize"></i> Footer Preview
                            </button>
                        </div>
                        <div class="version-preview-content">
                            <!-- Header Preview -->
                            <div id="headerPreviewPane" class="preview-pane">
                                <div class="preview-grid">
                                    @foreach($headerVersions as $version)
                                    <div class="preview-item {{ $theme['header_version'] == $version ? 'selected' : '' }}"
                                         data-version="{{ $version }}"
                                         onclick="selectHeaderVersion('{{ $version }}')">
                                        <div class="preview-item-image" style="background: linear-gradient(135deg, {{ $theme['assets']['colors']['header_bg'] ?? '#ffffff' }} 0%, {{ $theme['assets']['colors']['primary'] ?? '#667eea' }} 100%);">
                                            <i class="fas fa-bars"></i>
                                        </div>
                                        <div class="preview-item-info">
                                            <div class="preview-item-name">{{ ucfirst(str_replace('-', ' ', $version)) }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="live-preview-box">
                                    <div class="live-preview-header" id="headerLivePreview" style="background-color: {{ $theme['assets']['colors']['header_bg'] ?? '#ffffff' }}; color: {{ $theme['assets']['colors']['header_text'] ?? '#000000' }};">
                                        <div class="live-preview-label">Header Preview</div>
                                        <div class="live-preview-version" id="headerVersionLabel">{{ $theme['header_version'] }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer Preview -->
                            <div id="footerPreviewPane" class="preview-pane" style="display: none;">
                                <div class="preview-grid">
                                    @foreach($footerVersions as $version)
                                    <div class="preview-item {{ $theme['footer_version'] == $version ? 'selected' : '' }}"
                                         data-version="{{ $version }}"
                                         onclick="selectFooterVersion('{{ $version }}')">
                                        <div class="preview-item-image" style="background: linear-gradient(135deg, {{ $theme['assets']['colors']['footer_bg'] ?? '#1a1a2e' }} 0%, {{ $theme['assets']['colors']['secondary'] ?? '#764ba2' }} 100%);">
                                            <i class="fas fa-th-large"></i>
                                        </div>
                                        <div class="preview-item-info">
                                            <div class="preview-item-name">{{ ucfirst(str_replace('-', ' ', $version)) }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="live-preview-box">
                                    <div class="live-preview-footer" id="footerLivePreview" style="background-color: {{ $theme['assets']['colors']['footer_bg'] ?? '#1a1a2e' }}; color: {{ $theme['assets']['colors']['footer_text'] ?? '#ffffff' }};">
                                        <div class="live-preview-label">Footer Preview</div>
                                        <div class="live-preview-version" id="footerVersionLabel">{{ $theme['footer_version'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Theme Colors -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-palette"></i>
                        Theme Colors
                    </div>

                    <div class="color-grid">
                        <div class="form-group">
                            <label>Primary Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorPrimary" name="colors[primary]"
                                       value="{{ $theme['assets']['colors']['primary'] ?? '#007bff' }}"
                                       onchange="updateColorInput('colorPrimary')">
                                <input type="text" id="colorPrimaryText"
                                       value="{{ $theme['assets']['colors']['primary'] ?? '#007bff' }}"
                                       onchange="updateColorPicker('colorPrimary')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Secondary Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorSecondary" name="colors[secondary]"
                                       value="{{ $theme['assets']['colors']['secondary'] ?? '#6c757d' }}"
                                       onchange="updateColorInput('colorSecondary')">
                                <input type="text" id="colorSecondaryText"
                                       value="{{ $theme['assets']['colors']['secondary'] ?? '#6c757d' }}"
                                       onchange="updateColorPicker('colorSecondary')">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Accent Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorAccent" name="colors[accent]"
                                       value="{{ $theme['assets']['colors']['accent'] ?? '#17a2b8' }}"
                                       onchange="updateColorInput('colorAccent')">
                                <input type="text" id="colorAccentText"
                                       value="{{ $theme['assets']['colors']['accent'] ?? '#17a2b8' }}"
                                       onchange="updateColorPicker('colorAccent')">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header & Footer Background Colors -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-fill-drip"></i>
                        Header & Footer Background Colors
                    </div>

                    <div class="color-grid" style="grid-template-columns: 1fr 1fr;">
                        <div class="form-group">
                            <label>Header Background Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorHeaderBg" name="colors[header_bg]"
                                       value="{{ $theme['assets']['colors']['header_bg'] ?? '#ffffff' }}"
                                       onchange="updateColorInput('colorHeaderBg'); updateHeaderBgPreview();">
                                <input type="text" id="colorHeaderBgText"
                                       value="{{ $theme['assets']['colors']['header_bg'] ?? '#ffffff' }}"
                                       onchange="updateColorPicker('colorHeaderBg'); updateHeaderBgPreview();">
                            </div>
                            <small>Background color for the header section</small>
                        </div>

                        <div class="form-group">
                            <label>Header Text Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorHeaderText" name="colors[header_text]"
                                       value="{{ $theme['assets']['colors']['header_text'] ?? '#000000' }}"
                                       onchange="updateColorInput('colorHeaderText'); updateHeaderTextPreview();">
                                <input type="text" id="colorHeaderTextText"
                                       value="{{ $theme['assets']['colors']['header_text'] ?? '#000000' }}"
                                       onchange="updateColorPicker('colorHeaderText'); updateHeaderTextPreview();">
                            </div>
                            <small>Text/link color for the header</small>
                        </div>

                        <div class="form-group">
                            <label>Footer Background Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorFooterBg" name="colors[footer_bg]"
                                       value="{{ $theme['assets']['colors']['footer_bg'] ?? '#1a1a2e' }}"
                                       onchange="updateColorInput('colorFooterBg'); updateFooterBgPreview();">
                                <input type="text" id="colorFooterBgText"
                                       value="{{ $theme['assets']['colors']['footer_bg'] ?? '#1a1a2e' }}"
                                       onchange="updateColorPicker('colorFooterBg'); updateFooterBgPreview();">
                            </div>
                            <small>Background color for the footer section</small>
                        </div>

                        <div class="form-group">
                            <label>Footer Text Color</label>
                            <div class="color-picker-group">
                                <input type="color" id="colorFooterText" name="colors[footer_text]"
                                       value="{{ $theme['assets']['colors']['footer_text'] ?? '#ffffff' }}"
                                       onchange="updateColorInput('colorFooterText'); updateFooterTextPreview();">
                                <input type="text" id="colorFooterTextText"
                                       value="{{ $theme['assets']['colors']['footer_text'] ?? '#ffffff' }}"
                                       onchange="updateColorPicker('colorFooterText'); updateFooterTextPreview();">
                            </div>
                            <small>Text/link color for the footer</small>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>
                    <a href="{{ route('admin.themes') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Themes
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar Preview -->
        <div class="theme-preview-sidebar">
            <div class="preview-card">
                <div class="preview-header">
                    <i class="fas fa-eye"></i>
                    Theme Preview
                </div>

                <div class="preview-image">
                    @if($theme['preview_image'] && file_exists(public_path($theme['preview_image'])))
                        <img src="{{ asset($theme['preview_image']) }}" alt="{{ $theme['name'] }}">
                    @else
                        <div class="preview-placeholder">
                            <i class="fas fa-image"></i>
                            <p>No preview available</p>
                        </div>
                    @endif
                </div>

                <div class="preview-info">
                    <div class="preview-info-item">
                        <span class="label">Status</span>
                        <span class="value {{ $isActive ? 'active' : '' }}">
                            {{ $isActive ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="preview-info-item">
                        <span class="label">Version</span>
                        <span class="value">{{ $theme['version'] ?? '1.0.0' }}</span>
                    </div>
                    <div class="preview-info-item">
                        <span class="label">Author</span>
                        <span class="value">{{ $theme['author'] ?? 'Unknown' }}</span>
                    </div>
                    <div class="preview-info-item">
                        <span class="label">Home</span>
                        <span class="value">{{ $theme['home_version'] }}</span>
                    </div>
                    <div class="preview-info-item">
                        <span class="label">Header</span>
                        <span class="value">{{ $theme['header_version'] }}</span>
                    </div>
                    <div class="preview-info-item">
                        <span class="label">Footer</span>
                        <span class="value">{{ $theme['footer_version'] }}</span>
                    </div>
                </div>
            </div>

            @if(!$isActive)
            <form action="{{ route('admin.themes.activate', $theme['slug']) }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-power-off"></i>
                    Activate This Theme
                </button>
            </form>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Color picker sync
    function updateColorInput(id) {
        const colorPicker = document.getElementById(id);
        const textInput = document.getElementById(id + 'Text');
        textInput.value = colorPicker.value;
    }

    function updateColorPicker(id) {
        const colorPicker = document.getElementById(id);
        const textInput = document.getElementById(id + 'Text');
        if (/^#[0-9A-Fa-f]{6}$/.test(textInput.value)) {
            colorPicker.value = textInput.value;
        }
    }

    // Preview tab switching
    function showPreviewTab(type) {
        // Update tab buttons
        document.querySelectorAll('.version-preview-tab').forEach(tab => {
            tab.classList.remove('active');
        });
        event.target.closest('.version-preview-tab').classList.add('active');

        // Show/hide panes
        document.getElementById('headerPreviewPane').style.display = type === 'header' ? 'block' : 'none';
        document.getElementById('footerPreviewPane').style.display = type === 'footer' ? 'block' : 'none';
    }

    // Select header version from preview grid
    function selectHeaderVersion(version) {
        // Update select dropdown
        document.getElementById('headerVersionSelect').value = version;

        // Update preview items
        document.querySelectorAll('#headerPreviewPane .preview-item').forEach(item => {
            item.classList.remove('selected');
            if (item.dataset.version === version) {
                item.classList.add('selected');
            }
        });

        // Update label
        document.getElementById('headerVersionLabel').textContent = version;
    }

    // Select footer version from preview grid
    function selectFooterVersion(version) {
        // Update select dropdown
        document.getElementById('footerVersionSelect').value = version;

        // Update preview items
        document.querySelectorAll('#footerPreviewPane .preview-item').forEach(item => {
            item.classList.remove('selected');
            if (item.dataset.version === version) {
                item.classList.add('selected');
            }
        });

        // Update label
        document.getElementById('footerVersionLabel').textContent = version;
    }

    // Update header preview when dropdown changes
    function updateHeaderPreview() {
        const version = document.getElementById('headerVersionSelect').value;
        selectHeaderVersion(version);
    }

    // Update footer preview when dropdown changes
    function updateFooterPreview() {
        const version = document.getElementById('footerVersionSelect').value;
        selectFooterVersion(version);
    }

    // Update header background preview
    function updateHeaderBgPreview() {
        const color = document.getElementById('colorHeaderBg').value;
        document.getElementById('headerLivePreview').style.backgroundColor = color;
    }

    // Update header text preview
    function updateHeaderTextPreview() {
        const color = document.getElementById('colorHeaderText').value;
        document.getElementById('headerLivePreview').style.color = color;
    }

    // Update footer background preview
    function updateFooterBgPreview() {
        const color = document.getElementById('colorFooterBg').value;
        document.getElementById('footerLivePreview').style.backgroundColor = color;
    }

    // Update footer text preview
    function updateFooterTextPreview() {
        const color = document.getElementById('colorFooterText').value;
        document.getElementById('footerLivePreview').style.color = color;
    }

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
