@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section>
  <div class="td_height_{{ $about['spacing']['top'] }} td_height_lg_{{ $about['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="row td_gap_y_40">

      {{-- LEFT --}}
      <div class="col-lg-6">
        <div class="td_image_box td_style_2">

          <div class="td_image_box_img_1 wow fadeInLeft"
               data-wow-duration="{{ $about['animations']['left']['duration'] }}"
               data-wow-delay="{{ $about['animations']['left']['delay'] }}">
            <img src="{{ asset($about['images']['main']) }}" alt="">
          </div>

          <div class="td_image_box_img_2 wow fadeInUp"
               data-wow-duration="{{ $about['animations']['right']['duration'] }}"
               data-wow-delay="{{ $about['animations']['right']['delay'] }}">
            <img src="{{ asset($about['images']['secondary']) }}"
                 alt=""
                 class="td_image_box_img_2_thumb">

            @include('svg.home-v2.about.image-overlay-icon')
          </div>

          {{-- AWARD BOX --}}
          <div class="td_award_box wow fadeInDown"
               data-wow-duration="{{ $about['animations']['award']['duration'] }}"
               data-wow-delay="{{ $about['animations']['award']['delay'] }}">

            <div class="td_award_box_icon td_center">
              <img src="{{ asset($about['award']['icon']) }}" alt="">
            </div>

            <div class="td_award_box_in">
              <p class="td_fs_24 td_semibold td_white_color td_center td_accent_bg">
                {{ $about['award']['count'] }}
              </p>
              <h3 class="td_fs_14 td_semibold mb-0">
                {{ $about['award']['title'] }}
              </h3>
            </div>
          </div>

          <div class="td_image_box_shape_1"></div>

          {{-- VIDEO --}}
          <div class="td_image_box_shape_2">
            <a href="{{ $about['video']['url'] }}"
               class="td_player_btn_wrap td_video_open td_medium td_heading_color">
              <span class="td_player_btn td_center">
                <span></span>
              </span>
            </a>
          </div>

          {{-- SHAPE SVG --}}
          <div class="td_image_box_shape_3 td_accent_color">
            @include('svg.home-v2.about.image-box-shape-3')
          </div>

        </div>
      </div>

      {{-- RIGHT --}}
      <div class="col-lg-6 wow fadeInRight"
           data-wow-duration="{{ $about['animations']['content']['duration'] }}"
           data-wow-delay="{{ $about['animations']['content']['delay'] }}">

        <div class="td_section_heading td_style_1 td_mb_40">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
            <i></i>{{ $about['heading']['subtitle'] }}<i></i>
          </p>

          <h2 class="td_section_title td_fs_48 td_mb_24">
            {{ $about['heading']['title'] }}
          </h2>

          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $about['heading']['description'] }}
          </p>
        </div>

        {{-- FEATURES --}}
        <div class="td_mb_40 position-relative">
          <ul class="td_list td_style_2 td_fs_24 td_medium td_heading_color td_mp_0">
            @foreach($about['features'] as $feature)
              <li>
                @include('svg.home-v2.about.check-icon')
                {{ $feature }}
              </li>
            @endforeach
          </ul>

          <div class="td_list_2_shape">
            @include('svg.home-v2.about.list-bg-shape')
          </div>
        </div>

        {{-- BUTTON --}}
        <a href="{{ $about['button']['url'] }}"
           class="td_btn td_style_1 td_radius_30 td_medium td_with_shadow">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $about['button']['label'] }}</span>
            @include('svg.home-v2.about.button-arrow')
          </span>
        </a>

      </div>

    </div>
  </div>

  <div class="td_height_{{ $about['spacing']['bottom'] }} td_height_lg_{{ $about['spacing']['bottom_lg'] }}"></div>
</section>
