@php
    $sectionName = 'Unknown Section';
    $sectionType = $section['type'] ?? 'unknown';

    // Find section name from library
    foreach ($sectionLibrary as $category) {
        if (isset($category['sections'][$sectionType])) {
            $sectionName = $category['sections'][$sectionType]['name'];
            break;
        }
    }

    $isVisible = $section['visible'] ?? true;
@endphp

<div class="section-block" data-section-id="{{ $section['id'] }}">
    <div class="section-block-header">
        <div class="section-block-left">
            <span class="drag-handle"><i class="fas fa-grip-vertical"></i></span>
            <div class="section-type-icon">
                @if(str_contains($sectionType, 'hero'))
                    <i class="fas fa-image"></i>
                @elseif(str_contains($sectionType, 'about'))
                    <i class="fas fa-info-circle"></i>
                @elseif(str_contains($sectionType, 'feature'))
                    <i class="fas fa-star"></i>
                @elseif(str_contains($sectionType, 'text'))
                    <i class="fas fa-align-left"></i>
                @elseif(str_contains($sectionType, 'image'))
                    <i class="fas fa-image"></i>
                @elseif(str_contains($sectionType, 'cta'))
                    <i class="fas fa-bullhorn"></i>
                @elseif(str_contains($sectionType, 'testimonial'))
                    <i class="fas fa-quote-left"></i>
                @elseif(str_contains($sectionType, 'contact'))
                    <i class="fas fa-envelope"></i>
                @elseif(str_contains($sectionType, 'gallery'))
                    <i class="fas fa-images"></i>
                @elseif(str_contains($sectionType, 'team'))
                    <i class="fas fa-users"></i>
                @elseif(str_contains($sectionType, 'faq'))
                    <i class="fas fa-question-circle"></i>
                @elseif(str_contains($sectionType, 'spacer'))
                    <i class="fas fa-arrows-alt-v"></i>
                @elseif(str_contains($sectionType, 'divider'))
                    <i class="fas fa-minus"></i>
                @else
                    <i class="fas fa-cube"></i>
                @endif
            </div>
            <div class="section-block-info">
                <h4>{{ $sectionName }}</h4>
                <span>{{ $sectionType }}</span>
            </div>
        </div>
        <div class="section-block-actions">
            <button class="section-btn btn-visibility {{ $isVisible ? '' : 'hidden' }}"
                    onclick="toggleSectionVisibility('{{ $section['id'] }}')"
                    title="{{ $isVisible ? 'Hide' : 'Show' }}">
                <i class="fas fa-eye{{ $isVisible ? '' : '-slash' }}"></i>
            </button>
            <button class="section-btn btn-edit" onclick="editSection('{{ $section['id'] }}')" title="Edit">
                <i class="fas fa-edit"></i>
            </button>
            <button class="section-btn btn-duplicate" onclick="duplicateSection('{{ $section['id'] }}')" title="Duplicate">
                <i class="fas fa-copy"></i>
            </button>
            <button class="section-btn btn-delete" onclick="deleteSection('{{ $section['id'] }}')" title="Delete">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </div>

    @if(!empty($section['data']))
        <div class="section-block-preview">
            @if(isset($section['data']['title']))
                <strong>Title:</strong> {{ Str::limit(strip_tags($section['data']['title']), 50) }}
            @elseif(isset($section['data']['subtitle']))
                <strong>Subtitle:</strong> {{ Str::limit($section['data']['subtitle'], 50) }}
            @elseif(isset($section['data']['content']))
                {{ Str::limit(strip_tags($section['data']['content']), 80) }}
            @elseif(isset($section['data']['height']))
                <strong>Height:</strong> {{ $section['data']['height'] }}px
            @endif
        </div>
    @endif
</div>
