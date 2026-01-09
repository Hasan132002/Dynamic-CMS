@extends('admin.layouts.app')

@section('title', 'General Settings')

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

    .social-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    @media (max-width: 768px) {
        .social-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-cog me-3"></i>General Settings</h1>
        <p>Configure your website's general settings and information</p>
    </div>

    <form action="/admin/settings" method="POST" class="settings-form">
        @csrf

        <!-- Site Information -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-globe"></i>
                <h3>Site Information</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" name="site_name" class="form-control-custom"
                               value="{{ $settings['site']['name'] ?? 'EduCVE' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Tagline</label>
                        <input type="text" name="site_tagline" class="form-control-custom"
                               value="{{ $settings['site']['tagline'] ?? '' }}"
                               placeholder="Your site's tagline or slogan">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="site_email" class="form-control-custom"
                               value="{{ $settings['site']['email'] ?? '' }}"
                               placeholder="contact@example.com">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="site_phone" class="form-control-custom"
                               value="{{ $settings['site']['phone'] ?? '' }}"
                               placeholder="+1 234 567 890">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea name="site_address" class="form-control-custom"
                          placeholder="Your business address">{{ $settings['site']['address'] ?? '' }}</textarea>
            </div>
        </div>

        <!-- Social Media -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-share-alt"></i>
                <h3>Social Media Links</h3>
            </div>

            <div class="social-grid">
                <div class="form-group">
                    <label><i class="fab fa-facebook me-2"></i>Facebook</label>
                    <input type="url" name="social_facebook" class="form-control-custom"
                           value="{{ $settings['social']['facebook'] ?? '' }}"
                           placeholder="https://facebook.com/yourpage">
                </div>
                <div class="form-group">
                    <label><i class="fab fa-twitter me-2"></i>Twitter / X</label>
                    <input type="url" name="social_twitter" class="form-control-custom"
                           value="{{ $settings['social']['twitter'] ?? '' }}"
                           placeholder="https://twitter.com/yourhandle">
                </div>
                <div class="form-group">
                    <label><i class="fab fa-instagram me-2"></i>Instagram</label>
                    <input type="url" name="social_instagram" class="form-control-custom"
                           value="{{ $settings['social']['instagram'] ?? '' }}"
                           placeholder="https://instagram.com/yourhandle">
                </div>
                <div class="form-group">
                    <label><i class="fab fa-linkedin me-2"></i>LinkedIn</label>
                    <input type="url" name="social_linkedin" class="form-control-custom"
                           value="{{ $settings['social']['linkedin'] ?? '' }}"
                           placeholder="https://linkedin.com/company/yourcompany">
                </div>
                <div class="form-group">
                    <label><i class="fab fa-youtube me-2"></i>YouTube</label>
                    <input type="url" name="social_youtube" class="form-control-custom"
                           value="{{ $settings['social']['youtube'] ?? '' }}"
                           placeholder="https://youtube.com/yourchannel">
                </div>
            </div>
        </div>

        <!-- Custom Scripts -->
        <div class="settings-section">
            <div class="section-header">
                <i class="fas fa-code"></i>
                <h3>Custom Scripts</h3>
            </div>

            <div class="form-group">
                <label>Header Scripts</label>
                <textarea name="header_scripts" class="form-control-custom" rows="5"
                          placeholder="<!-- Add custom scripts for header (e.g., Google Analytics) -->">{{ $settings['scripts']['header'] ?? '' }}</textarea>
                <small>Scripts added here will be placed before the closing &lt;/head&gt; tag</small>
            </div>

            <div class="form-group">
                <label>Footer Scripts</label>
                <textarea name="footer_scripts" class="form-control-custom" rows="5"
                          placeholder="<!-- Add custom scripts for footer -->">{{ $settings['scripts']['footer'] ?? '' }}</textarea>
                <small>Scripts added here will be placed before the closing &lt;/body&gt; tag</small>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i>
                Save Settings
            </button>
        </div>
    </form>
@endsection
