@extends('admin.layouts.app')

@section('title', 'Theme Import')

@section('styles')
<style>
    .theme-import-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .theme-import-header h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .theme-import-header p {
        opacity: 0.9;
        margin-bottom: 0;
    }

    .upload-zone {
        border: 3px dashed #dee2e6;
        border-radius: 15px;
        padding: 60px 40px;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .upload-zone:hover,
    .upload-zone.dragover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .upload-zone i {
        font-size: 64px;
        color: #667eea;
        margin-bottom: 20px;
    }

    .upload-zone h4 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .upload-zone p {
        color: #666;
        margin-bottom: 20px;
    }

    .theme-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .theme-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .theme-preview {
        position: relative;
        height: 180px;
        overflow: hidden;
    }

    .theme-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .theme-preview-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .theme-card:hover .theme-preview-overlay {
        opacity: 1;
    }

    .theme-preview-overlay .btn {
        padding: 8px 16px;
        font-size: 13px;
    }

    .theme-info {
        padding: 20px;
    }

    .theme-info h5 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .theme-meta {
        font-size: 13px;
        color: #666;
        margin-bottom: 10px;
    }

    .theme-meta span {
        margin-right: 15px;
    }

    .theme-description {
        font-size: 14px;
        color: #555;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .theme-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .theme-tag {
        background: #f0f0f0;
        color: #666;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eee;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #f8f9fa;
        border-radius: 15px;
    }

    .empty-state i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .docs-card {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
    }

    .docs-card h4 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .docs-card p {
        opacity: 0.9;
        margin-bottom: 15px;
    }

    .docs-card .btn {
        background: white;
        color: #11998e;
        border: none;
    }

    .docs-card .btn:hover {
        background: rgba(255, 255, 255, 0.9);
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="theme-import-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1><i class="fas fa-palette me-2"></i>Theme Import</h1>
                <p>Import custom themes or download themes from the marketplace</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('admin.themes') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Back to Themes
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Upload Section -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body p-4">
                    <h4 class="section-title"><i class="fas fa-upload me-2"></i>Upload Theme</h4>

                    <form action="{{ route('admin.theme-import.import') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        <div class="upload-zone" id="uploadZone" onclick="document.getElementById('themeZip').click()">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <h4>Drag & Drop Theme Package</h4>
                            <p>or click to browse files</p>
                            <input type="file" name="theme_zip" id="themeZip" accept=".zip" style="display: none;">
                            <div id="selectedFile" class="mt-3" style="display: none;">
                                <span class="badge bg-primary p-2">
                                    <i class="fas fa-file-archive me-2"></i>
                                    <span id="fileName"></span>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" id="uploadBtn" style="display: none;">
                                <i class="fas fa-upload me-2"></i>Import Theme
                            </button>
                        </div>
                        <small class="text-muted d-block mt-2">
                            Supported: .zip files up to 50MB. Theme must include theme.json and preview.jpg
                        </small>
                    </form>
                </div>
            </div>

            <!-- Installed Themes -->
            <h4 class="section-title"><i class="fas fa-box-open me-2"></i>Imported Themes</h4>

            @if(count($installedThemes) > 0)
                <div class="row">
                    @foreach($installedThemes as $theme)
                        <div class="col-md-6 mb-4">
                            <div class="theme-card">
                                <div class="theme-preview">
                                    <img src="{{ $theme['preview_url'] ?? asset('assets/img/placeholder.jpg') }}"
                                         alt="{{ $theme['name'] }}"
                                         onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                                    <div class="theme-preview-overlay">
                                        <a href="{{ route('admin.theme-import.show', $theme['slug']) }}" class="btn btn-light btn-sm">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                        <form action="{{ route('admin.theme-import.destroy', $theme['slug']) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this theme?')">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="theme-info">
                                    <h5>{{ $theme['name'] }}</h5>
                                    <div class="theme-meta">
                                        <span><i class="fas fa-user me-1"></i>{{ $theme['author'] ?? 'Unknown' }}</span>
                                        <span><i class="fas fa-code-branch me-1"></i>v{{ $theme['version'] ?? '1.0.0' }}</span>
                                    </div>
                                    <p class="theme-description">{{ $theme['description'] ?? 'No description available' }}</p>
                                    @if(!empty($theme['tags']))
                                        <div class="theme-tags">
                                            @foreach($theme['tags'] as $tag)
                                                <span class="theme-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h5>No Imported Themes</h5>
                    <p class="text-muted">Upload a theme package to get started</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Developer Docs -->
            <div class="docs-card">
                <h4><i class="fas fa-book me-2"></i>Developer Guide</h4>
                <p>Learn how to create themes compatible with our Page Builder system.</p>
                <a href="{{ route('admin.theme-import.docs') }}" class="btn">
                    <i class="fas fa-download me-2"></i>Download Documentation
                </a>
            </div>

            <!-- Requirements Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-clipboard-check me-2 text-primary"></i>Theme Requirements</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>theme.json</strong> - Metadata file
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>preview.jpg</strong> - 1200x800px preview
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-circle text-muted me-2"></i>
                            <strong>sections/</strong> - Blade partials
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-circle text-muted me-2"></i>
                            <strong>assets/</strong> - CSS, JS, Images
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-circle text-muted me-2"></i>
                            <strong>config/sections.json</strong> - Section definitions
                        </li>
                        <li>
                            <i class="fas fa-circle text-muted me-2"></i>
                            <strong>sample-data/</strong> - Demo pages
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><i class="fas fa-link me-2 text-primary"></i>Quick Links</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.themes') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-palette me-2"></i>Theme Manager
                        </a>
                        <a href="{{ route('admin.page-builder.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Page Builder
                        </a>
                        <a href="{{ route('admin.media-library') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-images me-2"></i>Media Library
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const uploadZone = document.getElementById('uploadZone');
    const fileInput = document.getElementById('themeZip');
    const selectedFile = document.getElementById('selectedFile');
    const fileName = document.getElementById('fileName');
    const uploadBtn = document.getElementById('uploadBtn');

    // Drag and drop
    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('dragover');
    });

    uploadZone.addEventListener('dragleave', () => {
        uploadZone.classList.remove('dragover');
    });

    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('dragover');

        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].name.endsWith('.zip')) {
            fileInput.files = files;
            showSelectedFile(files[0]);
        } else {
            alert('Please upload a .zip file');
        }
    });

    // File selection
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            showSelectedFile(e.target.files[0]);
        }
    });

    function showSelectedFile(file) {
        fileName.textContent = file.name;
        selectedFile.style.display = 'block';
        uploadBtn.style.display = 'inline-block';
    }

    // Prevent form double submission
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Importing...';
    });
</script>
@endsection
