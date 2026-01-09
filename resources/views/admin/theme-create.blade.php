@extends('admin.layouts.app')

@section('title', 'Create New Theme')

@section('styles')
<style>
    /* Form Styles */
    .form-card {
        background: var(--white);
        border-radius: var(--card-radius);
        border: 1px solid var(--border-light);
        padding: 30px;
        max-width: 800px;
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

    .form-control.is-invalid {
        border-color: var(--danger-color);
    }

    .invalid-feedback {
        color: var(--danger-color);
        font-size: 12px;
        margin-top: 5px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Version Select */
    .version-select-group {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    /* Copy From Section */
    .copy-from-section {
        background: var(--light-bg);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .copy-from-section label {
        margin-bottom: 10px;
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

    .alert-error {
        background: #f8d7da;
        color: var(--danger-color);
        border-left: 4px solid var(--danger-color);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .version-select-group {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.themes') }}"><i class="fas fa-palette me-1"></i>Theme Manager</a>
        <span>/</span>
        <span>Create New Theme</span>
    </div>

    <div class="page-header">
        <h1><i class="fas fa-plus-circle me-3"></i>Create New Theme</h1>
        <p>Create a new theme with custom configuration</p>
    </div>

    @if(session('error'))
    <div class="alert-custom alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <div class="form-card">
        <form action="{{ route('admin.themes.store') }}" method="POST">
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
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="e.g., Modern Dark Theme" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Theme Slug <span class="required">*</span></label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                               value="{{ old('slug') }}" placeholder="e.g., modern-dark" required
                               pattern="[a-z0-9-]+" title="Only lowercase letters, numbers, and hyphens">
                        <small>Lowercase letters, numbers, and hyphens only. This will be the folder name.</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Describe your theme...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company" class="form-control"
                           value="{{ old('company') }}" placeholder="e.g., Educve Inc.">
                </div>
            </div>

            <!-- Copy From Existing -->
            <div class="form-section">
                <div class="form-section-title">
                    <i class="fas fa-copy"></i>
                    Copy From Existing (Optional)
                </div>

                <div class="copy-from-section">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Base Theme</label>
                        <select name="copy_from" class="form-control">
                            <option value="">-- Start Fresh --</option>
                            @foreach($existingThemes as $theme)
                                <option value="{{ $theme['slug'] }}">{{ $theme['name'] }}</option>
                            @endforeach
                        </select>
                        <small>Copy configuration from an existing theme as a starting point.</small>
                    </div>
                </div>
            </div>

            <!-- Version Selection -->
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
                                <option value="{{ $version }}" {{ old('home_version', 'home-v1') == $version ? 'selected' : '' }}>
                                    {{ $version }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Header Version <span class="required">*</span></label>
                        <select name="header_version" class="form-control" required>
                            @foreach($headerVersions as $version)
                                <option value="{{ $version }}" {{ old('header_version', 'header-v1') == $version ? 'selected' : '' }}>
                                    {{ $version }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Footer Version <span class="required">*</span></label>
                        <select name="footer_version" class="form-control" required>
                            @foreach($footerVersions as $version)
                                <option value="{{ $version }}" {{ old('footer_version', 'footer-v1') == $version ? 'selected' : '' }}>
                                    {{ $version }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-plus"></i>
                    Create Theme
                </button>
                <a href="{{ route('admin.themes') }}" class="btn-secondary">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    // Auto-generate slug from name
    document.querySelector('input[name="name"]').addEventListener('input', function(e) {
        const slugInput = document.querySelector('input[name="slug"]');
        if (!slugInput.dataset.manual) {
            slugInput.value = e.target.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
        }
    });

    // Mark slug as manually edited
    document.querySelector('input[name="slug"]').addEventListener('input', function(e) {
        this.dataset.manual = 'true';
    });
</script>
@endsection
