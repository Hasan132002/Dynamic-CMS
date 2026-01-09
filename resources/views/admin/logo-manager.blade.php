@extends('admin.layouts.app')

@section('title', 'Logo Manager')

@section('styles')
<style>
    /* Logo Manager - Clean WordPress Style */
    .lm-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }

    .lm-card {
        background: var(--white);
        border-radius: 12px;
        border: 1px solid var(--border-light);
        overflow: hidden;
        box-shadow: var(--card-shadow);
    }

    .lm-card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 16px 20px;
        font-size: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .lm-card-body {
        padding: 24px;
    }

    .lm-preview {
        width: 100%;
        height: 140px;
        border: 2px dashed var(--border-color);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: var(--light-bg);
        overflow: hidden;
        position: relative;
        transition: all 0.3s ease;
    }

    .lm-preview:hover {
        border-color: var(--primary-color);
        background: #fff5f5;
    }

    .lm-preview img {
        max-width: 85%;
        max-height: 85%;
        object-fit: contain;
    }

    .lm-preview .placeholder {
        color: #999;
        font-size: 13px;
        text-align: center;
    }

    .lm-preview .placeholder i {
        font-size: 32px;
        margin-bottom: 8px;
        display: block;
        color: #ccc;
    }

    /* Action Buttons */
    .lm-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .lm-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        width: 100%;
    }

    .lm-btn-primary {
        background: var(--primary-color);
        color: white;
    }

    .lm-btn-primary:hover {
        background: var(--primary-dark);
    }

    .lm-btn-secondary {
        background: var(--light-bg);
        color: var(--heading-color);
        border: 1px solid var(--border-color);
    }

    .lm-btn-secondary:hover {
        background: var(--border-light);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .lm-btn-danger {
        background: #fff5f5;
        color: var(--danger-color);
        border: 1px solid var(--danger-color);
    }

    .lm-btn-danger:hover {
        background: var(--danger-color);
        color: white;
    }

    .lm-btn-row {
        display: flex;
        gap: 10px;
    }

    .lm-btn-row .lm-btn {
        flex: 1;
    }

    /* URL Input */
    .lm-url-section {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid var(--border-light);
    }

    .lm-url-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 6px;
        display: block;
    }

    .lm-url-input {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .lm-url-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(179, 9, 9, 0.1);
    }

    .lm-hint {
        font-size: 11px;
        color: var(--text-light);
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Hidden file input */
    .lm-file-input {
        display: none;
    }

    /* Save Button */
    .lm-save-section {
        text-align: center;
        margin-top: 30px;
    }

    .lm-save-btn {
        background: linear-gradient(135deg, var(--success-color) 0%, #1e7e34 100%);
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    }

    .lm-save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }

    /* Media Library Modal */
    .lm-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 20px;
    }

    .lm-modal-overlay.show {
        display: flex;
    }

    .lm-modal {
        background: var(--white);
        border-radius: 12px;
        width: 100%;
        max-width: 900px;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        animation: lmModalSlide 0.3s ease;
    }

    @keyframes lmModalSlide {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .lm-modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .lm-modal-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: var(--heading-color);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .lm-modal-close {
        background: var(--light-bg);
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        color: var(--text-light);
        transition: all 0.2s ease;
    }

    .lm-modal-close:hover {
        background: var(--danger-color);
        color: white;
    }

    .lm-modal-body {
        flex: 1;
        overflow-y: auto;
        padding: 20px 24px;
    }

    .lm-modal-footer {
        padding: 16px 24px;
        border-top: 1px solid var(--border-light);
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    /* Media Grid */
    .lm-media-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border-light);
        padding-bottom: 15px;
    }

    .lm-media-tab {
        padding: 8px 16px;
        border-radius: 6px;
        background: var(--light-bg);
        border: 1px solid var(--border-color);
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .lm-media-tab:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .lm-media-tab.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .lm-media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 15px;
    }

    .lm-media-item {
        position: relative;
        aspect-ratio: 1;
        border-radius: 8px;
        overflow: hidden;
        border: 3px solid transparent;
        cursor: pointer;
        transition: all 0.2s ease;
        background: var(--light-bg);
    }

    .lm-media-item:hover {
        border-color: var(--primary-light);
        transform: scale(1.02);
    }

    .lm-media-item.selected {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(179, 9, 9, 0.2);
    }

    .lm-media-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .lm-media-item .lm-check {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 24px;
        height: 24px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .lm-media-item.selected .lm-check {
        display: flex;
    }

    .lm-media-item .lm-name {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 20px 8px 8px;
        font-size: 10px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Upload Section in Modal */
    .lm-upload-zone {
        border: 2px dashed var(--border-color);
        border-radius: 10px;
        padding: 40px 20px;
        text-align: center;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .lm-upload-zone:hover,
    .lm-upload-zone.dragover {
        border-color: var(--primary-color);
        background: #fff5f5;
    }

    .lm-upload-zone i {
        font-size: 40px;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .lm-upload-zone p {
        margin: 0;
        color: var(--text-light);
        font-size: 14px;
    }

    .lm-upload-zone input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Empty state */
    .lm-empty {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }

    .lm-empty i {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 15px;
    }

    /* Success Alert */
    .lm-alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideInDown 0.3s ease;
    }

    .lm-alert-success {
        background: var(--success-light);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    @keyframes slideInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 992px) {
        .lm-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-image"></i>Logo Manager</h1>
        <p>Manage your website logos and favicon</p>
    </div>

    @if(session('success'))
    <div class="lm-alert lm-alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <form id="logoForm" action="/admin/logo-manager" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="lm-grid">
            <!-- Header Logo -->
            <div class="lm-card">
                <div class="lm-card-header">
                    <i class="fas fa-heading"></i>Header Logo
                </div>
                <div class="lm-card-body">
                    <div class="lm-preview" id="headerPreview">
                        @if(!empty($logos['header']['default']))
                            <img src="{{ asset($logos['header']['default']) }}" alt="Header Logo" id="headerPreviewImg">
                        @else
                            <span class="placeholder" id="headerPlaceholder">
                                <i class="fas fa-image"></i>
                                No logo set
                            </span>
                        @endif
                    </div>

                    <div class="lm-actions">
                        <div class="lm-btn-row">
                            <button type="button" class="lm-btn lm-btn-primary" onclick="document.getElementById('headerLogoFile').click()">
                                <i class="fas fa-upload"></i>Upload
                            </button>
                            <button type="button" class="lm-btn lm-btn-secondary" onclick="openMediaLibrary('header')">
                                <i class="fas fa-photo-video"></i>Media
                            </button>
                        </div>
                        @if(!empty($logos['header']['default']))
                        <button type="button" class="lm-btn lm-btn-danger" onclick="clearLogo('header')">
                            <i class="fas fa-trash"></i>Remove Logo
                        </button>
                        @endif
                    </div>

                    <input type="file" name="header_logo" id="headerLogoFile" class="lm-file-input" accept="image/*" onchange="previewLogo(this, 'header')">

                    <div class="lm-url-section">
                        <label class="lm-url-label">Or enter URL directly:</label>
                        <input type="text" name="header_logo_url" id="headerLogoUrl" class="lm-url-input"
                               placeholder="https://example.com/logo.png"
                               value="{{ $logos['header']['default'] ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Footer Logo -->
            <div class="lm-card">
                <div class="lm-card-header">
                    <i class="fas fa-shoe-prints"></i>Footer Logo
                </div>
                <div class="lm-card-body">
                    <div class="lm-preview" id="footerPreview">
                        @if(!empty($logos['footer']['default']))
                            <img src="{{ asset($logos['footer']['default']) }}" alt="Footer Logo" id="footerPreviewImg">
                        @else
                            <span class="placeholder" id="footerPlaceholder">
                                <i class="fas fa-image"></i>
                                No logo set
                            </span>
                        @endif
                    </div>

                    <div class="lm-actions">
                        <div class="lm-btn-row">
                            <button type="button" class="lm-btn lm-btn-primary" onclick="document.getElementById('footerLogoFile').click()">
                                <i class="fas fa-upload"></i>Upload
                            </button>
                            <button type="button" class="lm-btn lm-btn-secondary" onclick="openMediaLibrary('footer')">
                                <i class="fas fa-photo-video"></i>Media
                            </button>
                        </div>
                        @if(!empty($logos['footer']['default']))
                        <button type="button" class="lm-btn lm-btn-danger" onclick="clearLogo('footer')">
                            <i class="fas fa-trash"></i>Remove Logo
                        </button>
                        @endif
                    </div>

                    <input type="file" name="footer_logo" id="footerLogoFile" class="lm-file-input" accept="image/*" onchange="previewLogo(this, 'footer')">

                    <div class="lm-url-section">
                        <label class="lm-url-label">Or enter URL directly:</label>
                        <input type="text" name="footer_logo_url" id="footerLogoUrl" class="lm-url-input"
                               placeholder="https://example.com/logo.png"
                               value="{{ $logos['footer']['default'] ?? '' }}">
                    </div>
                </div>
            </div>

            <!-- Favicon -->
            <div class="lm-card">
                <div class="lm-card-header">
                    <i class="fas fa-star"></i>Favicon
                </div>
                <div class="lm-card-body">
                    <div class="lm-preview" id="faviconPreview">
                        @if(!empty($logos['favicon']))
                            <img src="{{ asset($logos['favicon']) }}" alt="Favicon" id="faviconPreviewImg">
                        @else
                            <span class="placeholder" id="faviconPlaceholder">
                                <i class="fas fa-star"></i>
                                No favicon set
                            </span>
                        @endif
                    </div>

                    <div class="lm-actions">
                        <div class="lm-btn-row">
                            <button type="button" class="lm-btn lm-btn-primary" onclick="document.getElementById('faviconFile').click()">
                                <i class="fas fa-upload"></i>Upload
                            </button>
                            <button type="button" class="lm-btn lm-btn-secondary" onclick="openMediaLibrary('favicon')">
                                <i class="fas fa-photo-video"></i>Media
                            </button>
                        </div>
                        @if(!empty($logos['favicon']))
                        <button type="button" class="lm-btn lm-btn-danger" onclick="clearLogo('favicon')">
                            <i class="fas fa-trash"></i>Remove Favicon
                        </button>
                        @endif
                    </div>

                    <input type="file" name="favicon" id="faviconFile" class="lm-file-input" accept="image/*,.ico" onchange="previewLogo(this, 'favicon')">

                    <div class="lm-url-section">
                        <label class="lm-url-label">Or enter URL directly:</label>
                        <input type="text" name="favicon_url" id="faviconUrl" class="lm-url-input"
                               placeholder="https://example.com/favicon.ico"
                               value="{{ $logos['favicon'] ?? '' }}">
                        <p class="lm-hint">
                            <i class="fas fa-info-circle"></i>
                            Recommended: 32x32px or 64x64px .ico or .png
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden fields for tracking which source to use -->
        <input type="hidden" name="header_source" id="headerSource" value="url">
        <input type="hidden" name="footer_source" id="footerSource" value="url">
        <input type="hidden" name="favicon_source" id="faviconSource" value="url">

        <div class="lm-save-section">
            <button type="submit" class="lm-save-btn">
                <i class="fas fa-save"></i>
                Save All Logos
            </button>
        </div>
    </form>

    <!-- Media Library Modal -->
    <div class="lm-modal-overlay" id="mediaModal">
        <div class="lm-modal">
            <div class="lm-modal-header">
                <h3><i class="fas fa-photo-video"></i>Media Library</h3>
                <button type="button" class="lm-modal-close" onclick="closeMediaLibrary()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="lm-modal-body">
                <!-- Upload Zone -->
                <div class="lm-upload-zone" id="modalUploadZone">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Click or drag files here to upload</p>
                    <input type="file" id="modalFileInput" accept="image/*" onchange="uploadMediaFile(this)">
                </div>

                <!-- Media Tabs -->
                <div class="lm-media-tabs">
                    <button type="button" class="lm-media-tab active" data-folder="logos" onclick="loadMediaFolder('logos')">
                        <i class="fas fa-image me-1"></i>Logos
                    </button>
                    <button type="button" class="lm-media-tab" data-folder="assets" onclick="loadMediaFolder('assets')">
                        <i class="fas fa-folder me-1"></i>Assets
                    </button>
                    <button type="button" class="lm-media-tab" data-folder="all" onclick="loadMediaFolder('all')">
                        <i class="fas fa-images me-1"></i>All Images
                    </button>
                </div>

                <!-- Media Grid -->
                <div class="lm-media-grid" id="mediaGrid">
                    <!-- Populated by JavaScript -->
                </div>
            </div>
            <div class="lm-modal-footer">
                <button type="button" class="lm-btn lm-btn-secondary" onclick="closeMediaLibrary()">Cancel</button>
                <button type="button" class="lm-btn lm-btn-primary" id="selectMediaBtn" onclick="selectMedia()" disabled>
                    <i class="fas fa-check me-1"></i>Select
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let currentTarget = null;
    let selectedMediaPath = null;

    // Preview logo when file is selected
    function previewLogo(input, type) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(type + 'Preview');
                const placeholder = document.getElementById(type + 'Placeholder');

                // Remove placeholder if exists
                if (placeholder) placeholder.style.display = 'none';

                // Update or create preview image
                let img = preview.querySelector('img');
                if (!img) {
                    img = document.createElement('img');
                    img.id = type + 'PreviewImg';
                    preview.appendChild(img);
                }
                img.src = e.target.result;
                img.style.display = 'block';

                // Set source to file
                document.getElementById(type + 'Source').value = 'file';

                // Clear URL input since we're using file
                document.getElementById(type + (type === 'favicon' ? '' : 'Logo') + 'Url').value = '';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Clear logo
    function clearLogo(type) {
        if (confirm('Are you sure you want to remove this ' + (type === 'favicon' ? 'favicon' : 'logo') + '?')) {
            const preview = document.getElementById(type + 'Preview');
            const img = preview.querySelector('img');
            const placeholder = document.getElementById(type + 'Placeholder');

            if (img) img.remove();
            if (placeholder) {
                placeholder.style.display = '';
            } else {
                preview.innerHTML = `<span class="placeholder" id="${type}Placeholder">
                    <i class="fas fa-image"></i>
                    No ${type === 'favicon' ? 'favicon' : 'logo'} set
                </span>`;
            }

            // Clear inputs
            document.getElementById(type + (type === 'favicon' ? '' : 'Logo') + 'File').value = '';
            document.getElementById(type + (type === 'favicon' ? '' : 'Logo') + 'Url').value = '';
            document.getElementById(type + 'Source').value = 'url';
        }
    }

    // Open Media Library
    function openMediaLibrary(target) {
        currentTarget = target;
        selectedMediaPath = null;
        document.getElementById('selectMediaBtn').disabled = true;
        document.getElementById('mediaModal').classList.add('show');
        loadMediaFolder('logos');
    }

    // Close Media Library
    function closeMediaLibrary() {
        document.getElementById('mediaModal').classList.remove('show');
        currentTarget = null;
        selectedMediaPath = null;
    }

    // Load media folder
    async function loadMediaFolder(folder) {
        // Update active tab
        document.querySelectorAll('.lm-media-tab').forEach(tab => {
            tab.classList.toggle('active', tab.dataset.folder === folder);
        });

        const grid = document.getElementById('mediaGrid');
        grid.innerHTML = '<div class="lm-empty"><i class="fas fa-spinner fa-spin"></i><p>Loading...</p></div>';

        try {
            const response = await fetch('/admin/logo-manager/media?folder=' + folder);
            const data = await response.json();

            if (data.success && data.files.length > 0) {
                grid.innerHTML = data.files.map(file => `
                    <div class="lm-media-item" onclick="selectMediaItem(this, '${file.path}')" data-path="${file.path}">
                        <img src="/${file.path}" alt="${file.name}" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22 font-size=%2210%22%3ENo Preview%3C/text%3E%3C/svg%3E'">
                        <span class="lm-check"><i class="fas fa-check"></i></span>
                        <span class="lm-name">${file.name}</span>
                    </div>
                `).join('');
            } else {
                grid.innerHTML = '<div class="lm-empty"><i class="fas fa-folder-open"></i><p>No images found in this folder</p></div>';
            }
        } catch (error) {
            grid.innerHTML = '<div class="lm-empty"><i class="fas fa-exclamation-triangle"></i><p>Error loading media</p></div>';
            console.error(error);
        }
    }

    // Select media item
    function selectMediaItem(element, path) {
        document.querySelectorAll('.lm-media-item').forEach(item => item.classList.remove('selected'));
        element.classList.add('selected');
        selectedMediaPath = path;
        document.getElementById('selectMediaBtn').disabled = false;
    }

    // Confirm media selection
    function selectMedia() {
        if (selectedMediaPath && currentTarget) {
            const preview = document.getElementById(currentTarget + 'Preview');
            const placeholder = document.getElementById(currentTarget + 'Placeholder');

            // Hide placeholder
            if (placeholder) placeholder.style.display = 'none';

            // Update preview
            let img = preview.querySelector('img');
            if (!img) {
                img = document.createElement('img');
                img.id = currentTarget + 'PreviewImg';
                preview.appendChild(img);
            }
            img.src = '/' + selectedMediaPath;
            img.style.display = 'block';

            // Update URL input
            const urlField = currentTarget + (currentTarget === 'favicon' ? '' : 'Logo') + 'Url';
            document.getElementById(urlField).value = selectedMediaPath;
            document.getElementById(currentTarget + 'Source').value = 'url';

            // Clear file input
            const fileField = currentTarget + (currentTarget === 'favicon' ? '' : 'Logo') + 'File';
            document.getElementById(fileField).value = '';

            closeMediaLibrary();
        }
    }

    // Upload file from modal
    async function uploadMediaFile(input) {
        if (input.files && input.files[0]) {
            const formData = new FormData();
            formData.append('file', input.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            try {
                const response = await fetch('/admin/logo-manager/upload', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();

                if (data.success) {
                    loadMediaFolder('logos');
                    alert('File uploaded successfully!');
                } else {
                    alert('Upload failed: ' + data.message);
                }
            } catch (error) {
                alert('Upload error');
                console.error(error);
            }

            input.value = '';
        }
    }

    // Drag and drop for upload zone
    const uploadZone = document.getElementById('modalUploadZone');
    if (uploadZone) {
        uploadZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('modalFileInput').files = files;
                uploadMediaFile(document.getElementById('modalFileInput'));
            }
        });
    }

    // Auto-hide success message
    const alertEl = document.querySelector('.lm-alert');
    if (alertEl) {
        setTimeout(() => {
            alertEl.style.animation = 'slideInDown 0.3s ease reverse';
            setTimeout(() => alertEl.remove(), 300);
        }, 5000);
    }

    // Handle URL input changes - clear file input when URL is manually entered
    document.querySelectorAll('.lm-url-input').forEach(input => {
        input.addEventListener('input', function() {
            const type = this.id.replace('LogoUrl', '').replace('Url', '');
            document.getElementById(type + 'Source').value = 'url';

            // If URL is entered, update preview
            if (this.value) {
                const preview = document.getElementById(type + 'Preview');
                const placeholder = document.getElementById(type + 'Placeholder');

                if (placeholder) placeholder.style.display = 'none';

                let img = preview.querySelector('img');
                if (!img) {
                    img = document.createElement('img');
                    img.id = type + 'PreviewImg';
                    preview.appendChild(img);
                }
                img.src = this.value.startsWith('http') ? this.value : '/' + this.value;
                img.style.display = 'block';

                // Clear file input
                const fileId = type + (type === 'favicon' ? '' : 'Logo') + 'File';
                const fileInput = document.getElementById(fileId);
                if (fileInput) fileInput.value = '';
            }
        });
    });
</script>
@endsection
