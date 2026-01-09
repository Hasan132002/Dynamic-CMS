@extends('admin.layouts.app')

@section('title', 'SEO Settings')

@section('styles')
<style>
    .settings-form {
        display: grid;
        gap: 25px;
    }

    .settings-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: var(--card-shadow);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .section-header i {
        width: 40px;
        height: 40px;
        background: var(--primary-color);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .section-header h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        color: var(--secondary-color);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--secondary-color);
    }

    .form-group small {
        display: block;
        color: #999;
        font-size: 12px;
        margin-top: 5px;
    }

    .form-control-custom {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(194, 0, 0, 0.1);
    }

    textarea.form-control-custom {
        min-height: 100px;
        resize: vertical;
    }

    .btn-save {
        background: linear-gradient(135deg, var(--success-color), #1e7e34);
        color: white;
        border: none;
        padding: 15px 40px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.3);
    }

    .toggle-switch {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .toggle-switch input[type="checkbox"] {
        width: 50px;
        height: 26px;
        appearance: none;
        background: #ddd;
        border-radius: 15px;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .toggle-switch input[type="checkbox"]::before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 50%;
        top: 3px;
        left: 3px;
        transition: all 0.3s ease;
    }

    .toggle-switch input[type="checkbox"]:checked {
        background: var(--success-color);
    }

    .toggle-switch input[type="checkbox"]:checked::before {
        left: 27px;
    }

    .seo-preview {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
    }

    .seo-preview-title {
        color: #1a0dab;
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .seo-preview-url {
        color: #006621;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .seo-preview-desc {
        color: #545454;
        font-size: 13px;
        line-height: 1.5;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-search me-3"></i>SEO Settings</h1>
        <p>Optimize your website for search engines</p>
    </div>

    <form action="/admin/seo" method="POST" class="settings-form">
        @csrf

        <!-- Global SEO -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-globe"></i>
                <h3>Global SEO Settings</h3>
            </div>

            <div class="form-group">
                <label>Title Suffix</label>
                <input type="text" name="title_suffix" class="form-control-custom"
                       value="{{ $seo['global']['title_suffix'] ?? '' }}"
                       placeholder="| Your Site Name">
                <small>This will be appended to all page titles (e.g., "About Us | Your Site Name")</small>
            </div>

            <div class="form-group">
                <label>Default Meta Description</label>
                <textarea name="meta_description" class="form-control-custom" rows="3"
                          placeholder="A brief description of your website (150-160 characters recommended)">{{ $seo['global']['meta_description'] ?? '' }}</textarea>
                <small>Used when pages don't have their own meta description</small>
            </div>

            <div class="form-group">
                <label>Default Meta Keywords</label>
                <input type="text" name="meta_keywords" class="form-control-custom"
                       value="{{ $seo['global']['meta_keywords'] ?? '' }}"
                       placeholder="education, courses, learning, online">
                <small>Separate keywords with commas</small>
            </div>

            <div class="form-group">
                <label>Default OG Image URL</label>
                <input type="text" name="og_image" class="form-control-custom"
                       value="{{ $seo['global']['og_image'] ?? '' }}"
                       placeholder="https://yoursite.com/og-image.jpg">
                <small>Default image for social media sharing (1200x630px recommended)</small>
            </div>

            <!-- Preview -->
            <div class="seo-preview">
                <h6 class="mb-3"><i class="fas fa-eye me-2"></i>Google Search Preview</h6>
                <div class="seo-preview-title">Your Page Title {{ $seo['global']['title_suffix'] ?? '| Site Name' }}</div>
                <div class="seo-preview-url">https://yoursite.com/page</div>
                <div class="seo-preview-desc">{{ $seo['global']['meta_description'] ?? 'Your meta description will appear here...' }}</div>
            </div>
        </div>

        <!-- Robots -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-robot"></i>
                <h3>Robot Settings</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="toggle-switch">
                            <input type="checkbox" name="robots_index"
                                   {{ ($seo['robots']['index'] ?? true) ? 'checked' : '' }}>
                            <span>Allow Search Engine Indexing</span>
                        </label>
                        <small>Allow search engines to index your site</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="toggle-switch">
                            <input type="checkbox" name="robots_follow"
                                   {{ ($seo['robots']['follow'] ?? true) ? 'checked' : '' }}>
                            <span>Allow Link Following</span>
                        </label>
                        <small>Allow search engines to follow links on your site</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-check-circle"></i>
                <h3>Site Verification</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fab fa-google me-2"></i>Google Verification Code</label>
                        <input type="text" name="google_verification" class="form-control-custom"
                               value="{{ $seo['verification']['google'] ?? '' }}"
                               placeholder="google-site-verification=xxxxx">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fab fa-microsoft me-2"></i>Bing Verification Code</label>
                        <input type="text" name="bing_verification" class="form-control-custom"
                               value="{{ $seo['verification']['bing'] ?? '' }}"
                               placeholder="msvalidate.01=xxxxx">
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-chart-line"></i>
                <h3>Analytics</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fab fa-google me-2"></i>Google Analytics ID</label>
                        <input type="text" name="google_analytics" class="form-control-custom"
                               value="{{ $seo['analytics']['google_analytics'] ?? '' }}"
                               placeholder="G-XXXXXXXXXX or UA-XXXXX-X">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><i class="fab fa-facebook me-2"></i>Facebook Pixel ID</label>
                        <input type="text" name="facebook_pixel" class="form-control-custom"
                               value="{{ $seo['analytics']['facebook_pixel'] ?? '' }}"
                               placeholder="123456789012345">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i>
                Save SEO Settings
            </button>
        </div>
    </form>
@endsection
