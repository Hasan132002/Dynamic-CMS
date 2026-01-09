@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section class="td_shape_section_9">

  <div class="td_shape_position_1 position-absolute">
    <img src="{{ asset($about['shapes']['shape_1']) }}" alt="">
  </div>
  <div class="td_shape_position_2 position-absolute">
    <img src="{{ asset($about['shapes']['shape_2']) }}" alt="">
  </div>

  <div class="td_height_{{ $about['spacing']['top'] }} td_height_lg_{{ $about['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="row td_gap_y_40 align-items-center">

      {{-- LEFT --}}
      <div class="col-lg-6">
        <div class="td_image_box td_style_3">

          <div class="td_image_box_img_1 wow fadeInLeft"
               data-wow-duration="{{ $about['animations']['img_1']['duration'] }}"
               data-wow-delay="{{ $about['animations']['img_1']['delay'] }}">
            <img src="{{ asset($about['images']['main_1']) }}" class="td_radius_10" alt="">
          </div>

          <div class="td_image_box_img_2 wow fadeInRight"
               data-wow-duration="{{ $about['animations']['img_2']['duration'] }}"
               data-wow-delay="{{ $about['animations']['img_2']['delay'] }}">
            <img src="{{ asset($about['images']['main_2']) }}" class="td_radius_10" alt="">
          </div>

          <div class="td_review_box td_heading_bg text-center td_center wow fadeInUp"
               data-wow-duration="{{ $about['animations']['review']['duration'] }}"
               data-wow-delay="{{ $about['animations']['review']['delay'] }}">
            <div class="td_review_box_in">
              <img src="{{ asset($about['review']['image']) }}" alt="">
              <h3 class="td_fs_32 td_medium td_white_color">{{ $about['review']['count'] }}</h3>
              <p class="mb-0 td_light td_opacity_7 td_white_color">{{ $about['review']['label'] }}</p>
            </div>
          </div>

          <div class="td_sign_box wow fadeInDown"
               data-wow-duration="{{ $about['animations']['sign']['duration'] }}"
               data-wow-delay="{{ $about['animations']['sign']['delay'] }}">

            <div class="td_sign_box_in">
              <img src="{{ asset($about['signature']['image']) }}" alt="">
              <h3 class="td_fs_20 td_semibold mb-0">{{ $about['signature']['name'] }}</h3>
              <p class="mb-0 td_heading_color td_opacity_6">{{ $about['signature']['designation'] }}</p>
            </div>

            {{-- SVG BACKGROUND --}}
            @include('svg.home-v3.about.sign-box-bg')

            <div class="td_award_box_icon td_center">
              <img src="{{ asset($about['signature']['award_icon']) }}" alt="">
            </div>
          </div>

        </div>
      </div>

      {{-- RIGHT --}}
      <div class="col-lg-6 wow fadeInRight"
           data-wow-duration="{{ $about['animations']['content']['duration'] }}"
           data-wow-delay="{{ $about['animations']['content']['delay'] }}">

        <div class="td_section_heading td_style_1 td_mb_40">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
            {{ $about['heading']['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 td_mb_20">
            {{ $about['heading']['title'] }}
          </h2>
          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $about['heading']['description'] }}
          </p>
        </div>

        <div class="td_mb_40 position-relative">
          @foreach($about['features'] as $feature)
            <div class="td_iconbox td_style_5">
              <div class="td_iconbox_icon">
                <div class="td_iconbox_icon_in td_center">
                  <img src="{{ asset($feature['icon']) }}" alt="">
                </div>
              </div>
              <div class="td_iconbox_right">
                <h3 class="td_iconbox_title td_fs_32 td_mb_4">{{ $feature['title'] }}</h3>
                <p class="td_iconbox_subtitle mb-0 td_heading_color td_fs_18 td_opacity_7">
                  {{ $feature['description'] }}
                </p>
              </div>
            </div>

            @if(!$loop->last)
              <div class="td_height_30 td_height_lg_30"></div>
            @endif
          @endforeach
        </div>

        <a href="{{ $about['button']['url'] }}"
           class="td_btn td_style_1 td_radius_30 td_medium td_with_shadow">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $about['button']['label'] }}</span>
            @include('svg.home-v3.about.button-arrow')
          </span>
        </a>

      </div>

    </div>
  </div>

  <div class="td_height_{{ $about['spacing']['bottom'] }} td_height_lg_{{ $about['spacing']['bottom_lg'] }}"></div>
</section>
