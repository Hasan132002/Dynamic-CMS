@php($hero = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : $hero)

<section class="td_hero td_style_6 td_hobble">
  <div class="container">
    <div class="row td_gap_y_50">

      <div class="col-lg-6 td_center wow fadeInLeft"
           data-wow-duration="1s"
           data-wow-delay="0.35s">
        <div class="td_hero_text">
          <p class="td_hero_subtitle_up td_fs_18 td_accent_color
                    td_spacing_1 td_medium td_mb_20">
            {{ $hero['subtitle'] }}
          </p>
          <h1 class="td_hero_title td_fs_64 td_mb_24">
            {{ $hero['title'] }}
          </h1>
          <p class="td_hero_subtitle td_fs_18 td_heading_color
                    td_opacity_8 td_mb_30">
            {{ $hero['description'] }}
          </p>
          <a href="{{ $hero['button']['url'] }}"
             class="td_btn td_style_1 td_medium td_with_shadow_2">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $hero['button']['label'] }}</span>
            </span>
          </a>
        </div>
      </div>

      <div class="col-lg-6 wow fadeIn"
           data-wow-duration="1s"
           data-wow-delay="0.3s">
        <div class="td_hero_img">

          <img src="{{ asset($hero['main_image']) }}" alt="">

          <div class="td_hero_video_block">
            <img src="{{ asset($hero['video_image']) }}" alt="">
            <a href="{{ $hero['video_url'] }}"
               class="td_video_open td_medium td_heading_color">
              <span class="td_player_btn td_center">
                <span></span>
              </span>
            </a>
          </div>

          <div class="td_avatars_wrap td_type_1 td_hover_layer_3">
            <div class="td_avatars">
              @foreach($hero['avatars'] as $avatar)
                <div>
                  <img src="{{ asset($avatar['image']) }}" alt="">
                  @if(isset($avatar['plus']) && $avatar['plus'])
                    <i class="fa-solid fa-plus"></i>
                  @endif
                </div>
              @endforeach
            </div>
            <div>
              <p class="mb-0 td_fs_14 td_semibold">
                {{ $hero['students']['count'] }}
              </p>
              <p class="mb-0 td_fs_12 td_opacity_6">
                {{ $hero['students']['label'] }}
              </p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

  @foreach($hero['shapes'] as $shape)
    <div class="{{ $shape['class'] }}">
      <img src="{{ asset($shape['image']) }}" alt="">
    </div>
  @endforeach

</section>
