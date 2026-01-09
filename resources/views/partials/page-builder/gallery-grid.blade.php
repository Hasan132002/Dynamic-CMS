{{-- Gallery Grid Section --}}
@php
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? '';
    $columns = $data['columns'] ?? 3;
    $images = $data['images'] ?? [];

    $colClass = match((int)$columns) {
        2 => 'col-md-6',
        4 => 'col-lg-3 col-md-6',
        default => 'col-lg-4 col-md-6',
    };
@endphp

<div class="td_gallery td_style_1">
    <div class="container">
        @if($subtitle || $title)
            <div class="td_section_heading td_style_1 text-center td_mb_40">
                @if($subtitle)
                    <p class="td_section_subtitle td_fs_18 td_semibold td_spacing_1 td_mb_10 td_accent_color text-uppercase">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($title)
                    <h2 class="td_section_title td_fs_48 td_mb_15">
                        {!! $title !!}
                    </h2>
                @endif
            </div>
        @endif

        @if(!empty($images))
            <div class="row">
                @foreach($images as $index => $image)
                    @php
                        $imgSrc = is_array($image) ? ($image['src'] ?? $image['url'] ?? '') : $image;
                        $imgAlt = is_array($image) ? ($image['alt'] ?? 'Gallery Image') : 'Gallery Image';
                        $imgCaption = is_array($image) ? ($image['caption'] ?? '') : '';
                    @endphp
                    @if($imgSrc)
                    <div class="{{ $colClass }} td_mb_30">
                        <div class="td_gallery_item wow fadeIn" data-wow-duration="0.9s" data-wow-delay="{{ 0.1 + ($index * 0.05) }}s">
                            <a href="{{ asset($imgSrc) }}" class="td_gallery_link" data-lightbox="gallery">
                                <img src="{{ asset($imgSrc) }}" alt="{{ $imgAlt }}" class="img-fluid rounded">
                                <div class="td_gallery_overlay">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </a>
                            @if($imgCaption)
                                <p class="td_gallery_caption text-center td_mt_10">{{ $imgCaption }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="td_gallery_empty">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-0">No images added to the gallery yet.</p>
                    <small class="text-muted">Edit this section to add images.</small>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .td_gallery_item {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .td_gallery_link {
        display: block;
        position: relative;
    }

    .td_gallery_link img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .td_gallery_overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(102, 126, 234, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .td_gallery_overlay i {
        color: white;
        font-size: 24px;
    }

    .td_gallery_item:hover .td_gallery_link img {
        transform: scale(1.1);
    }

    .td_gallery_item:hover .td_gallery_overlay {
        opacity: 1;
    }
</style>
