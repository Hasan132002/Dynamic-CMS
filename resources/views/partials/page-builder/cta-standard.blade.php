{{-- CTA Standard Section --}}
@php
    $background = $data['background'] ?? '';
    $bgColor = $data['background_color'] ?? '#1a73e8';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $btnText = $data['btn_text'] ?? '';
    $btnLink = $data['btn_link'] ?? '#';

    $bgStyle = $background
        ? "background-image: url('" . asset($background) . "'); background-size: cover; background-position: center;"
        : "background-color: {$bgColor};";
@endphp

<div class="td_cta td_style_1" style="{{ $bgStyle }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="td_cta_content wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="0.25s">
                    @if($title)
                        <h2 class="td_cta_title td_fs_48 td_white_color td_mb_15">
                            {!! $title !!}
                        </h2>
                    @endif

                    @if($description)
                        <p class="td_cta_text td_white_color td_opacity_8 td_mb_30">
                            {{ $description }}
                        </p>
                    @endif

                    @if($btnText)
                        <a href="{{ $btnLink }}" class="td_btn td_style_1 td_radius_10 td_medium">
                            <span class="td_btn_in td_accent_color td_white_bg">
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
