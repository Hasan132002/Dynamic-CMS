@extends('admin.layouts.app')

@section('title', 'Page Builder')

@section('styles')
<style>
    .page-builder-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-builder-header h1 {
        font-size: 28px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
    }

    .btn-create {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .pages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 20px;
    }

    .page-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .page-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    }

    .page-card-header {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 5px 0;
    }

    .page-slug {
        font-size: 13px;
        color: #888;
        font-family: 'Monaco', monospace;
    }

    .page-slug a {
        color: #667eea;
        text-decoration: none;
    }

    .page-slug a:hover {
        text-decoration: underline;
    }

    .page-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .page-status.published {
        background: #d4edda;
        color: #155724;
    }

    .page-status.draft {
        background: #fff3cd;
        color: #856404;
    }

    .page-card-body {
        padding: 20px;
    }

    .page-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .page-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #666;
    }

    .page-meta-item i {
        color: #999;
    }

    .page-sections-count {
        background: #f8f9fa;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 13px;
        color: #555;
    }

    .page-sections-count strong {
        color: #667eea;
    }

    .page-card-actions {
        padding: 15px 20px;
        background: #f8f9fa;
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
    }

    .btn-edit {
        background: #e8f4fd;
        color: #0d6efd;
    }

    .btn-edit:hover {
        background: #0d6efd;
        color: white;
    }

    .btn-view {
        background: #e8f8ea;
        color: #198754;
    }

    .btn-view:hover {
        background: #198754;
        color: white;
    }

    .btn-duplicate {
        background: #fff8e6;
        color: #cc8a00;
    }

    .btn-duplicate:hover {
        background: #cc8a00;
        color: white;
    }

    .btn-delete {
        background: #fde8e8;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .empty-state-icon i {
        font-size: 36px;
        color: white;
    }

    .empty-state h3 {
        font-size: 22px;
        color: #1a1a2e;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 25px;
    }

    .template-badge {
        background: #f0f0f0;
        padding: 3px 10px;
        border-radius: 15px;
        font-size: 11px;
        color: #666;
        margin-left: 10px;
    }

    /* Search and Filter */
    .page-filters {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        border-color: #667eea;
        outline: none;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .filter-select {
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 14px;
        min-width: 150px;
        cursor: pointer;
    }

    .filter-select:focus {
        border-color: #667eea;
        outline: none;
    }
</style>
@endsection

@section('content')
<div class="page-builder-header">
    <h1><i class="fas fa-layer-group me-2"></i>Page Builder</h1>
    <a href="{{ route('admin.page-builder.create') }}" class="btn btn-create">
        <i class="fas fa-plus"></i> Create New Page
    </a>
</div>

<div class="page-filters">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="searchPages" placeholder="Search pages...">
    </div>
    <select class="filter-select" id="filterStatus">
        <option value="">All Status</option>
        <option value="published">Published</option>
        <option value="draft">Draft</option>
    </select>
    <select class="filter-select" id="filterTemplate">
        <option value="">All Templates</option>
        @foreach($templates as $key => $template)
            <option value="{{ $key }}">{{ $template['name'] }}</option>
        @endforeach
    </select>
</div>

@if(count($pages) > 0)
    <div class="pages-grid" id="pagesGrid">
        @foreach($pages as $page)
            <div class="page-card" data-status="{{ $page['status'] }}" data-template="{{ $page['template'] }}" data-title="{{ strtolower($page['title']) }}">
                <div class="page-card-header">
                    <div>
                        <h3 class="page-title">
                            {{ $page['title'] }}
                            <span class="template-badge">{{ $templates[$page['template']]['name'] ?? $page['template'] }}</span>
                        </h3>
                        <div class="page-slug">
                            <a href="/{{ $page['slug'] }}" target="_blank">/{{ $page['slug'] }}</a>
                        </div>
                    </div>
                    <span class="page-status {{ $page['status'] }}">{{ $page['status'] }}</span>
                </div>

                <div class="page-card-body">
                    <div class="page-meta">
                        <div class="page-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($page['updated_at'])->format('M d, Y') }}
                        </div>
                        <div class="page-meta-item">
                            <i class="fas fa-clock"></i>
                            {{ \Carbon\Carbon::parse($page['updated_at'])->format('h:i A') }}
                        </div>
                    </div>
                    <div class="page-sections-count">
                        <i class="fas fa-puzzle-piece me-1"></i>
                        <strong>{{ count($page['sections'] ?? []) }}</strong> sections
                    </div>
                </div>

                <div class="page-card-actions">
                    <a href="{{ route('admin.page-builder.edit', $page['slug']) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    @if($page['status'] === 'published')
                        <a href="/{{ $page['slug'] }}" target="_blank" class="btn-action btn-view">
                            <i class="fas fa-eye"></i> View
                        </a>
                    @endif
                    <button class="btn-action btn-duplicate" onclick="duplicatePage('{{ $page['slug'] }}')">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button class="btn-action btn-delete" onclick="deletePage('{{ $page['slug'] }}', '{{ $page['title'] }}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-layer-group"></i>
        </div>
        <h3>No Custom Pages Yet</h3>
        <p>Create your first custom page with our drag-and-drop builder</p>
        <a href="{{ route('admin.page-builder.create') }}" class="btn btn-create">
            <i class="fas fa-plus"></i> Create Your First Page
        </a>
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Delete Page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="text-danger mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                </div>
                <p>Are you sure you want to delete "<strong id="deletePageTitle"></strong>"?</p>
                <p class="text-muted small">This action cannot be undone.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Delete Page</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let deleteSlug = '';

    // Search functionality
    document.getElementById('searchPages').addEventListener('input', filterPages);
    document.getElementById('filterStatus').addEventListener('change', filterPages);
    document.getElementById('filterTemplate').addEventListener('change', filterPages);

    function filterPages() {
        const searchTerm = document.getElementById('searchPages').value.toLowerCase();
        const statusFilter = document.getElementById('filterStatus').value;
        const templateFilter = document.getElementById('filterTemplate').value;

        document.querySelectorAll('.page-card').forEach(card => {
            const title = card.dataset.title;
            const status = card.dataset.status;
            const template = card.dataset.template;

            const matchesSearch = title.includes(searchTerm);
            const matchesStatus = !statusFilter || status === statusFilter;
            const matchesTemplate = !templateFilter || template === templateFilter;

            card.style.display = (matchesSearch && matchesStatus && matchesTemplate) ? 'block' : 'none';
        });
    }

    // Delete page
    function deletePage(slug, title) {
        deleteSlug = slug;
        document.getElementById('deletePageTitle').textContent = title;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        fetch(`/admin/page-builder/${deleteSlug}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to delete page');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    });

    // Duplicate page
    function duplicatePage(slug) {
        fetch(`/admin/page-builder/${slug}/duplicate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.redirect) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Failed to duplicate page');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }
</script>
@endsection
