@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section class="td_shape_section_2">

  <div class="td_shape td_shape_position_1 td_accent_color">
    @include('svg.home-v4.about.shape-1')
  </div>

  <div class="td_shape td_shape_position_2">
    <img src="{{ asset($about['shapes'][0]) }}" alt="">
  </div>

  <div class="td_shape td_shape_position_3">
    <img src="{{ asset($about['shapes'][1]) }}" alt="">
  </div>

  <div class="td_shape td_shape_position_4">
    <img src="{{ asset($about['shapes'][2]) }}" alt="">
  </div>

  <div class="td_shape td_shape_position_5"></div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_40">

      {{-- LEFT IMAGES --}}
      <div class="col-xl-6">
        <div class="td_image_box td_style_5">

          <div class="td_image_box_img_1 wow fadeInLeft"
               data-wow-duration="1s" data-wow-delay="0.3s">
            <img src="{{ asset($about['images']['img_1']) }}" alt="">
          </div>

          <div class="td_image_box_img_2 wow fadeInRight"
               data-wow-duration="1s" data-wow-delay="0.3s">
            <img src="{{ asset($about['images']['img_2']) }}" alt="">
          </div>

          <div class="td_image_box_circle wow fadeInDown"
               data-wow-duration="1s" data-wow-delay="0.3s">
            <div class="td_image_box_circle_in td_center">
              <img src="{{ asset($about['images']['circle_icon']) }}"
                   alt="" class="td_image_box_circle_icon">
              <img src="{{ asset($about['images']['circle_text']) }}"
                   alt="" class="td_image_box_circle_text">
            </div>
          </div>

        </div>
      </div>

      {{-- RIGHT CONTENT --}}
      <div class="col-xl-6 wow fadeInRight"
           data-wow-duration="1s" data-wow-delay="0.4s">

        <div class="td_section_heading td_style_1 td_mb_30">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1
                    td_mb_10 text-uppercase td_accent_color">
            {{ $about['subtitle'] }}
          </p>

          <h2 class="td_section_title td_fs_48 td_mb_30">
            {{ $about['title'] }}
          </h2>

          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $about['description'] }}
          </p>
        </div>

        <div class="td_mb_40">
          <ul class="td_list td_style_4 td_mp_0">
            @foreach($about['features'] as $feature)
              <li>
                <div class="td_list_icon td_center">
                  <div class="td_list_icon_icon_in td_center">
                    <img src="{{ asset($feature['icon']) }}" alt="">
                  </div>
                </div>
                <div class="td_list_right">
                  <h3 class="td_fs_20 td_semibold td_mb_2">
                    {{ $feature['title'] }}
                  </h3>
                  <p class="mb-0 td_fs_14 td_heading_color">
                    {{ $feature['text'] }}
                  </p>
                </div>
              </li>
            @endforeach
          </ul>
        </div>

        <a href="{{ $about['button']['url'] }}"
           class="td_btn td_style_1 td_radius_10 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $about['button']['label'] }}</span>
            @include('svg.home-v4.about.arrow-btn')
          </span>
        </a>

      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
