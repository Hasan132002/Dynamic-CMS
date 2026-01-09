{{-- Video V1 Section (Home V1 Style) --}}
@php
    $background = $data['background'] ?? '';
    $videoUrl = $data['video_url'] ?? '';
    $heading = $data['heading'] ?? '';
    $contact = $data['contact'] ?? [];
    $leftContact = $contact['left'] ?? ['label' => '', 'text' => '', 'link' => ''];
    $middleText = $contact['middle_text'] ?? 'OR';
    $rightContact = $contact['right'] ?? ['label' => '', 'text' => '', 'link' => ''];
@endphp

<section>
    <div class="td_video_block td_style_1 td_accent_bg td_bg_filed td_center text-center"
         @if($background) data-src="{{ asset($background) }}" style="background-image: url('{{ asset($background) }}');" @endif>
        <div class="container">

            @if($videoUrl)
                <a href="{{ $videoUrl }}"
                   class="td_player_btn_wrap_2 td_video_open wow zoomIn"
                   data-wow-duration="1s"
                   data-wow-delay="0.2s">
                    <span class="td_player_btn td_center">
                        <span></span>
                    </span>
                </a>
            @endif

            <div class="td_height_70 td_height_lg_50"></div>

            @if($heading)
                <h2 class="td_fs_48 td_white_color mb-0 wow fadeInUp"
                    data-wow-duration="1s"
                    data-wow-delay="0.2s">
                    {!! $heading !!}
                </h2>
            @endif

        </div>
    </div>

    @if(($leftContact['text'] ?? false) || ($rightContact['text'] ?? false))
        <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
            <div class="td_contact_box td_style_1 td_accent_bg td_radius_10">

                @if($leftContact['text'] ?? false)
                    <div class="td_contact_box_left">
                        @if($leftContact['label'] ?? false)
                            <p class="td_fs_18 td_light td_white_color td_mb_4">
                                {{ $leftContact['label'] }}
                            </p>
                        @endif
                        <h3 class="td_fs_36 mb-0 td_white_color">
                            <a href="{{ $leftContact['link'] ?? '#' }}">
                                {{ $leftContact['text'] }}
                            </a>
                        </h3>
                    </div>
                @endif

                @if($middleText)
                    <div class="td_contact_box_or td_fs_24 td_medium td_white_bg td_white_bg td_center rounded-circle td_accent_color">
                        {{ $middleText }}
                    </div>
                @endif

                @if($rightContact['text'] ?? false)
                    <div class="td_contact_box_right">
                        @if($rightContact['label'] ?? false)
                            <p class="td_fs_18 td_light td_white_color td_mb_4">
                                {{ $rightContact['label'] }}
                            </p>
                        @endif
                        <h3 class="td_fs_36 mb-0 td_white_color">
                            <a href="{{ $rightContact['link'] ?? '#' }}">
                                {{ $rightContact['text'] }}
                            </a>
                        </h3>
                    </div>
                @endif

            </div>
        </div>
    @endif
</section>
