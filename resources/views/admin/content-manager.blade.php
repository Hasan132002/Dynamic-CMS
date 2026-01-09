@extends('admin.layouts.app')

@section('title', 'Content Manager')

@section('styles')
<style>
    /* Content Manager - Clean WordPress Style */

    /* Search and Filter Bar */
    .cm-filter-bar {
        background: var(--white);
        padding: 16px 20px;
        border-radius: 8px;
        border: 1px solid var(--border-light);
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    .cm-search-input {
        border: 1px solid var(--border-color);
        border-radius: 4px;
        padding: 10px 14px 10px 40px;
        width: 100%;
        font-size: 14px;
        background: #fafafa;
        transition: all 0.2s ease;
    }

    .cm-search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(179, 9, 9, 0.1);
        background: var(--white);
    }

    .cm-search-wrapper {
        position: relative;
    }

    .cm-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 14px;
    }

    /* Page Cards */
    .cm-page-card {
        background: var(--white);
        border-radius: 8px;
        border: 1px solid var(--border-light);
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        transition: box-shadow 0.2s ease;
    }

    .cm-page-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .cm-page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cm-page-title {
        font-size: 16px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cm-page-title i {
        opacity: 0.9;
    }

    .cm-page-slug {
        font-size: 12px;
        opacity: 0.8;
        margin-top: 4px;
        font-weight: 400;
    }

    .cm-page-stats {
        display: flex;
        gap: 20px;
        font-size: 13px;
    }

    .cm-stat-item {
        display: flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.15);
        padding: 6px 12px;
        border-radius: 4px;
    }

    .cm-page-body {
        padding: 0;
    }

    /* Section Item */
    .cm-section-item {
        border-bottom: 1px solid var(--border-light);
        transition: all 0.15s ease;
    }

    .cm-section-item:last-child {
        border-bottom: none;
    }

    .cm-section-item:hover {
        background: #fafbfc;
    }

    .cm-section-header {
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        gap: 15px;
    }

    .cm-section-info {
        display: flex;
        align-items: center;
        gap: 14px;
        flex: 1;
        min-width: 0;
    }

    .cm-section-icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        background: linear-gradient(135deg, #f0f2f5 0%, #e8eaed 100%);
        border: 1px solid var(--border-light);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 16px;
        flex-shrink: 0;
    }

    .cm-section-details {
        min-width: 0;
        flex: 1;
    }

    .cm-section-details h4 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: var(--heading-color);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .cm-section-meta {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .cm-section-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .cm-section-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }

    /* Toggle Switch */
    .cm-toggle {
        position: relative;
        width: 48px;
        height: 24px;
        display: inline-block;
    }

    .cm-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .cm-toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccd0d4;
        transition: 0.25s;
        border-radius: 24px;
    }

    .cm-toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.25s;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    .cm-toggle input:checked + .cm-toggle-slider {
        background-color: var(--success-color);
    }

    .cm-toggle input:checked + .cm-toggle-slider:before {
        transform: translateX(24px);
    }

    /* Status Badge */
    .cm-status-badge {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .cm-status-badge.active {
        background: #e6f7e9;
        color: #1e7e34;
    }

    .cm-status-badge.inactive {
        background: #fef0f0;
        color: #c92a2a;
    }

    .cm-status-badge i {
        font-size: 10px;
    }

    /* Section Content (Expandable) */
    .cm-section-content {
        padding: 0 20px 20px 76px;
        display: none;
        background: #f9fafb;
        border-top: 1px solid var(--border-light);
    }

    .cm-section-content.show {
        display: block;
    }

    .cm-section-content-inner {
        padding-top: 16px;
    }

    .cm-content-title {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-light);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Image Gallery */
    .cm-image-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
        gap: 12px;
    }

    .cm-gallery-item {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        border: 2px solid transparent;
        aspect-ratio: 1;
        background: var(--white);
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        transition: all 0.2s ease;
    }

    .cm-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cm-gallery-item:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .cm-gallery-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 20px 6px 6px;
        font-size: 10px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Expand Button */
    .cm-expand-btn {
        background: #f0f2f5;
        border: 1px solid var(--border-light);
        color: var(--text-light);
        font-size: 12px;
        cursor: pointer;
        padding: 8px;
        border-radius: 6px;
        transition: all 0.2s;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cm-expand-btn:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .cm-expand-btn.expanded {
        transform: rotate(180deg);
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    /* Filter Chips */
    .cm-filter-chip {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        background: var(--white);
        border: 1px solid var(--border-color);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 13px;
        font-weight: 500;
        color: var(--text-color);
    }

    .cm-filter-chip:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        background: #fff5f5;
    }

    .cm-filter-chip.active {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: white;
    }

    .cm-filter-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }

    .cm-filter-label {
        font-size: 13px;
        color: var(--text-light);
        margin-right: 4px;
    }

    /* Empty State */
    .cm-empty-state {
        text-align: center;
        padding: 80px 20px;
        color: var(--text-light);
        background: var(--white);
        border-radius: 8px;
        border: 1px solid var(--border-light);
    }

    .cm-empty-state i {
        font-size: 64px;
        margin-bottom: 20px;
        color: #ddd;
    }

    .cm-empty-state h3 {
        font-size: 18px;
        color: var(--heading-color);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .cm-empty-state p {
        margin: 0;
        color: var(--text-light);
    }

    /* No images state */
    .cm-no-images {
        text-align: center;
        padding: 30px;
        color: var(--text-light);
        background: var(--white);
        border-radius: 6px;
        border: 1px dashed var(--border-color);
    }

    .cm-no-images i {
        font-size: 32px;
        color: #ddd;
        margin-bottom: 10px;
    }

    /* More images indicator */
    .cm-more-images {
        text-align: center;
        padding: 12px;
        background: var(--white);
        border-radius: 6px;
        font-size: 12px;
        color: var(--text-light);
        margin-top: 12px;
        border: 1px solid var(--border-light);
    }
</style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <h1><i class="fas fa-layer-group"></i>Content Manager</h1>
        <p>Manage page sections and content visibility</p>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="alert alert-custom alert-success" style="display: none;">
        <i class="fas fa-check-circle me-2"></i><span id="successText"></span>
    </div>

    <!-- Filter Bar -->
    <div class="cm-filter-bar">
        <div class="row align-items-center g-3">
            <div class="col-lg-5">
                <div class="cm-search-wrapper">
                    <i class="fas fa-search cm-search-icon"></i>
                    <input type="text" id="searchInput" class="cm-search-input" placeholder="Search pages or sections...">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="cm-filter-group justify-content-lg-end">
                    <span class="cm-filter-label">Filter:</span>
                    <span class="cm-filter-chip active" data-filter="all">All Pages</span>
                    <span class="cm-filter-chip" data-filter="home">Home</span>
                    <span class="cm-filter-chip" data-filter="course">Courses</span>
                    <span class="cm-filter-chip" data-filter="about">About</span>
                    <span class="cm-filter-chip" data-filter="blog">Blog</span>
                    <span class="cm-filter-chip" data-filter="contact">Contact</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pages Content -->
    <div id="pagesContainer">
        @forelse($pages as $pageSlug => $page)
        @php
            $pageType = 'other';
            if (strpos($pageSlug, '/') !== false) {
                $pageType = explode('/', $pageSlug)[0];
                if ($pageType === 'courses') $pageType = 'course';
                if ($pageType === 'blogs') $pageType = 'blog';
            } elseif (strpos($pageSlug, 'home') !== false) {
                $pageType = 'home';
            } else {
                $pageType = explode('-', $pageSlug)[0];
            }
        @endphp
        <div class="cm-page-card" data-page="{{ $pageSlug }}" data-page-slug="{{ Str::slug($pageSlug) }}" data-page-type="{{ $pageType }}">
            <div class="cm-page-header">
                <div>
                    <h2 class="cm-page-title">
                        <i class="fas fa-file-alt"></i>{{ $page['title'] }}
                    </h2>
                    <div class="cm-page-slug">{{ $pageSlug }}</div>
                </div>
                <div class="cm-page-stats">
                    <div class="cm-stat-item">
                        <i class="fas fa-layer-group"></i>
                        <span>{{ count($page['sections']) }} Sections</span>
                    </div>
                    <div class="cm-stat-item">
                        <i class="fas fa-eye"></i>
                        <span id="visible-count-{{ Str::slug($pageSlug) }}">
                            {{ collect($page['sections'])->filter(function($section) {
                                return ($section['visible'] ?? true) == true;
                            })->count() }} Visible
                        </span>
                    </div>
                </div>
            </div>

            <div class="cm-page-body">
                @foreach($page['sections'] as $sectionKey => $section)
                <div class="cm-section-item" data-section="{{ $sectionKey }}">
                    <div class="cm-section-header" onclick="toggleSection(this)">
                        <div class="cm-section-info">
                            <div class="cm-section-icon">
                                <i class="fas fa-puzzle-piece"></i>
                            </div>
                            <div class="cm-section-details">
                                <h4>{{ ucfirst(str_replace('_', ' ', $sectionKey)) }}</h4>
                                <div class="cm-section-meta">
                                    @php
                                        $images = [];
                                        $sectionData = isset($section['data']) ? $section['data'] : $section;
                                        array_walk_recursive($sectionData, function($value, $key) use (&$images) {
                                            if (is_string($value) && (
                                                strpos($value, '.jpg') !== false ||
                                                strpos($value, '.png') !== false ||
                                                strpos($value, '.svg') !== false ||
                                                strpos($value, '.gif') !== false ||
                                                strpos($value, '.webp') !== false ||
                                                strpos($value, 'assets/img') !== false ||
                                                (strpos($key, 'image') !== false && strpos($value, 'http') === false) ||
                                                (strpos($key, 'icon') !== false && strpos($value, 'http') === false)
                                            )) {
                                                if (!in_array($value, $images)) {
                                                    $images[] = $value;
                                                }
                                            }
                                        });
                                    @endphp
                                    <span class="cm-section-meta-item">
                                        <i class="fas fa-image"></i> {{ count($images) }} images
                                    </span>
                                    <span class="cm-status-badge {{ ($section['visible'] ?? true) ? 'active' : 'inactive' }}">
                                        <i class="fas fa-{{ ($section['visible'] ?? true) ? 'eye' : 'eye-slash' }}"></i>
                                        {{ ($section['visible'] ?? true) ? 'Visible' : 'Hidden' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="cm-section-actions">
                            <label class="cm-toggle" onclick="event.stopPropagation()">
                                <input type="checkbox"
                                       class="section-toggle"
                                       data-page="{{ $pageSlug }}"
                                       data-section="{{ $sectionKey }}"
                                       {{ ($section['visible'] ?? true) ? 'checked' : '' }}
                                       onchange="updateSectionVisibility(this)">
                                <span class="cm-toggle-slider"></span>
                            </label>
                            <button class="cm-expand-btn" onclick="event.stopPropagation(); toggleSection(this.closest('.cm-section-header'))">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                    </div>

                    <div class="cm-section-content">
                        <div class="cm-section-content-inner">
                            @if(count($images) > 0)
                            <div class="cm-content-title">
                                <i class="fas fa-images"></i> Section Images
                            </div>
                            <div class="cm-image-gallery">
                                @foreach(array_slice($images, 0, 12) as $index => $image)
                                <div class="cm-gallery-item">
                                    <img src="/{{ $image }}" alt="Section Image {{ $index + 1 }}"
                                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22120%22 height=%22120%22%3E%3Crect width=%22120%22 height=%22120%22 fill=%22%23f0f0f0%22/%3E%3Ctext x=%2250%%22 y=%2250%%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22 font-size=%2212%22%3ENo Image%3C/text%3E%3C/svg%3E'">
                                    <div class="cm-gallery-label">{{ basename($image) }}</div>
                                </div>
                                @endforeach
                            </div>
                            @if(count($images) > 12)
                            <div class="cm-more-images">
                                <i class="fas fa-info-circle me-1"></i> Showing first 12 of {{ count($images) }} images
                            </div>
                            @endif
                            @else
                            <div class="cm-no-images">
                                <i class="fas fa-image"></i>
                                <p class="mb-0">No images in this section</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="cm-empty-state">
            <i class="fas fa-folder-open"></i>
            <h3>No Pages Found</h3>
            <p>No page content files were found in the storage directory.</p>
        </div>
        @endforelse
    </div>
@endsection

@section('scripts')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function toggleSection(header) {
        const content = header.closest('.cm-section-item').querySelector('.cm-section-content');
        const expandBtn = header.querySelector('.cm-expand-btn');
        content.classList.toggle('show');
        expandBtn.classList.toggle('expanded');
    }

    async function updateSectionVisibility(checkbox) {
        const page = checkbox.dataset.page;
        const section = checkbox.dataset.section;
        const visible = checkbox.checked;

        try {
            const response = await fetch('/admin/content-manager/update-visibility', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ page, section, visible })
            });

            const data = await response.json();

            if (data.success) {
                const sectionItem = checkbox.closest('.cm-section-item');
                const statusBadge = sectionItem.querySelector('.cm-status-badge');

                if (visible) {
                    statusBadge.classList.remove('inactive');
                    statusBadge.classList.add('active');
                    statusBadge.innerHTML = '<i class="fas fa-eye"></i> Visible';
                } else {
                    statusBadge.classList.remove('active');
                    statusBadge.classList.add('inactive');
                    statusBadge.innerHTML = '<i class="fas fa-eye-slash"></i> Hidden';
                }

                updateVisibleCount(page);
                showSuccess(`Section ${visible ? 'shown' : 'hidden'} successfully`);
            } else {
                checkbox.checked = !visible;
                alert('Failed to update section visibility');
            }
        } catch (error) {
            console.error('Error:', error);
            checkbox.checked = !visible;
            alert('An error occurred while updating section visibility');
        }
    }

    function updateVisibleCount(page) {
        const pageCard = document.querySelector(`.cm-page-card[data-page="${page}"]`);
        if (!pageCard) return;
        const toggles = pageCard.querySelectorAll('.section-toggle:checked');
        const pageSlug = pageCard.dataset.pageSlug;
        const countElement = document.getElementById(`visible-count-${pageSlug}`);
        if (countElement) {
            countElement.textContent = `${toggles.length} Visible`;
        }
    }

    function showSuccess(message) {
        const successDiv = document.getElementById('successMessage');
        const successText = document.getElementById('successText');
        if (successDiv && successText) {
            successText.textContent = message;
            successDiv.style.display = 'flex';
            setTimeout(() => {
                successDiv.style.display = 'none';
            }, 3000);
        }
    }

    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const pageCards = document.querySelectorAll('.cm-page-card');

        pageCards.forEach(card => {
            const pageTitle = card.querySelector('.cm-page-title').textContent.toLowerCase();
            const sections = card.querySelectorAll('.cm-section-item');
            let hasVisibleSection = false;

            sections.forEach(section => {
                const sectionTitle = section.querySelector('.cm-section-details h4').textContent.toLowerCase();
                if (sectionTitle.includes(searchTerm) || pageTitle.includes(searchTerm)) {
                    section.style.display = '';
                    hasVisibleSection = true;
                } else {
                    section.style.display = 'none';
                }
            });

            card.style.display = hasVisibleSection || pageTitle.includes(searchTerm) ? '' : 'none';
        });
    });

    document.querySelectorAll('.cm-filter-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            document.querySelectorAll('.cm-filter-chip').forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            const filterType = this.dataset.filter;
            const pageCards = document.querySelectorAll('.cm-page-card');

            pageCards.forEach(card => {
                if (filterType === 'all' || card.dataset.pageType === filterType) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
