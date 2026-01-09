@extends('admin.layouts.app')

@section('title', 'Media Library')

@section('styles')
<style>
    /* View Toggle Buttons */
    .view-toggle {
        display: flex;
        gap: 5px;
    }

    .view-toggle button {
        padding: 8px 15px;
        border: 2px solid var(--border-color);
        background: white;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .view-toggle button.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .view-toggle button:hover:not(.active) {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    /* Filter Tabs */
    .media-filters {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .media-filter-btn {
        padding: 8px 18px;
        border: 2px solid var(--border-color);
        background: white;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 13px;
        font-weight: 500;
    }

    .media-filter-btn.active {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .media-filter-btn:hover:not(.active) {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    /* Search Bar */
    .media-search {
        position: relative;
        max-width: 300px;
    }

    .media-search input {
        width: 100%;
        padding: 10px 40px 10px 15px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
    }

    .media-search input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .media-search i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    /* Grid View */
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 20px;
    }

    .media-grid.list-view {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .media-grid.list-view .media-card {
        display: flex;
        flex-direction: row;
        border-radius: 10px;
    }

    .media-grid.list-view .media-preview {
        width: 100px;
        height: 80px;
        min-width: 100px;
        border-radius: 10px 0 0 10px;
    }

    .media-grid.list-view .media-info {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .media-grid.list-view .media-actions {
        padding: 0 15px;
        flex-shrink: 0;
    }

    /* Media Card Enhancements */
    .media-card {
        position: relative;
        cursor: pointer;
    }

    .media-card .select-overlay {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: white;
        border: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .media-card:hover .select-overlay {
        opacity: 1;
    }

    .media-card.selected .select-overlay {
        opacity: 1;
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .media-card .preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        border-radius: 12px 12px 0 0;
    }

    .media-card:hover .preview-overlay {
        opacity: 1;
    }

    .media-card .preview-overlay i {
        font-size: 32px;
        color: white;
    }

    /* Lightbox */
    .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.9);
        z-index: 9999;
        padding: 30px;
    }

    .lightbox.active {
        display: flex;
    }

    .lightbox-content {
        display: flex;
        width: 100%;
        height: 100%;
        gap: 30px;
    }

    .lightbox-image {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .lightbox-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 8px;
    }

    .lightbox-image .file-icon {
        font-size: 120px;
        color: white;
    }

    .lightbox-sidebar {
        width: 350px;
        background: white;
        border-radius: 12px;
        padding: 25px;
        overflow-y: auto;
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .lightbox-close:hover {
        background: var(--primary-color);
    }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .lightbox-nav:hover {
        background: var(--primary-color);
    }

    .lightbox-prev {
        left: 20px;
    }

    .lightbox-next {
        right: 380px;
    }

    .lightbox-info h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        word-break: break-all;
        color: var(--secondary-color);
    }

    .lightbox-info .info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
        font-size: 13px;
    }

    .lightbox-info .info-row .label {
        color: #666;
    }

    .lightbox-info .info-row .value {
        font-weight: 500;
        color: var(--secondary-color);
        word-break: break-all;
        text-align: right;
        max-width: 200px;
    }

    .lightbox-actions {
        margin-top: 25px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .lightbox-actions button {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .lightbox-actions .btn-copy-url {
        background: var(--primary-color);
        color: white;
    }

    .lightbox-actions .btn-copy-url:hover {
        background: var(--primary-dark);
    }

    .lightbox-actions .btn-download {
        background: var(--success-color);
        color: white;
    }

    .lightbox-actions .btn-download:hover {
        background: #218838;
    }

    .lightbox-actions .btn-delete-file {
        background: #fee;
        color: var(--danger-color);
    }

    .lightbox-actions .btn-delete-file:hover {
        background: var(--danger-color);
        color: white;
    }

    .url-input-group {
        margin-top: 15px;
    }

    .url-input-group label {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
        display: block;
    }

    .url-input-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        font-size: 12px;
        background: var(--light-bg);
    }

    /* Bulk Actions */
    .bulk-actions {
        display: none;
        background: white;
        padding: 15px 20px;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        margin-bottom: 20px;
        align-items: center;
        gap: 15px;
    }

    .bulk-actions.active {
        display: flex;
    }

    .bulk-actions .selected-count {
        font-weight: 600;
        color: var(--secondary-color);
    }

    .bulk-actions button {
        padding: 8px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .bulk-actions .btn-clear {
        background: var(--light-bg);
        color: #666;
    }

    .bulk-actions .btn-bulk-delete {
        background: var(--danger-color);
        color: white;
    }

    /* Folder badges */
    .folder-badge {
        position: absolute;
        bottom: 60px;
        left: 10px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 10px;
        max-width: calc(100% - 20px);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .lightbox-sidebar {
            display: none;
        }

        .lightbox-next {
            right: 20px;
        }
    }

    @media (max-width: 768px) {
        .media-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 15px;
        }

        .filter-bar {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }

        .media-search {
            max-width: 100%;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-photo-video me-3"></i>Media Library</h1>
        <p>Upload and manage your media files - All images from your website</p>
    </div>

    <!-- Upload Section -->
    <div class="upload-section">
        <form action="/admin/media-library/upload" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="upload-zone" id="uploadZone">
                <input type="file" name="files[]" multiple accept="image/*,video/*,.pdf">
                <i class="fas fa-cloud-upload-alt"></i>
                <h4>Drag & Drop Files Here</h4>
                <p>or click to browse (JPG, PNG, GIF, SVG, MP4, PDF - Max 10MB)</p>
            </div>
        </form>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <h5 class="mb-0"><i class="fas fa-images me-2"></i>All Media</h5>
            <span class="text-muted">{{ count($media) }} file(s)</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div class="media-search">
                <input type="text" id="mediaSearch" placeholder="Search files...">
                <i class="fas fa-search"></i>
            </div>
            <div class="view-toggle">
                <button class="active" data-view="grid" title="Grid View">
                    <i class="fas fa-th"></i>
                </button>
                <button data-view="list" title="List View">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Media Type Filters -->
    <div class="media-filters">
        <button class="media-filter-btn active" data-filter="all">
            <i class="fas fa-globe me-1"></i> All
        </button>
        <button class="media-filter-btn" data-filter="image">
            <i class="fas fa-image me-1"></i> Images
        </button>
        <button class="media-filter-btn" data-filter="video">
            <i class="fas fa-video me-1"></i> Videos
        </button>
        <button class="media-filter-btn" data-filter="pdf">
            <i class="fas fa-file-pdf me-1"></i> PDFs
        </button>
        <button class="media-filter-btn" data-filter="svg">
            <i class="fas fa-bezier-curve me-1"></i> SVGs
        </button>
    </div>

    <!-- Bulk Actions -->
    <div class="bulk-actions" id="bulkActions">
        <span class="selected-count"><span id="selectedCount">0</span> selected</span>
        <button class="btn-clear" onclick="clearSelection()">
            <i class="fas fa-times me-1"></i> Clear
        </button>
        <button class="btn-bulk-delete" onclick="bulkDelete()">
            <i class="fas fa-trash me-1"></i> Delete Selected
        </button>
    </div>

    <!-- Media Grid -->
    @if(count($media) > 0)
        <div class="media-grid" id="mediaGrid">
            @foreach($media as $index => $file)
                @php
                    $isImage = in_array($file['type'], ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'ico']);
                    $isPdf = $file['type'] == 'pdf';
                    $isVideo = $file['type'] == 'mp4';
                    $filterType = $isImage ? ($file['type'] == 'svg' ? 'svg' : 'image') : ($isPdf ? 'pdf' : ($isVideo ? 'video' : 'other'));
                @endphp
                <div class="media-card"
                     id="media-{{ md5($file['path']) }}"
                     data-index="{{ $index }}"
                     data-name="{{ strtolower($file['name']) }}"
                     data-type="{{ $filterType }}"
                     data-url="{{ $file['url'] }}"
                     data-path="{{ $file['path'] }}"
                     data-size="{{ $file['size'] }}"
                     data-modified="{{ $file['modified'] }}"
                     data-folder="{{ $file['folder'] ?? '' }}"
                     onclick="openLightbox({{ $index }})">

                    <div class="select-overlay" onclick="event.stopPropagation(); toggleSelect(this.parentElement)">
                        <i class="fas fa-check"></i>
                    </div>

                    <div class="media-preview">
                        @if($isImage)
                            <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" loading="lazy">
                            <div class="preview-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        @elseif($isPdf)
                            <i class="fas fa-file-pdf file-icon"></i>
                        @elseif($isVideo)
                            <i class="fas fa-file-video file-icon"></i>
                        @else
                            <i class="fas fa-file file-icon"></i>
                        @endif
                    </div>

                    @if(isset($file['folder']) && $file['folder'])
                        <span class="folder-badge" title="{{ $file['folder'] }}">{{ basename($file['folder']) }}</span>
                    @endif

                    <div class="media-info">
                        <h6 title="{{ $file['name'] }}">{{ $file['name'] }}</h6>
                        <p>{{ $file['size'] }} &bull; {{ $file['type'] }}</p>
                    </div>

                    <div class="media-actions">
                        <button class="btn-copy" onclick="event.stopPropagation(); copyUrl('{{ $file['url'] }}')" title="Copy URL">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                        <button class="btn-delete" onclick="event.stopPropagation(); deleteFile('{{ $file['path'] }}', '{{ md5($file['path']) }}')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-images"></i>
            <h4>No Media Files</h4>
            <p>Upload some files to get started</p>
        </div>
    @endif

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <button class="lightbox-nav lightbox-prev" onclick="navigateLightbox(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-nav lightbox-next" onclick="navigateLightbox(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <div class="lightbox-content">
            <div class="lightbox-image" id="lightboxImage">
                <!-- Image or icon will be inserted here -->
            </div>
            <div class="lightbox-sidebar">
                <div class="lightbox-info">
                    <h4 id="lightboxTitle">File Name</h4>
                    <div class="info-row">
                        <span class="label">Type</span>
                        <span class="value" id="lightboxType">-</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Size</span>
                        <span class="value" id="lightboxSize">-</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Modified</span>
                        <span class="value" id="lightboxModified">-</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Folder</span>
                        <span class="value" id="lightboxFolder">-</span>
                    </div>

                    <div class="url-input-group">
                        <label>File URL</label>
                        <input type="text" id="lightboxUrl" readonly onclick="this.select()">
                    </div>

                    <div class="lightbox-actions">
                        <button class="btn-copy-url" onclick="copyLightboxUrl()">
                            <i class="fas fa-copy"></i> Copy URL
                        </button>
                        <a id="lightboxDownload" href="#" download class="btn-download" style="text-decoration: none;">
                            <i class="fas fa-download"></i> Download
                        </a>
                        <button class="btn-delete-file" id="lightboxDeleteBtn">
                            <i class="fas fa-trash"></i> Delete File
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Media data array
    const mediaItems = @json($media);
    let currentIndex = 0;
    let selectedItems = new Set();
    let filteredIndices = [...Array(mediaItems.length).keys()];

    // Drag & Drop Upload
    const uploadZone = document.getElementById('uploadZone');
    const uploadForm = document.getElementById('uploadForm');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.add('dragover'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.remove('dragover'), false);
    });

    uploadZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        const input = uploadZone.querySelector('input[type="file"]');
        input.files = files;
        uploadForm.submit();
    }

    // Auto-submit on file select
    document.querySelector('#uploadForm input[type="file"]').addEventListener('change', function() {
        if (this.files.length > 0) {
            uploadForm.submit();
        }
    });

    // View Toggle
    document.querySelectorAll('.view-toggle button').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-toggle button').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const view = this.dataset.view;
            const grid = document.getElementById('mediaGrid');

            if (view === 'list') {
                grid.classList.add('list-view');
            } else {
                grid.classList.remove('list-view');
            }
        });
    });

    // Filter by Type
    document.querySelectorAll('.media-filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.media-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            filterMedia(filter);
        });
    });

    function filterMedia(type) {
        const searchTerm = document.getElementById('mediaSearch').value.toLowerCase();
        filteredIndices = [];

        document.querySelectorAll('.media-card').forEach((card, index) => {
            const cardType = card.dataset.type;
            const cardName = card.dataset.name;
            const matchesType = type === 'all' || cardType === type;
            const matchesSearch = cardName.includes(searchTerm);

            if (matchesType && matchesSearch) {
                card.style.display = '';
                filteredIndices.push(index);
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Search
    document.getElementById('mediaSearch').addEventListener('input', function() {
        const activeFilter = document.querySelector('.media-filter-btn.active').dataset.filter;
        filterMedia(activeFilter);
    });

    // Copy URL
    function copyUrl(url) {
        navigator.clipboard.writeText(url).then(() => {
            showToast('URL copied to clipboard!');
        });
    }

    // Delete file
    function deleteFile(path, id) {
        if (!confirm('Are you sure you want to delete this file?')) return;

        fetch('/admin/media-library/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ path: path })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('media-' + id).remove();
                showToast('File deleted successfully');
                closeLightbox();
            } else {
                alert('Error deleting file');
            }
        });
    }

    // Selection
    function toggleSelect(card) {
        const index = parseInt(card.dataset.index);

        if (selectedItems.has(index)) {
            selectedItems.delete(index);
            card.classList.remove('selected');
        } else {
            selectedItems.add(index);
            card.classList.add('selected');
        }

        updateBulkActions();
    }

    function updateBulkActions() {
        const bulkActions = document.getElementById('bulkActions');
        const countEl = document.getElementById('selectedCount');

        if (selectedItems.size > 0) {
            bulkActions.classList.add('active');
            countEl.textContent = selectedItems.size;
        } else {
            bulkActions.classList.remove('active');
        }
    }

    function clearSelection() {
        selectedItems.clear();
        document.querySelectorAll('.media-card').forEach(card => {
            card.classList.remove('selected');
        });
        updateBulkActions();
    }

    function bulkDelete() {
        if (selectedItems.size === 0) return;
        if (!confirm(`Are you sure you want to delete ${selectedItems.size} file(s)?`)) return;

        // Delete each selected item
        selectedItems.forEach(index => {
            const card = document.querySelector(`.media-card[data-index="${index}"]`);
            if (card) {
                const path = card.dataset.path;
                fetch('/admin/media-library/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ path: path })
                });
                card.remove();
            }
        });

        selectedItems.clear();
        updateBulkActions();
        showToast('Files deleted successfully');
    }

    // Lightbox
    function openLightbox(index) {
        currentIndex = index;
        const item = mediaItems[index];
        const lightbox = document.getElementById('lightbox');
        const imageContainer = document.getElementById('lightboxImage');

        // Determine if image
        const imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'ico'];
        const isImage = imageTypes.includes(item.type.toLowerCase());

        if (isImage) {
            imageContainer.innerHTML = `<img src="${item.url}" alt="${item.name}">`;
        } else if (item.type === 'pdf') {
            imageContainer.innerHTML = `<i class="fas fa-file-pdf file-icon"></i>`;
        } else if (item.type === 'mp4') {
            imageContainer.innerHTML = `<video src="${item.url}" controls style="max-width: 100%; max-height: 100%;"></video>`;
        } else {
            imageContainer.innerHTML = `<i class="fas fa-file file-icon"></i>`;
        }

        // Update info
        document.getElementById('lightboxTitle').textContent = item.name;
        document.getElementById('lightboxType').textContent = item.type.toUpperCase();
        document.getElementById('lightboxSize').textContent = item.size;
        document.getElementById('lightboxModified').textContent = item.modified;
        document.getElementById('lightboxFolder').textContent = item.folder || 'Root';
        document.getElementById('lightboxUrl').value = item.url;
        document.getElementById('lightboxDownload').href = item.url;
        document.getElementById('lightboxDeleteBtn').onclick = () => deleteFile(item.path, md5(item.path));

        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
        document.body.style.overflow = '';
    }

    function navigateLightbox(direction) {
        const currentFilteredIndex = filteredIndices.indexOf(currentIndex);
        let newFilteredIndex = currentFilteredIndex + direction;

        if (newFilteredIndex < 0) newFilteredIndex = filteredIndices.length - 1;
        if (newFilteredIndex >= filteredIndices.length) newFilteredIndex = 0;

        openLightbox(filteredIndices[newFilteredIndex]);
    }

    function copyLightboxUrl() {
        const url = document.getElementById('lightboxUrl').value;
        navigator.clipboard.writeText(url).then(() => {
            showToast('URL copied to clipboard!');
        });
    }

    // Simple MD5 hash for ID generation (placeholder)
    function md5(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            const char = str.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash;
        }
        return Math.abs(hash).toString(16);
    }

    // Toast notification
    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'alert alert-success';
        toast.style.cssText = 'position: fixed; bottom: 20px; right: 20px; z-index: 10000; animation: slideInDown 0.3s ease;';
        toast.innerHTML = `<i class="fas fa-check-circle me-2"></i>${message}`;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideInDown 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!document.getElementById('lightbox').classList.contains('active')) return;

        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigateLightbox(-1);
        if (e.key === 'ArrowRight') navigateLightbox(1);
    });

    // Close lightbox on background click
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this || e.target.classList.contains('lightbox-image')) {
            closeLightbox();
        }
    });
</script>
@endsection
