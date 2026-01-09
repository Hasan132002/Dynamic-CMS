{{-- Image with Text Section --}}
@php
    $image = $data['image'] ?? '';
    $imagePosition = $data['image_position'] ?? 'left';
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
    $btnText = $data['btn_text'] ?? '';
    $btnLink = $data['btn_link'] ?? '#';
@endphp

<div class="td_image_text">
    <div class="container">
        <div class="row align-items-center {{ $imagePosition === 'right' ? 'flex-row-reverse' : '' }}">
            @if($image)
                <div class="col-lg-6">
                    <div class="td_image_text_thumb wow fadeIn{{ $imagePosition === 'right' ? 'Right' : 'Left' }}" data-wow-duration="0.9s" data-wow-delay="0.25s">
                        <img src="{{ asset($image) }}" alt="{{ $title }}" class="img-fluid rounded">
                    </div>
                </div>
            @endif

            <div class="col-lg-{{ $image ? '6' : '12' }}">
                <div class="td_image_text_content {{ $image ? ($imagePosition === 'right' ? 'pe-lg-5' : 'ps-lg-5') : '' }} wow fadeIn{{ $imagePosition === 'right' ? 'Left' : 'Right' }}" data-wow-duration="0.9s" data-wow-delay="0.35s">
                    @if($title)
                        <h2 class="td_section_title td_fs_36 td_mb_20">
                            {!! $title !!}
                        </h2>
                    @endif

                    @if($content)
                        <div class="td_image_text_desc td_mb_25">
                            {!! $content !!}
                        </div>
                    @endif

                    @if($btnText)
                        <a href="{{ $btnLink }}" class="td_btn td_style_1 td_radius_10 td_medium">
                            <span class="td_btn_in td_white_color td_accent_bg">
                                <span>{{ $btnText }}</span>
                                <svg width="19" height="12" viewBox="0 0 19 12" fill="none">
                                    <path d="M18.5303 6.53033C18.8232 6.23744 18.8232 5.76256 18.5303 5.46967L13.7574 0.696699C13.4645 0.403806 12.9896 0.403806 12.6967 0.696699C12.4038 0.989593 12.4038 1.46447 12.6967 1.75736L16.9393 6L12.6967 10.2426C12.4038 10.5355 12.4038 11.0104 12.6967 11.3033C12.9896 11.5962 13.4645 11.5962 13.7574 11.3033L18.5303 6.53033ZM0 6.75H18V5.25H0V6.75Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
