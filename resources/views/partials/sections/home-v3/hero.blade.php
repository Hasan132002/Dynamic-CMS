@php($hero = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : $hero)

<section class="td_hero td_style_3 td_center td_hobble">

  <div class="container">
    <div class="td_hero_text wow fadeInDown"
         data-wow-duration="1s"
         data-wow-delay="0.5s">

      <p class="td_hero_subtitle_up td_fs_18 td_accent_color
                td_spacing_1 td_semibold text-uppercase td_mb_14">
        {{ $hero['subtitle_up'] }}
      </p>

      <h1 class="td_hero_title td_fs_64 td_mb_20">
        {{ $hero['title'] }}
      </h1>

      <p class="td_hero_subtitle td_fs_18 td_heading_color
                td_opacity_7 td_mb_30">
        {{ $hero['subtitle'] }}
      </p>

      <div class="td_btns_group">

        <a href="{{ $hero['primary_cta']['url'] }}"
           class="td_btn td_style_1 td_radius_30 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $hero['primary_cta']['text'] }}</span>
            @include('svg.home-v3.hero.arrow')
          </span>
        </a>

        <a href="{{ $hero['video']['url'] }}"
           class="td_player_btn_wrap td_video_open td_medium td_heading_color">
          <span class="td_player_btn td_center">
            <span></span>
          </span>
          <span class="td_play_btn_text">
            {{ $hero['video']['text'] }}
          </span>
        </a>

      </div>
    </div>
  </div>

  <div class="td_hero_img_box">
    <img src="{{ asset($hero['images']['main']) }}"
         alt=""
         class="td_hero_img_1 wow fadeInRight"
         data-wow-duration="1s"
         data-wow-delay="0.3s">

    <div class="td_hero_shape_1 td_hover_layer_3 wow fadeIn"
         data-wow-duration="1s"
         data-wow-delay="0.8s"></div>

    <div class="td_hero_shape_2">
      <img src="{{ asset($hero['images']['shape_1']) }}"
           alt=""
           class="td_hover_layer_5">
    </div>
  </div>

  <div class="td_hero_shape_3 td_hover_layer_3"></div>

  <div class="td_hero_shape_4">
    <img src="{{ asset($hero['images']['shape_2']) }}" alt="">
  </div>

  <div class="td_hero_shape_5">
    <img src="{{ asset($hero['images']['shape_3']) }}" alt="">
  </div>

  <div class="td_hero_shape_6 td_hover_layer_3">
    <img src="{{ asset($hero['images']['shape_4']) }}" alt="">
  </div>

  <div class="td_hero_shape_7 td_hover_layer_5"></div>

</section>
