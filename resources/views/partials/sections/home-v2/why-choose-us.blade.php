@php
  $section = isset($why_choose_us['data']) && is_array($why_choose_us['data']) ? $why_choose_us['data'] : ($why_choose_us ?? null);
@endphp

@if($section)
<section class="{{ $section['section_classes'] }}">

  {{-- SHAPES --}}
  @foreach($section['shapes'] as $shape)
    <div class="{{ $shape['class'] }}">
      @if(!empty($shape['src']))
        <img src="{{ asset($shape['src']) }}" alt="">
      @endif
    </div>
  @endforeach

  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_40">

      {{-- LEFT IMAGE BOX --}}
      <div class="col-xl-6">
        <div class="td_image_box td_style_1">

          <img src="{{ asset($section['image_box']['image']) }}"
               alt=""
               class="td_image_box_thumb wow fadeInUp"
               data-wow-duration="1s"
               data-wow-delay="0.2s">

          <div class="td_avatars_wrap td_type_2 wow fadeInLeft"
               data-wow-duration="1s"
               data-wow-delay="0.2s">

            <h3 class="mb-0 td_fs_24 td_semibold">
              {{ $section['image_box']['students']['title'] }}
            </h3>

            <div class="td_avatars">
              @foreach($section['image_box']['students']['avatars'] as $avatar)
                <div>
                  <img src="{{ asset($avatar) }}" alt="">
                </div>
              @endforeach
              <div class="td_avatar_end td_fs_18 td_medium td_center">
                {{ $section['image_box']['students']['end_text'] }}
              </div>
            </div>
          </div>

          <a href="{{ $section['image_box']['video_url'] }}"
             class="td_player_btn_wrap_3 td_video_open td_center wow fadeInRight"
             data-wow-duration="1s"
             data-wow-delay="0.2s">

            <span class="td_player_btn td_center">
              <span></span>
            </span>
          </a>

        </div>
      </div>

      {{-- RIGHT CONTENT --}}
      <div class="col-xl-6 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="0.4s">

        <div class="td_section_heading td_style_1">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
            <i></i>
            {{ $section['subtitle'] }}
            <i></i>
          </p>

          <h2 class="td_section_title td_fs_36 mb-0">
            {{ $section['title'] }}
          </h2>

          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $section['description'] }}
          </p>
        </div>

        <div class="td_height_40 td_height_lg_40"></div>

        {{-- FEATURE LIST --}}
        <ul class="td_list td_style_1 td_mp_0 td_semibold td_heading_color">
          @foreach($section['features'] as $feature)
            <li>
              <i class="td_list_icon td_center">
                @includeIf('svg.home-v2.why-choose-us.check')
              </i>
              {{ $feature }}
            </li>
          @endforeach
        </ul>

        <div class="td_height_40 td_height_lg_40"></div>

        {{-- BUTTON --}}
        <a href="{{ $section['button']['url'] }}"
           class="td_btn td_style_1 td_radius_30 td_medium">

          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $section['button']['text'] }}</span>
            @includeIf('svg.home-v2.why-choose-us.' . $section['button']['icon'])
          </span>
        </a>

      </div>
    </div>
  </div>

  <div class="td_height_112 td_height_lg_75"></div>
</section>
@endif
