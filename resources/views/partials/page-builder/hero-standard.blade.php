{{-- Hero Standard Section - Template Styled --}}
@php
    $background = $data['background'] ?? 'assets/img/home_1/hero_bg_1.jpg';
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $primaryBtn = $data['primary_btn'] ?? [];
    $secondaryBtn = $data['secondary_btn'] ?? [];
@endphp

<section>
    <section class="td_hero td_style_1 td_heading_bg td_center td_bg_filed" data-src="{{ asset($background) }}">
        <div class="container">
            <div class="td_hero_text wow fadeInRight" data-wow-duration="0.9s" data-wow-delay="0.35s">
                @if($subtitle)
                    <p class="td_hero_subtitle_up td_fs_18 td_white_color td_spacing_1 td_semibold text-uppercase td_mb_10 td_opacity_9">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($title)
                    <h1 class="td_hero_title td_fs_64 td_white_color td_mb_12">
                        {!! $title !!}
                    </h1>
                @endif

                @if($description)
                    <p class="td_hero_subtitle td_fs_18 td_white_color td_opacity_7 td_mb_30">
                        {{ $description }}
                    </p>
                @endif

                @if(!empty($primaryBtn['text']))
                    <a href="{{ $primaryBtn['link'] ?? '#' }}" class="td_btn td_style_1 td_radius_10 td_medium">
                        <span class="td_btn_in td_white_color td_accent_bg">
                            <span>{{ $primaryBtn['text'] }}</span>
                            <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.5303 6.53033C18.8232 6.23744 18.8232 5.76256 18.5303 5.46967L13.7574 0.696699C13.4645 0.403806 12.9896 0.403806 12.6967 0.696699C12.4038 0.989593 12.4038 1.46447 12.6967 1.75736L16.9393 6L12.6967 10.2426C12.4038 10.5355 12.4038 11.0104 12.6967 11.3033C12.9896 11.5962 13.4645 11.5962 13.7574 11.3033L18.5303 6.53033ZM0 6.75H18V5.25H0V6.75Z" fill="currentColor"/>
                            </svg>
                        </span>
                    </a>
                @endif
            </div>
        </div>

        <div class="td_lines">
            <span></span><span></span><span></span><span></span>
        </div>
    </section>

    @if(!empty($secondaryBtn['text']) || !empty($primaryBtn['text']))
    <div class="container">
        <div class="td_hero_btn_group">
            @if(!empty($primaryBtn['text']))
                <a href="{{ $primaryBtn['link'] ?? '#' }}" class="td_btn td_style_1 td_radius_10 td_medium td_fs_20 wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="0.35s">
                    <span class="td_btn_in td_white_color td_accent_bg">
                        <span>{{ $primaryBtn['text'] }}</span>
                        <svg width="19" height="12" viewBox="0 0 19 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5303 6.53033C18.8232 6.23744 18.8232 5.76256 18.5303 5.46967L13.7574 0.696699C13.4645 0.403806 12.9896 0.403806 12.6967 0.696699C12.4038 0.989593 12.4038 1.46447 12.6967 1.75736L16.9393 6L12.6967 10.2426C12.4038 10.5355 12.4038 11.0104 12.6967 11.3033C12.9896 11.5962 13.4645 11.5962 13.7574 11.3033L18.5303 6.53033ZM0 6.75H18V5.25H0V6.75Z" fill="currentColor"/>
                        </svg>
                    </span>
                </a>
            @endif

            @if(!empty($secondaryBtn['text']))
                <a href="{{ $secondaryBtn['link'] ?? '#' }}" class="td_btn td_style_1 td_radius_10 td_medium td_fs_20 wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="0.45s">
                    <span class="td_btn_in td_white_color td_accent_bg">
                        <span>{{ $secondaryBtn['text'] }}</span>
                    </span>
                </a>
            @endif
        </div>
    </div>
    @endif
</section>
