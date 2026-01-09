{{-- About V1 Section (Home V1 Style) --}}
@php
    $est = $data['est'] ?? 'Est 1990';
    $images = $data['images'] ?? [];
    $videoUrl = $data['video_url'] ?? '';
    $circleTextImage = $data['circle_text_image'] ?? 'assets/img/home_1/round_text.svg';
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $programs = $data['programs'] ?? [];
    $button = $data['button'] ?? ['label' => 'Learn More', 'url' => '#'];
@endphp

<section>
    <div class="td_height_120 td_height_lg_80"></div>
    <div class="td_about td_style_1">
        <div class="container">
            <div class="row align-items-center td_gap_y_40">
                <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.25s">
                    <div class="td_about_thumb_wrap">
                        <div class="td_about_year text-uppercase td_fs_64 td_bold">{{ $est }}</div>
                        @if(isset($images[0]))
                            <div class="td_about_thumb_1">
                                <img src="{{ asset($images[0]) }}" alt="">
                            </div>
                        @endif
                        @if(isset($images[1]))
                            <div class="td_about_thumb_2">
                                <img src="{{ asset($images[1]) }}" alt="">
                            </div>
                        @endif
                        @if($videoUrl)
                            <a href="{{ $videoUrl }}" class="td_circle_text td_center td_video_open">
                                <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.086 8.63792C14.6603 9.03557 14.6603 9.88459 14.086 10.2822L2.54766 18.2711C1.88444 18.7303 0.978418 18.2557 0.978418 17.449L0.978418 1.47118C0.978418 0.664496 1.88444 0.189811 2.54767 0.649016L14.086 8.63792Z" fill="white"/>
                                </svg>
                                <img src="{{ asset($circleTextImage) }}" alt="" class="">
                            </a>
                        @endif
                        <div class="td_circle_shape"></div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="td_section_heading td_style_1 td_mb_30">
                        @if($subtitle)
                            <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
                                {{ $subtitle }}
                            </p>
                        @endif
                        @if($title)
                            <h2 class="td_section_title td_fs_48 mb-0">
                                {!! $title !!}
                            </h2>
                        @endif
                        @if($description)
                            <p class="td_section_subtitle td_fs_18 mb-0">
                                {{ $description }}
                            </p>
                        @endif
                    </div>

                    @if(!empty($programs))
                        <div class="td_mb_40">
                            <ul class="td_list td_style_5 td_mp_0">
                                @foreach($programs as $program)
                                    <li>
                                        <h3 class="td_fs_24 td_mb_8">{{ $program['title'] ?? '' }}</h3>
                                        <p class="td_fs_18 mb-0">{{ $program['text'] ?? '' }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($button['label'] ?? false)
                        <a href="{{ $button['url'] ?? '#' }}" class="td_btn td_style_1 td_radius_10 td_medium">
                            <span class="td_btn_in td_white_color td_accent_bg">
                                <span>{{ $button['label'] }}</span>
                                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.1575 4.34302L3.84375 15.6567" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.157 11.4142C15.157 11.4142 16.0887 5.2748 15.157 4.34311C14.2253 3.41142 8.08594 4.34314 8.08594 4.34314" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="td_height_120 td_height_lg_80"></div>
</section>
