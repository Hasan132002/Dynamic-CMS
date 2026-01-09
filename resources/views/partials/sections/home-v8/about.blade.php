@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section>
  <div class="td_wrap_box_1 td_radius_10">
    <div class="td_wrap_box_1_shape_1 position-absolute">
      <img src="{{ asset($about['shape_1']) }}" alt="">
    </div>
    <div class="td_height_120 td_height_lg_80"></div>
    <div class="container">
      <div class="row align-items-center td_gap_y_40">
        <div class="col-lg-6">
          <div class="td_image_box td_style_6 td_type_2">
            <div class="td_image_box_img_1 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
              <img src="{{ asset($about['image_1']) }}" alt="">
            </div>
            <div class="td_image_box_img_2 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
              <div class="td_image_box_img_2_in">
                <img src="{{ asset($about['image_2']) }}" alt="">
                <a href="{{ $about['video_url'] }}" class="td_video_open">
                  <span class="td_player_btn td_center">
                    <span></span>
                  </span>
                </a>
              </div>
            </div>
            <div class="td_image_box_shape_1 position-absolute"></div>
            <div class="td_image_box_shape_2 position-absolute">
              <img src="{{ asset($about['shape_2']) }}" alt="">
            </div>
            <div class="td_image_box_shape_3 position-absolute td_accent_color">
              <img src="{{ asset($about['shape_3']) }}" alt="">
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.35s">
          <div class="td_section_heading td_style_1 td_mb_30">
            <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">About us</p>
            <h2 class="td_section_title td_fs_48 td_mb_20">Transform Cooking Expert Kitchen Coaching</h2>
            <p class="td_section_subtitle td_fs_18 mb-0 td_heading_color td_opacity_8">Far far away, behind the word mountains, far from the Consonantia, there live the blind texts. Separated they marks grove right at the coast of the Semantics a large language ocean</p>
          </div>
          <div class="td_mb_40">
            <ul class="td_list td_style_2 td_type_1 td_fs_24 td_medium td_heading_color td_mp_0">
              @foreach($about['list'] as $item)
                <li>
                  @include('svg.home-v8.about.check-icon')
                  {{ $item }}
                </li>
              @endforeach
            </ul>
          </div>
          <a href="{{ $about['button_url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $about['button_label'] }}</span>
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class="td_height_120 td_height_lg_80"></div>
  </div>
</section>
