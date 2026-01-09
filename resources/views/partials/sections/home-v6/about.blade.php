@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section>
  <div class="container">
    <div class="row td_gap_y_40">

      <div class="col-lg-6 wow fadeInLeft"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="td_image_box td_style_7">

          <div class="td_image_box_img_1">
            <img src="{{ asset($about['images']['main']) }}" alt="">
          </div>

          <div class="td_image_box_img_2">
            <div class="td_image_box_img_2_in position-relative">
              <img src="{{ asset($about['images']['secondary']) }}" alt="">
              @include('svg.home-v6.about.video-icon')
            </div>
          </div>

          <div class="td_image_box_shape_1">
            <div class="td_image_box_shape_1_in td_accent_bg td_center">
              <img src="{{ asset($about['icon']) }}" alt="">
            </div>
            @include('svg.home-v6.about.shape-circle')
          </div>

          <div class="td_image_box_shape_2">
            @include('svg.home-v6.about.shape-line')
          </div>

        </div>
      </div>

      <div class="col-lg-6 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="td_section_heading td_style_1 td_mb_40">
          <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1
                    td_mb_10 text-uppercase td_accent_color">
            {{ $about['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 td_mb_24">
            {{ $about['title'] }}
          </h2>
          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $about['description'] }}
          </p>
        </div>

        <div class="td_mb_40 position-relative">
          <ul class="td_list td_style_2 td_fs_24 td_medium
                     td_heading_color td_mp_0">
            @foreach($about['features'] as $feature)
              <li>
                @include('svg.home-v6.about.check')
                {{ $feature }}
              </li>
            @endforeach
          </ul>
        </div>

        <a href="{{ $about['button']['url'] }}"
           class="td_btn td_style_1 td_medium td_with_shadow_2">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $about['button']['label'] }}</span>
          </span>
        </a>

      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
