@extends('admin.layouts.app')

@section('title', 'Theme: ' . $theme['name'])

@section('styles')
<style>
    .theme-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .theme-preview-large {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        margin-bottom: 30px;
    }

    .theme-preview-large img {
        width: 100%;
        height: auto;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .info-card h5 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eee;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #666;
        font-size: 14px;
    }

    .info-value {
        font-weight: 500;
        color: #333;
    }

    .section-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .section-list li {
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section-list li i {
        color: #667eea;
        margin-right: 10px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .color-swatch {
        display: inline-block;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        margin-right: 5px;
    }

    .tag {
        display: inline-block;
        background: #e9ecef;
        color: #495057;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        margin: 2px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="theme-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2">{{ $theme['name'] }}</h1>
                <p class="mb-3 opacity-75">{{ $theme['description'] ?? 'No description available' }}</p>
                <div class="action-buttons">
                    <a href="{{ route('admin.theme-import') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Import
                    </a>
                    <form action="{{ route('admin.theme-import.sample-pages', $theme['slug']) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-file-import me-2"></i>Import Sample Pages
                        </button>
                    </form>
                    <form action="{{ route('admin.theme-import.destroy', $theme['slug']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this theme?')">
                            <i class="fas fa-trash me-2"></i>Delete Theme
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="text-white-50">Version {{ $theme['version'] ?? '1.0.0' }}</div>
                <div>by {{ $theme['author'] ?? 'Unknown' }}</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Preview -->
        <div class="col-lg-8">
            <div class="theme-preview-large">
                <img src="{{ $theme['preview_url'] ?? asset('assets/img/placeholder.jpg') }}"
                     alt="{{ $theme['name'] }}"
                     onerror="this.src='{{ asset('assets/img/placeholder.jpg') }}'">
            </div>

            <!-- Sections -->
            @if(!empty($theme['sections_config']))
                <div class="info-card">
                    <h5><i class="fas fa-puzzle-piece me-2 text-primary"></i>Available Sections</h5>
                    <ul class="section-list">
                        @foreach($theme['sections_config'] as $key => $section)
                            <li>
                                <span>
                                    <i class="fas fa-cube"></i>
                                    <strong>{{ $section['name'] ?? $key }}</strong>
                                    @if(!empty($section['description']))
                                        <span class="text-muted ms-2">- {{ $section['description'] }}</span>
                                    @endif
                                </span>
                                @if(!empty($section['fields']))
                                    <span class="badge bg-secondary">{{ count($section['fields']) }} fields</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Theme Info -->
            <div class="info-card">
                <h5><i class="fas fa-info-circle me-2 text-primary"></i>Theme Information</h5>
                <div class="info-item">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $theme['name'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Slug</span>
                    <span class="info-value"><code>{{ $theme['slug'] }}</code></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Version</span>
                    <span class="info-value">{{ $theme['version'] ?? '1.0.0' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Author</span>
                    <span class="info-value">
                        @if(!empty($theme['author_url']))
                            <a href="{{ $theme['author_url'] }}" target="_blank">{{ $theme['author'] ?? 'Unknown' }}</a>
                        @else
                            {{ $theme['author'] ?? 'Unknown' }}
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Category</span>
                    <span class="info-value">{{ $theme['category'] ?? 'General' }}</span>
                </div>
            </div>

            <!-- Color Presets -->
            @if(!empty($theme['color_presets']))
                <div class="info-card">
                    <h5><i class="fas fa-palette me-2 text-primary"></i>Color Presets</h5>
                    @foreach($theme['color_presets'] as $name => $color)
                        <div class="info-item">
                            <span class="info-label">{{ ucfirst($name) }}</span>
                            <span class="info-value">
                                <span class="color-swatch" style="background: {{ $color }}"></span>
                                <code>{{ $color }}</code>
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Tags -->
            @if(!empty($theme['tags']))
                <div class="info-card">
                    <h5><i class="fas fa-tags me-2 text-primary"></i>Tags</h5>
                    <div>
                        @foreach($theme['tags'] as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Included Sections -->
            @if(!empty($theme['sections']))
                <div class="info-card">
                    <h5><i class="fas fa-layer-group me-2 text-primary"></i>Included Sections</h5>
                    <div>
                        @foreach($theme['sections'] as $section)
                            <span class="tag">{{ $section }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
