@extends('admin.layouts.app')

@section('title', 'Appearance Settings')

@section('styles')
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;600;700&family=Open+Sans:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .tabs-container {
        background: white;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .nav-tabs {
        border-bottom: 2px solid var(--border-color);
        padding: 0 2rem;
        background: #fafbfc;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #555555;
        padding: 1.25rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
        background: transparent;
    }

    .nav-tabs .nav-link.active {
        color: var(--primary-color);
        background: white;
        border-bottom: 3px solid var(--primary-color);
    }

    .nav-tabs .nav-link i {
        margin-right: 0.5rem;
    }

    .tab-content {
        padding: 2.5rem;
    }

    .form-section {
        background: #fafbfc;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.75rem;
        margin-bottom: 1.5rem;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
    }

    .form-label {
        font-weight: 500;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(122, 2, 2, 0.15);
    }

    .color-picker-wrapper {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .color-preview {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        border: 2px solid var(--border-color);
        cursor: pointer;
        transition: transform 0.2s;
    }

    .color-preview:hover {
        transform: scale(1.05);
    }

    input[type="color"] {
        opacity: 0;
        position: absolute;
        pointer-events: none;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(122, 2, 2, 0.25);
    }

    .help-text {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 0.35rem;
    }

    .logo-preview {
        max-width: 200px;
        max-height: 80px;
        margin-top: 0.75rem;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 0.5rem;
        background: white;
    }

    .row {
        margin-bottom: 1.25rem;
    }

    .row:last-child {
        margin-bottom: 0;
    }

    /* Font Preview Styles */
    .font-preview {
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 1rem;
        transition: all 0.3s ease;
    }

    .font-preview:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 12px rgba(122, 2, 2, 0.15);
    }

    .font-preview-heading {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--secondary-color);
    }

    .font-preview-body {
        font-size: 1rem;
        color: #555555;
        line-height: 1.6;
    }

    /* Color Grid */
    .color-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .color-item {
        text-align: center;
    }

    .color-box {
        width: 100%;
        height: 80px;
        border-radius: 8px;
        border: 2px solid var(--border-color);
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
    }

    .color-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .color-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--secondary-color);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .color-value {
        font-size: 0.7rem;
        color: #6c757d;
        font-family: 'Courier New', monospace;
    }

    /* Image Upload Area */
    .image-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafbfc;
    }

    .image-upload-area:hover {
        border-color: var(--primary-color);
        background: white;
    }

    .image-upload-area i {
        font-size: 2.5rem;
        color: var(--border-color);
        margin-bottom: 1rem;
        display: block;
    }

    .image-upload-area:hover i {
        color: var(--primary-color);
    }

    .current-logo-preview {
        max-width: 250px;
        max-height: 100px;
        object-fit: contain;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 1rem;
        background: white;
        display: block;
        margin: 1rem auto;
    }

    /* Social Links */
    .social-link-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        margin-bottom: 0.75rem;
    }

    .social-icon-preview {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    /* Campus Cards */
    .campus-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .campus-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border-color: var(--primary-color);
    }

    .campus-card h5 {
        color: var(--secondary-color);
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
    }

    /* Badge */
    .info-badge {
        display: inline-block;
        background: #e7f3ff;
        color: #004085;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .info-badge i {
        margin-right: 0.35rem;
    }

    /* Accordion Style for Sections */
    .accordion-section {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .accordion-header {
        background: #fafbfc;
        padding: 1rem 1.5rem;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
    }

    .accordion-header:hover {
        background: #f0f1f3;
    }

    .accordion-header h4 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .accordion-body {
        padding: 1.5rem;
        display: none;
    }

    .accordion-body.active {
        display: block;
    }

    /* Icon Grid */
    .icon-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .icon-item {
        text-align: center;
        padding: 1rem;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .icon-item:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .icon-item img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        margin-bottom: 0.5rem;
    }

    .icon-item p {
        font-size: 0.7rem;
        margin: 0;
        color: #6c757d;
        word-break: break-word;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-paint-brush me-3"></i>Appearance Settings</h1>
        <p>Customize your website's look and feel</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <!-- Tabs Container -->
    <div class="tabs-container">
        <ul class="nav nav-tabs" id="appearanceTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors" type="button">
                    <i class="fas fa-palette"></i>Colors
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="fonts-tab" data-bs-toggle="tab" data-bs-target="#fonts" type="button">
                    <i class="fas fa-font"></i>Fonts
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="logos-tab" data-bs-toggle="tab" data-bs-target="#logos" type="button">
                    <i class="fas fa-image"></i>Logos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="text-tab" data-bs-toggle="tab" data-bs-target="#text" type="button">
                    <i class="fas fa-align-left"></i>Text & Contact
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button">
                    <i class="fas fa-images"></i>Images & Icons
                </button>
            </li>
        </ul>

        <div class="tab-content" id="appearanceTabContent">

            <!-- COLORS TAB -->
            <div class="tab-pane fade show active" id="colors" role="tabpanel">
                <form method="POST" action="/admin/appearance">
                    @csrf
                    <input type="hidden" name="section" value="colors">

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-palette me-2"></i>Brand Colors</h3>
                        <p class="info-badge"><i class="fas fa-info-circle"></i>These colors define your brand identity across the website</p>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Accent Color</label>
                                    <div class="color-picker-wrapper">
                                        <div class="color-preview" style="background-color: {{ $data['colors']['base']['accent'] ?? '#c20000' }}"
                                             onclick="document.getElementById('accent-color').click()"></div>
                                        <input type="color" id="accent-color" name="accent" value="{{ $data['colors']['base']['accent'] ?? '#c20000' }}"
                                               onchange="this.previousElementSibling.style.backgroundColor = this.value">
                                        <input type="text" class="form-control" id="accent-text" value="{{ $data['colors']['base']['accent'] ?? '#c20000' }}"
                                               oninput="document.getElementById('accent-color').value = this.value; document.querySelector('#accent-color').previousElementSibling.style.backgroundColor = this.value; document.getElementById('accent-color').name = 'accent';">
                                    </div>
                                    <small class="help-text">Primary brand color (buttons, links, highlights)</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Heading Color</label>
                                    <div class="color-picker-wrapper">
                                        <div class="color-preview" style="background-color: {{ $data['colors']['base']['heading'] ?? '#00001b' }}"
                                             onclick="document.getElementById('heading-color').click()"></div>
                                        <input type="color" id="heading-color" name="heading" value="{{ $data['colors']['base']['heading'] ?? '#00001b' }}"
                                               onchange="this.previousElementSibling.style.backgroundColor = this.value">
                                        <input type="text" class="form-control" id="heading-text" value="{{ $data['colors']['base']['heading'] ?? '#00001b' }}"
                                               oninput="document.getElementById('heading-color').value = this.value; document.querySelector('#heading-color').previousElementSibling.style.backgroundColor = this.value; document.getElementById('heading-color').name = 'heading';">
                                    </div>
                                    <small class="help-text">Color for all headings (H1-H6)</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Body Text Color</label>
                                    <div class="color-picker-wrapper">
                                        <div class="color-preview" style="background-color: {{ $data['colors']['base']['body'] ?? '#555555' }}"
                                             onclick="document.getElementById('body-color').click()"></div>
                                        <input type="color" id="body-color" name="body" value="{{ $data['colors']['base']['body'] ?? '#555555' }}"
                                               onchange="this.previousElementSibling.style.backgroundColor = this.value">
                                        <input type="text" class="form-control" id="body-text" value="{{ $data['colors']['base']['body'] ?? '#555555' }}"
                                               oninput="document.getElementById('body-color').value = this.value; document.querySelector('#body-color').previousElementSibling.style.backgroundColor = this.value; document.getElementById('body-color').name = 'body';">
                                    </div>
                                    <small class="help-text">Color for paragraph text</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-swatchbook me-2"></i>Extended Color Palette</h3>
                        <p class="text-muted mb-3">View all colors from your theme. These are automatically managed through global-colors.json</p>

                        <div class="color-grid">
                            @if(isset($data['colors']['base']))
                                @foreach($data['colors']['base'] as $key => $color)
                                    @if($key != 'accent' && $key != 'heading' && $key != 'body')
                                    <div class="color-item">
                                        <div class="color-box" style="background-color: {{ $color }}"></div>
                                        <div class="color-label">{{ str_replace('_', ' ', $key) }}</div>
                                        <div class="color-value">{{ $color }}</div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Color Settings
                        </button>
                    </div>
                </form>
            </div>

            <!-- FONTS TAB -->
            <div class="tab-pane fade" id="fonts" role="tabpanel">
                <form method="POST" action="/admin/appearance" id="fontForm">
                    @csrf
                    <input type="hidden" name="section" value="fonts">

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-font me-2"></i>Typography Settings</h3>
                        <p class="info-badge"><i class="fas fa-info-circle"></i>Choose fonts that represent your brand personality</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Primary Font (Headings)</label>
                                    <select name="primary_font" id="primaryFont" class="form-select" onchange="updateFontPreview()">
                                        <option value="Fredoka" {{ (($data['fonts']['default']['primary'] ?? 'Fredoka') == 'Fredoka') ? 'selected' : '' }}>Fredoka</option>
                                        <option value="Poppins" {{ (($data['fonts']['default']['primary'] ?? '') == 'Poppins') ? 'selected' : '' }}>Poppins</option>
                                        <option value="Euclid Circular A" {{ (($data['fonts']['default']['primary'] ?? '') == 'Euclid Circular A') ? 'selected' : '' }}>Euclid Circular A</option>
                                        <option value="Adobe Garamond Pro" {{ (($data['fonts']['default']['primary'] ?? '') == 'Adobe Garamond Pro') ? 'selected' : '' }}>Adobe Garamond Pro</option>
                                        <option value="Roboto" {{ (($data['fonts']['default']['primary'] ?? '') == 'Roboto') ? 'selected' : '' }}>Roboto</option>
                                        <option value="Open Sans" {{ (($data['fonts']['default']['primary'] ?? '') == 'Open Sans') ? 'selected' : '' }}>Open Sans</option>
                                        <option value="Montserrat" {{ (($data['fonts']['default']['primary'] ?? '') == 'Montserrat') ? 'selected' : '' }}>Montserrat</option>
                                        <option value="Inter" {{ (($data['fonts']['default']['primary'] ?? '') == 'Inter') ? 'selected' : '' }}>Inter</option>
                                    </select>
                                    <small class="help-text">Used for headings and important text</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Secondary Font (Body Text)</label>
                                    <select name="secondary_font" id="secondaryFont" class="form-select" onchange="updateFontPreview()">
                                        <option value="Poppins" {{ (($data['fonts']['default']['secondary'] ?? 'Poppins') == 'Poppins') ? 'selected' : '' }}>Poppins</option>
                                        <option value="Fredoka" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Fredoka') ? 'selected' : '' }}>Fredoka</option>
                                        <option value="Euclid Circular A" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Euclid Circular A') ? 'selected' : '' }}>Euclid Circular A</option>
                                        <option value="Adobe Garamond Pro" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Adobe Garamond Pro') ? 'selected' : '' }}>Adobe Garamond Pro</option>
                                        <option value="Roboto" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Roboto') ? 'selected' : '' }}>Roboto</option>
                                        <option value="Open Sans" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Open Sans') ? 'selected' : '' }}>Open Sans</option>
                                        <option value="Montserrat" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Montserrat') ? 'selected' : '' }}>Montserrat</option>
                                        <option value="Inter" {{ (($data['fonts']['default']['secondary'] ?? '') == 'Inter') ? 'selected' : '' }}>Inter</option>
                                    </select>
                                    <small class="help-text">Used for body text and paragraphs</small>
                                </div>
                            </div>
                        </div>

                        <!-- Font Preview -->
                        <div class="font-preview">
                            <div class="font-preview-heading" id="headingPreview" style="font-family: {{ $data['fonts']['default']['primary'] ?? 'Fredoka' }}, sans-serif;">
                                Transform Your Learning Experience
                            </div>
                            <div class="font-preview-body" id="bodyPreview" style="font-family: {{ $data['fonts']['default']['secondary'] ?? 'Poppins' }}, sans-serif;">
                                Discover world-class education with our comprehensive courses designed by industry experts. Join thousands of students who are already transforming their careers through quality online learning.
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-text-height me-2"></i>Font Specifications</h3>
                        <p class="text-muted mb-3">Current font settings from global-fonts.json</p>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Font Weights</label>
                                    <div class="p-3 bg-white border rounded">
                                        @if(isset($data['fonts']['weights']))
                                            @foreach($data['fonts']['weights'] as $name => $weight)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-capitalize">{{ $name }}:</span>
                                                    <strong>{{ $weight }}</strong>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Font Sizes</label>
                                    <div class="p-3 bg-white border rounded" style="max-height: 200px; overflow-y: auto;">
                                        @if(isset($data['fonts']['sizes']))
                                            @foreach(array_slice($data['fonts']['sizes'], 0, 8) as $name => $size)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-capitalize">{{ $name }}:</span>
                                                    <strong>{{ $size }}</strong>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Line Heights</label>
                                    <div class="p-3 bg-white border rounded">
                                        @if(isset($data['fonts']['line_heights']))
                                            @foreach($data['fonts']['line_heights'] as $name => $height)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-capitalize">{{ $name }}:</span>
                                                    <strong>{{ $height }}</strong>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Font Settings
                        </button>
                    </div>
                </form>
            </div>

            <!-- LOGOS TAB -->
            <div class="tab-pane fade" id="logos" role="tabpanel">
                <form method="POST" action="/admin/appearance">
                    @csrf
                    <input type="hidden" name="section" value="logos">

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-image me-2"></i>Header Logo</h3>
                        <p class="info-badge"><i class="fas fa-info-circle"></i>Logo displayed in the website header and navigation</p>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Logo Path</label>
                                    <input type="text" name="header_logo" id="headerLogoPath" class="form-control"
                                           value="{{ $data['logos']['header']['default'] ?? 'assets/img/logo_v6.svg' }}"
                                           placeholder="assets/img/logo.svg"
                                           oninput="updateLogoPreview('headerLogoPath', 'headerLogoPreview')">
                                    <small class="help-text">Relative path from public folder (e.g., assets/img/logo.svg)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Preview</label>
                                <img src="/{{ $data['logos']['header']['default'] ?? 'assets/img/logo_v6.svg' }}"
                                     alt="Header Logo" class="current-logo-preview" id="headerLogoPreview"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%2280%22%3E%3Crect width=%22200%22 height=%2280%22 fill=%22%23f0f0f0%22/%3E%3Ctext x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3ENo Image%3C/text%3E%3C/svg%3E'">
                            </div>
                        </div>

                        <div class="mt-3">
                            <h6 class="mb-2 text-secondary">Available Logo Variants:</h6>
                            <div class="d-flex flex-wrap gap-3">
                                @if(isset($data['logos']['header']))
                                    @foreach($data['logos']['header'] as $key => $path)
                                        @if(!empty($path))
                                        <div class="p-2 border rounded text-center" style="cursor: pointer;"
                                             onclick="document.getElementById('headerLogoPath').value='{{ $path }}'; document.getElementById('headerLogoPreview').src='/{{ $path }}';">
                                            <img src="/{{ $path }}" alt="{{ $key }}" style="max-width: 100px; max-height: 40px; object-fit: contain;">
                                            <small class="d-block mt-1 text-muted">{{ $key }}</small>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-image me-2"></i>Footer Logo</h3>
                        <p class="info-badge"><i class="fas fa-info-circle"></i>Logo displayed in the website footer</p>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label">Logo Path</label>
                                    <input type="text" name="footer_logo" id="footerLogoPath" class="form-control"
                                           value="{{ $data['logos']['footer']['default'] ?? 'assets/img/footer_logo.svg' }}"
                                           placeholder="assets/img/footer_logo.svg"
                                           oninput="updateLogoPreview('footerLogoPath', 'footerLogoPreview')">
                                    <small class="help-text">Relative path from public folder (e.g., assets/img/footer_logo.svg)</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Preview</label>
                                <img src="/{{ $data['logos']['footer']['default'] ?? 'assets/img/footer_logo.svg' }}"
                                     alt="Footer Logo" class="current-logo-preview" id="footerLogoPreview"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%2280%22%3E%3Crect width=%22200%22 height=%2280%22 fill=%22%23f0f0f0%22/%3E%3Ctext x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3ENo Image%3C/text%3E%3C/svg%3E'">
                            </div>
                        </div>

                        <div class="mt-3">
                            <h6 class="mb-2 text-secondary">Available Logo Variants:</h6>
                            <div class="d-flex flex-wrap gap-3">
                                @if(isset($data['logos']['footer']))
                                    @foreach($data['logos']['footer'] as $key => $path)
                                        @if(!empty($path))
                                        <div class="p-2 border rounded text-center" style="cursor: pointer;"
                                             onclick="document.getElementById('footerLogoPath').value='{{ $path }}'; document.getElementById('footerLogoPreview').src='/{{ $path }}';">
                                            <img src="/{{ $path }}" alt="{{ $key }}" style="max-width: 100px; max-height: 40px; object-fit: contain;">
                                            <small class="d-block mt-1 text-muted">{{ $key }}</small>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Logo Settings
                        </button>
                    </div>
                </form>
            </div>

            <!-- TEXT & CONTACT TAB -->
            <div class="tab-pane fade" id="text" role="tabpanel">
                <form method="POST" action="/admin/appearance">
                    @csrf
                    <input type="hidden" name="section" value="text">

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-phone me-2"></i>Contact Information</h3>
                        <p class="info-badge"><i class="fas fa-info-circle"></i>Primary contact details displayed across the website</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-phone me-1"></i> Primary Phone</label>
                                    <input type="text" name="phone_primary" class="form-control"
                                           value="{{ $data['text']['contact']['phone']['primary'] ?? '' }}"
                                           placeholder="+23 (000) 68 603" required>
                                    <small class="help-text">Displayed in header and contact sections</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-phone me-1"></i> Secondary Phone</label>
                                    <input type="text" name="phone_secondary" class="form-control"
                                           value="{{ $data['text']['contact']['phone']['secondary'] ?? '' }}"
                                           placeholder="990 66789 7682">
                                    <small class="help-text">Alternative contact number</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-envelope me-1"></i> Primary Email</label>
                                    <input type="email" name="email_primary" class="form-control"
                                           value="{{ $data['text']['contact']['email']['primary'] ?? '' }}"
                                           placeholder="info@educve.com" required>
                                    <small class="help-text">Main contact email address</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-envelope me-1"></i> Support Email</label>
                                    <input type="email" name="email_support" class="form-control"
                                           value="{{ $data['text']['contact']['email']['support'] ?? '' }}"
                                           placeholder="support@educve.com">
                                    <small class="help-text">Support and inquiry email</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Primary Address</label>
                            <textarea name="address_primary" class="form-control" rows="2" required>{{ $data['text']['contact']['address']['primary'] ?? '' }}</textarea>
                            <small class="help-text">Main office address</small>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-share-alt me-2"></i>Social Media Links</h3>
                        <p class="text-muted mb-3">Social media links are managed in global-text.json under contact.socials</p>

                        <div class="row">
                            @if(isset($data['text']['contact']['socials']))
                                @foreach(array_slice($data['text']['contact']['socials'], 0, 6) as $index => $social)
                                <div class="col-md-6">
                                    <div class="social-link-item">
                                        <div class="social-icon-preview">
                                            <i class="{{ $social['icon'] ?? 'fa-brands fa-link' }}"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <small class="text-muted d-block">{{ $social['icon'] ?? 'Social Link' }}</small>
                                            <strong class="text-truncate d-block" style="max-width: 250px;">{{ $social['url'] ?? '#' }}</strong>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-mouse-pointer me-2"></i>Header CTA Button</h3>
                        <p class="info-badge"><i class="fas fa-info-circle"></i>Call-to-action button in website header</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Button Label</label>
                                    <input type="text" name="cta_label" class="form-control"
                                           value="{{ $data['text']['header']['cta_button']['label'] ?? 'Apply Now' }}" required>
                                    <small class="help-text">Text shown on the button</small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Button URL</label>
                                    <input type="text" name="cta_url" class="form-control"
                                           value="{{ $data['text']['header']['cta_button']['url'] ?? '/students-registrations' }}" required>
                                    <small class="help-text">Link destination when clicked</small>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Preview -->
                        <div class="mt-3 text-center p-3 bg-light border rounded">
                            <p class="text-muted mb-2">Preview:</p>
                            <a href="#" class="btn btn-primary" style="background: var(--primary-color); border: none;">
                                {{ $data['text']['header']['cta_button']['label'] ?? 'Apply Now' }}
                            </a>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-info-circle me-2"></i>Footer Content</h3>

                        <div class="mb-3">
                            <label class="form-label">About Text</label>
                            <textarea name="footer_about_text" class="form-control" rows="3" required>{{ $data['text']['footer']['about']['text'] ?? '' }}</textarea>
                            <small class="help-text">Short description shown in footer about section</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subscribe Title</label>
                            <input type="text" name="footer_subscribe_title" class="form-control"
                                   value="{{ $data['text']['footer']['subscribe']['title'] ?? 'Subscribe Now' }}">
                            <small class="help-text">Newsletter subscription section title</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Copyright Text</label>
                            <input type="text" name="footer_copyright" class="form-control"
                                   value="{{ $data['text']['footer']['bottom']['copyright'] ?? '' }}" required>
                            <small class="help-text">Copyright notice at bottom of page</small>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="form-section-title"><i class="fas fa-building me-2"></i>Campus Locations</h3>
                        <p class="text-muted mb-3">Multiple campus locations from global-text.json</p>

                        @if(isset($data['text']['contact']['campuses']))
                            @foreach($data['text']['contact']['campuses'] as $campus)
                            <div class="campus-card">
                                <h5><i class="fas fa-map-marker-alt me-2"></i>{{ $campus['name'] ?? 'Campus' }}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-2"><strong>Address:</strong><br>{{ $campus['address'] ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-2"><strong>Phone:</strong><br>{{ $campus['phone'] ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="mb-2"><strong>Email:</strong><br>{{ $campus['email'] ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Text & Contact Settings
                        </button>
                    </div>
                </form>
            </div>

            <!-- IMAGES & ICONS TAB -->
            <div class="tab-pane fade" id="images" role="tabpanel">
                <div class="form-section">
                    <h3 class="form-section-title"><i class="fas fa-images me-2"></i>Image Management</h3>
                    <p class="info-badge"><i class="fas fa-info-circle"></i>All images are managed through global-images.json file</p>

                    <div class="alert alert-info">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Note:</strong> Images are organized hierarchically by page and component. To modify images, edit the global-images.json file directly or use the file path inputs throughout the admin panel.
                    </div>

                    <!-- Common Icons Section -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <h4><i class="fas fa-icons me-2"></i>Common Icons</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-body">
                            <p class="text-muted">Icons used across multiple pages</p>
                            <div class="icon-grid">
                                @if(isset($data['global_images']['icons']['common']))
                                    @foreach($data['global_images']['icons']['common'] as $name => $path)
                                    <div class="icon-item">
                                        <img src="/{{ $path }}" alt="{{ $name }}"
                                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22%3E%3Crect width=%2240%22 height=%2240%22 fill=%22%23f0f0f0%22/%3E%3Ctext x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22 font-size=%2210%22%3E?%3C/text%3E%3C/svg%3E'">
                                        <p>{{ str_replace('_', ' ', $name) }}</p>
                                        <small class="text-muted d-block" style="font-size: 0.6rem; word-break: break-all;">{{ $path }}</small>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Avatars Section -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <h4><i class="fas fa-user-circle me-2"></i>Avatars & Profile Images</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-body">
                            <p class="text-muted">User avatars and profile images</p>
                            <div class="icon-grid">
                                @if(isset($data['global_images']['avatars']['common']))
                                    @foreach($data['global_images']['avatars']['common'] as $index => $path)
                                    <div class="icon-item">
                                        <img src="/{{ $path }}" alt="Avatar {{ $index + 1 }}" style="border-radius: 50%;"
                                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22%3E%3Ccircle cx=%2220%22 cy=%2220%22 r=%2220%22 fill=%22%23f0f0f0%22/%3E%3Ctext x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3E?%3C/text%3E%3C/svg%3E'">
                                        <p>Avatar {{ $index + 1 }}</p>
                                        <small class="text-muted d-block" style="font-size: 0.6rem; word-break: break-all;">{{ $path }}</small>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Category Images -->
                    <div class="accordion-section">
                        <div class="accordion-header" onclick="toggleAccordion(this)">
                            <h4><i class="fas fa-folder-open me-2"></i>Category & Section Images</h4>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-body">
                            <p class="text-muted">Images organized by category and section</p>

                            @php
                                $imageCategories = ['home_v1', 'home_v2', 'about', 'courses', 'blog'];
                            @endphp

                            @foreach($imageCategories as $category)
                                @if(isset($data['global_images'][$category]))
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-secondary mb-3 pb-2 border-bottom">
                                        <i class="fas fa-folder me-2"></i>{{ str_replace('_', ' ', $category) }}
                                    </h6>
                                    <div class="row">
                                        @php
                                            $categoryImages = $data['global_images'][$category];
                                            $displayCount = 0;
                                            $maxDisplay = 8;
                                        @endphp

                                        @foreach($categoryImages as $section => $images)
                                            @if(is_array($images) && $displayCount < $maxDisplay)
                                                @foreach($images as $key => $path)
                                                    @if($displayCount < $maxDisplay && !empty($path) && is_string($path))
                                                    <div class="col-md-3 mb-3">
                                                        <div class="icon-item">
                                                            <img src="/{{ $path }}" alt="{{ $section }}" style="width: 80px; height: 60px;"
                                                                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2280%22 height=%2260%22%3E%3Crect width=%2280%22 height=%2260%22 fill=%22%23f0f0f0%22/%3E%3C/svg%3E'">
                                                            <p>{{ str_replace('_', ' ', $section) }}</p>
                                                            <small class="text-muted d-block" style="font-size: 0.6rem; word-break: break-all;">{{ $path }}</small>
                                                        </div>
                                                    </div>
                                                    @php $displayCount++; @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    @if($displayCount >= $maxDisplay)
                                        <p class="text-muted text-center">
                                            <small>Showing first {{ $maxDisplay }} images. Edit global-images.json to view all.</small>
                                        </p>
                                    @endif
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- JSON File Reference -->
                    <div class="mt-4 p-3 bg-light border rounded">
                        <h6 class="mb-2"><i class="fas fa-file-code me-2"></i>JSON File Location</h6>
                        <p class="mb-1"><strong>Path:</strong> <code>storage/app/content/global-json/global-images.json</code></p>
                        <p class="mb-0 text-muted">
                            <small>To add or modify images, edit this JSON file directly and ensure image files are placed in the public directory.</small>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Font Preview Update
    function updateFontPreview() {
        const primaryFont = document.getElementById('primaryFont').value;
        const secondaryFont = document.getElementById('secondaryFont').value;

        document.getElementById('headingPreview').style.fontFamily = primaryFont + ', sans-serif';
        document.getElementById('bodyPreview').style.fontFamily = secondaryFont + ', sans-serif';
    }

    // Logo Preview Update
    function updateLogoPreview(inputId, previewId) {
        const path = document.getElementById(inputId).value;
        const preview = document.getElementById(previewId);
        preview.src = '/' + path;
    }

    // Accordion Toggle
    function toggleAccordion(header) {
        const body = header.nextElementSibling;
        const icon = header.querySelector('i.fa-chevron-down, i.fa-chevron-up');

        // Close all other accordions
        document.querySelectorAll('.accordion-body').forEach(b => {
            if (b !== body) {
                b.classList.remove('active');
            }
        });

        document.querySelectorAll('.accordion-header i.fa-chevron-up').forEach(i => {
            if (i !== icon) {
                i.classList.remove('fa-chevron-up');
                i.classList.add('fa-chevron-down');
            }
        });

        // Toggle current accordion
        body.classList.toggle('active');

        if (body.classList.contains('active')) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }

    // Auto-save indicator
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            button.disabled = true;

            // Re-enable after 3 seconds (in case of slow response)
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 3000);
        });
    });

    // Initialize tooltips if Bootstrap tooltips are available
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Smooth scroll to top on tab change
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function() {
            setTimeout(() => {
                const mainContent = document.querySelector('.admin-content');
                if (mainContent) {
                    mainContent.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }, 100);
        });
    });

    // Color input sync
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
        colorInput.addEventListener('change', function() {
            const textInput = this.parentElement.querySelector('input[type="text"]');
            if (textInput) {
                textInput.value = this.value;
            }
        });
    });

    // Success message auto-hide
    (function() {
        const appearanceAlerts = document.querySelectorAll('.tabs-container ~ .alert, .page-header ~ .alert');
        appearanceAlerts.forEach(alertEl => {
            setTimeout(() => {
                alertEl.style.opacity = '0';
                alertEl.style.transition = 'opacity 0.5s ease';
                setTimeout(() => {
                    alertEl.style.display = 'none';
                }, 500);
            }, 5000);
        });
    })();
</script>
@endsection
