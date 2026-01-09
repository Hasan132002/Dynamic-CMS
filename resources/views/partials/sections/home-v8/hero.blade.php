@php($hero = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : $hero)

<section class="td_hero td_style_8 td_center td_accent_bg td_hobble">
  <div class="container">

    <div class="td_hero_img wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
      <img src="{{ asset($hero['image']) }}" alt="">
    </div>

    <div class="td_hero_text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.35s">
      <p class="td_hero_subtitle_up td_fs_18 td_white_color text-uppercase td_spacing_1 td_semibold td_mb_10">
        {{ $hero['subtitle'] }}
      </p>

      <h1 class="td_hero_title td_white_color td_fs_64 td_mb_24">
        {{ $hero['title'] }}
      </h1>

      <p class="td_hero_subtitle td_fs_18 td_white_color td_opacity_7 td_mb_30">
        {{ $hero['description'] }}
      </p>

      <div class="td_btns_group">
        <a href="{{ $hero['primary_button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
          <span class="td_btn_in td_heading_color td_white_bg">
            <span>{{ $hero['primary_button']['label'] }}</span>
          </span>
        </a>

        <a href="{{ $hero['video']['url'] }}"
           class="td_player_btn_wrap td_color_1 td_video_open td_medium td_white_color">
          <span class="td_player_btn td_center">
            <span></span>
          </span>
          <span class="td_play_btn_text">{{ $hero['video']['label'] }}</span>
        </a>
      </div>
    </div>

  </div>

  <div class="td_hero_shape_1 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes']['shape_1']) }}" alt="">
  </div>
  <div class="td_hero_shape_2 position-absolute td_hover_layer_5">
    <img src="{{ asset($hero['shapes']['shape_2']) }}" alt="">
  </div>
  <div class="td_hero_shape_3 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes']['shape_3']) }}" alt="">
  </div>
  <div class="td_hero_shape_4 position-absolute td_hover_layer_5">
    <img src="{{ asset($hero['shapes']['shape_4']) }}" alt="">
  </div>
  <div class="td_hero_shape_5 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes']['shape_5']) }}" alt="">
  </div>
  <div class="td_hero_shape_6 position-absolute td_hover_layer_5">
    <img src="{{ asset($hero['shapes']['shape_6']) }}" alt="">
  </div>
  <div class="td_hero_shape_7 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes']['shape_7']) }}" alt="">
  </div>
  <div class="td_hero_shape_8 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes']['shape_8']) }}" alt="">
  </div>
  <div class="td_hero_shape_9 position-absolute td_hover_layer_5">
    <img src="{{ asset($hero['shapes']['shape_9']) }}" alt="">
  </div>
</section>
