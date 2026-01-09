@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_40">
      <div class="col-lg-6">
        <div class="td_image_box td_style_6 td_type_1">
          <div class="td_image_box_img_1 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="{{ asset($about['images']['img_1']) }}" alt="">
          </div>
          <div class="td_image_box_img_2 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
            <div class="td_image_box_img_2_in">
              <img src="{{ asset($about['images']['img_2']) }}" alt="">
              <a href="{{ $about['video_url'] }}" class="td_video_open">
                <span class="td_player_btn td_center">
                  <span></span>
                </span>
              </a>
            </div>
          </div>

          <div class="td_image_box_shape_1 position-absolute"></div>

          <div class="td_image_box_shape_2 position-absolute">
            <img src="{{ asset($about['images']['shape_2']) }}" alt="">
          </div>

          <div class="td_image_box_shape_3 position-absolute td_accent_color">
            <img src="{{ asset($about['images']['shape_3']) }}" alt="">
          </div>
        </div>
      </div>

      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.4s">
        <div class="td_section_heading td_style_1 td_mb_30">
          <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">
            {{ $about['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 td_mb_30">
            {{ $about['title'] }}
          </h2>
          <h3 class="td_fs_24 td_medium td_mb_30 fst-italic">
            {{ $about['highlight'] }}
          </h3>
          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $about['description'] }}
          </p>
        </div>

        <div class="td_mb_40">
          <ul class="td_list td_style_2 td_type_1 td_fs_24 td_medium td_heading_color td_mp_0">
            @foreach($about['list'] as $item)
              <li>
                @include('svg.home-v7.about.check')
                {{ $item }}
              </li>
            @endforeach
          </ul>
        </div>

        <div class="td_btns_group">
          <a href="{{ $about['button']['url'] }}"
             class="td_btn td_style_1 td_type_2 td_radius_30 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $about['button']['label'] }}</span>
              <span class="td_btn_icon td_center td_accent_bg td_white_color">
                @include('svg.home-v7.about.arrow')
              </span>
            </span>
          </a>

          <a href="{{ $about['video_url'] }}"
             class="td_player_btn_wrap td_type_1 td_video_open td_medium td_heading_color">
            <span class="td_player_btn td_center">
              <span></span>
            </span>
            <span class="td_play_btn_text">{{ $about['video_text'] }}</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
