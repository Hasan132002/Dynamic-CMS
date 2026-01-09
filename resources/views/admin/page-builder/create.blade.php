@extends('admin.layouts.app')

@section('title', 'Create New Page')

@section('styles')
<style>
    .page-builder-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-builder-header h1 {
        font-size: 28px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
    }

    .btn-back {
        background: #f0f0f0;
        color: #555;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        background: #e0e0e0;
        color: #333;
    }

    .create-form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .form-section {
        padding: 30px;
        border-bottom: 1px solid #f0f0f0;
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-title i {
        color: #667eea;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }

    .form-group label .required {
        color: #dc3545;
    }

    .form-group .hint {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .slug-preview {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 8px;
        font-family: 'Monaco', monospace;
        font-size: 13px;
        color: #666;
        margin-top: 8px;
    }

    .slug-preview span {
        color: #667eea;
    }

    /* Template Selection */
    .template-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .template-option {
        border: 3px solid #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .template-option:hover {
        border-color: #667eea;
    }

    .template-option.selected {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .template-option input {
        display: none;
    }

    .template-preview {
        height: 120px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .template-preview i {
        font-size: 36px;
        color: #667eea;
        opacity: 0.5;
    }

    .template-info {
        padding: 15px;
        text-align: center;
    }

    .template-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 5px 0;
    }

    .template-info p {
        font-size: 12px;
        color: #888;
        margin: 0;
    }

    .template-option.selected .template-info {
        background: #667eea;
    }

    .template-option.selected .template-info h4,
    .template-option.selected .template-info p {
        color: white;
    }

    /* Status Toggle */
    .status-toggle {
        display: flex;
        gap: 15px;
    }

    .status-option {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .status-option:hover {
        border-color: #667eea;
    }

    .status-option.selected {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.1);
    }

    .status-option input {
        display: none;
    }

    .status-option i {
        font-size: 24px;
        margin-bottom: 8px;
        display: block;
    }

    .status-option.draft i {
        color: #ffc107;
    }

    .status-option.published i {
        color: #28a745;
    }

    .status-option h4 {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    /* Form Actions */
    .form-actions {
        padding: 25px 30px;
        background: #f8f9fa;
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .btn-cancel {
        background: white;
        color: #666;
        border: 2px solid #e0e0e0;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background: #f0f0f0;
        color: #333;
    }

    .btn-create {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
<div class="page-builder-header">
    <h1><i class="fas fa-plus-circle me-2"></i>Create New Page</h1>
    <a href="{{ route('admin.page-builder.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Pages
    </a>
</div>

<form action="{{ route('admin.page-builder.store') }}" method="POST" id="createPageForm">
    @csrf

    <div class="create-form-card">
        <!-- Basic Info -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-info-circle"></i> Basic Information
            </h3>

            <div class="form-group">
                <label>Page Title <span class="required">*</span></label>
                <input type="text" name="title" class="form-control" id="pageTitle"
                       value="{{ old('title') }}" placeholder="Enter page title" required>
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>URL Slug <span class="required">*</span></label>
                <input type="text" name="slug" class="form-control" id="pageSlug"
                       value="{{ old('slug') }}" placeholder="page-url-slug" required
                       pattern="[a-z0-9-]+" title="Only lowercase letters, numbers, and hyphens">
                <div class="slug-preview">
                    Preview: <span>{{ url('/') }}/<span id="slugPreview">your-page-slug</span></span>
                </div>
                <div class="hint">Use lowercase letters, numbers, and hyphens only</div>
                @error('slug')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Template Selection -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-palette"></i> Choose Template
            </h3>

            <div class="template-grid">
                @foreach($templates as $key => $template)
                    <label class="template-option {{ old('template', 'default') === $key ? 'selected' : '' }}">
                        <input type="radio" name="template" value="{{ $key }}"
                               {{ old('template', 'default') === $key ? 'checked' : '' }}>
                        <div class="template-preview">
                            @if($key === 'default')
                                <i class="fas fa-file-alt"></i>
                            @elseif($key === 'full-width')
                                <i class="fas fa-arrows-alt-h"></i>
                            @elseif($key === 'sidebar-left')
                                <i class="fas fa-columns"></i>
                            @elseif($key === 'sidebar-right')
                                <i class="fas fa-columns fa-flip-horizontal"></i>
                            @elseif($key === 'landing')
                                <i class="fas fa-rocket"></i>
                            @else
                                <i class="fas fa-file"></i>
                            @endif
                        </div>
                        <div class="template-info">
                            <h4>{{ $template['name'] }}</h4>
                            <p>{{ $template['description'] }}</p>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-search"></i> SEO Settings
            </h3>

            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="meta_title" class="form-control"
                       value="{{ old('meta_title') }}" placeholder="Leave empty to use page title">
                <div class="hint">Recommended: 50-60 characters</div>
            </div>

            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="3"
                          placeholder="Brief description of this page for search engines">{{ old('meta_description') }}</textarea>
                <div class="hint">Recommended: 150-160 characters</div>
            </div>
        </div>

        <!-- Status -->
        <div class="form-section">
            <h3 class="form-section-title">
                <i class="fas fa-toggle-on"></i> Page Status
            </h3>

            <div class="status-toggle">
                <label class="status-option draft {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}">
                    <input type="radio" name="status" value="draft"
                           {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}>
                    <i class="fas fa-pencil-alt"></i>
                    <h4>Draft</h4>
                    <small>Save and continue editing later</small>
                </label>

                <label class="status-option published {{ old('status') === 'published' ? 'selected' : '' }}">
                    <input type="radio" name="status" value="published"
                           {{ old('status') === 'published' ? 'checked' : '' }}>
                    <i class="fas fa-globe"></i>
                    <h4>Published</h4>
                    <small>Make page visible to visitors</small>
                </label>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ route('admin.page-builder.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-create">
                <i class="fas fa-plus"></i> Create Page
            </button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
    // Auto-generate slug from title
    const titleInput = document.getElementById('pageTitle');
    const slugInput = document.getElementById('pageSlug');
    const slugPreview = document.getElementById('slugPreview');
    let slugManuallyEdited = false;

    titleInput.addEventListener('input', function() {
        if (!slugManuallyEdited) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            slugInput.value = slug;
            slugPreview.textContent = slug || 'your-page-slug';
        }
    });

    slugInput.addEventListener('input', function() {
        slugManuallyEdited = true;
        // Sanitize input
        this.value = this.value.toLowerCase().replace(/[^a-z0-9-]/g, '');
        slugPreview.textContent = this.value || 'your-page-slug';
    });

    // Template selection
    document.querySelectorAll('.template-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.template-option').forEach(o => o.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Status selection
    document.querySelectorAll('.status-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.status-option').forEach(o => o.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
</script>
@endsection
