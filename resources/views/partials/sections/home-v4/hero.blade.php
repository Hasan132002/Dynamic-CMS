@php($hero = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : $hero)

<section class="td_hero td_style_4 td_center text-center td_hobble">
  <div class="container">
    <div class="td_hero_text wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.3s">

      <p class="td_hero_subtitle_up td_accent_color text-uppercase
                td_semibold td_fs_18 td_mb_10 td_opacity_9 td_spacing_1">
        {{ $hero['subtitle'] }}
      </p>

      <h1 class="td_hero_title td_fs_64 td_mb_20">
        {{ $hero['title'] }}
      </h1>

      <p class="td_hero_subtitle td_fs_18 td_heading_color
                text-capitalize td_mb_40">
        {{ $hero['description'] }}
      </p>

      <div class="td_btns_group">

        <a href="{{ $hero['button']['url'] }}"
           class="td_btn td_style_1 td_radius_30 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $hero['button']['label'] }}</span>
            @include('svg.home-v4.hero.hero-btn-arrow')
          </span>
        </a>

        <div class="td_avatars_wrap">
          <div class="td_avatars">
            <div><img src="{{ asset($hero['avatars'][0]) }}" alt=""></div>
            <div><img src="{{ asset($hero['avatars'][1]) }}" alt=""></div>
            <div><img src="{{ asset($hero['avatars'][2]) }}" alt=""></div>
            <div>
              <img src="{{ asset($hero['avatars'][3]) }}" alt="">
              <i class="fa-solid fa-plus"></i>
            </div>
          </div>
          <div>
            <h3 class="mb-0 td_fs_20 td_semibold">
              {{ $hero['students']['count'] }}
            </h3>
            <p class="mb-0 td_fs_18 td_opacity_6">
              {{ $hero['students']['label'] }}
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="td_hero_img_box_left">

    <div class="td_hero_img_1 position-absolute wow fadeInDown"
         data-wow-duration="1s" data-wow-delay="0.35s">
      <div class="td_hero_img_in">
        <img src="{{ asset($hero['images']['left'][0]) }}" alt="">
      </div>
    </div>

    <div class="td_hero_img_2 position-absolute wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.35s">
      <div class="td_hero_img_in">
        <img src="{{ asset($hero['images']['left'][1]) }}" alt="">
      </div>
    </div>

    <div class="td_hero_shape_1 position-absolute td_hover_layer_5">
      <img src="{{ asset($hero['shapes'][0]) }}" alt="">
    </div>
    <div class="td_hero_shape_2 position-absolute td_hover_layer_3">
      <img src="{{ asset($hero['shapes'][1]) }}" alt="">
    </div>
    <div class="td_hero_shape_5 position-absolute">
      <img src="{{ asset($hero['shapes'][4]) }}" alt="">
    </div>

  </div>

  <div class="td_hero_img_box_right">

    <div class="td_hero_img_3 position-absolute wow fadeInDown"
         data-wow-duration="1s" data-wow-delay="0.35s">
      <div class="td_hero_img_in">
        <img src="{{ asset($hero['images']['right'][0]) }}" alt="">
      </div>
    </div>

    <div class="td_hero_img_4 position-absolute wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.35s">
      <div class="td_hero_img_in">
        <img src="{{ asset($hero['images']['right'][1]) }}" alt="">
      </div>
    </div>

    <div class="td_hero_shape_3 position-absolute td_hover_layer_5">
      <img src="{{ asset($hero['shapes'][2]) }}" alt="">
    </div>
    <div class="td_hero_shape_4 position-absolute td_hover_layer_3">
      <img src="{{ asset($hero['shapes'][3]) }}" alt="">
    </div>

  </div>

  <div class="td_hero_shape_6 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes'][5]) }}" alt="">
  </div>
  <div class="td_hero_shape_7 position-absolute">
    <img src="{{ asset($hero['shapes'][6]) }}" alt="">
  </div>
  <div class="td_hero_shape_8 position-absolute td_hover_layer_3">
    <img src="{{ asset($hero['shapes'][7]) }}" alt="">
  </div>
  <div class="td_hero_shape_9 position-absolute">
    <img src="{{ asset($hero['shapes'][8]) }}" alt="">
  </div>
  <div class="td_hero_shape_10 position-absolute td_hover_layer_5">
    <img src="{{ asset($hero['shapes'][9]) }}" alt="">
  </div>

</section>
