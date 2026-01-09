@php($hero = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : $hero)

<section class="td_hero td_style_5 td_center td_hobble">

  <div class="container">
    <div class="td_hero_text wow fadeInRight"
         data-wow-duration="1s"
         data-wow-delay="0.4s">

      <p class="td_hero_subtitle_up td_fs_18 text-uppercase
                td_spacing_1 td_medium td_mb_20">
        {{ $hero['subtitle'] }}
      </p>

      <h1 class="td_hero_title td_fs_52 td_mb_30">
        {{ $hero['title'] }}
      </h1>

      <p class="td_hero_subtitle td_fs_18 td_heading_color
                td_opacity_8 td_mb_40">
        {{ $hero['description'] }}
      </p>

      <div class="td_newsletter td_style_1">
        <form action="{{ $hero['search']['action'] }}"
              class="td_newsletter_form">
          <input type="email"
                 class="td_newsletter_input"
                 placeholder="{{ $hero['search']['placeholder'] }}">

          <button type="submit"
                  class="td_btn td_style_1 td_radius_10 td_medium td_fs_18">
            <span class="td_btn_in td_white_color td_accent_bg">
              @include('svg.home-v5.hero.search-icon')
              <span>{{ $hero['search']['button'] }}</span>
            </span>
          </button>
        </form>
      </div>

    </div>
  </div>

  <div class="td_hero_img_wrap wow fadeIn"
       data-wow-duration="1s"
       data-wow-delay="0.3s">

    <div class="td_hero_img">
      <img src="{{ asset($hero['images'][0]) }}" alt="">
    </div>

    <div class="td_hero_img_1 position-absolute td_hover_layer_3">
      <img src="{{ asset($hero['images'][1]) }}" alt="">
    </div>

    <div class="td_hero_img_2 position-absolute td_hover_layer_3">
      <img src="{{ asset($hero['images'][2]) }}" alt="">
    </div>

    <div class="td_hero_img_3 position-absolute td_hover_layer_5">
      <img src="{{ asset($hero['images'][3]) }}" alt="">
    </div>

    <div class="td_avatars_wrap td_type_1 td_hover_layer_5">
      <div class="td_avatars">
        @foreach($hero['avatars'] as $avatar)
          <div><img src="{{ asset($avatar) }}" alt=""></div>
        @endforeach
        <div>
          <img src="{{ asset($hero['avatars'][2]) }}" alt="">
          <i class="fa-solid fa-plus"></i>
        </div>
      </div>
      <div>
        <p class="mb-0 td_fs_14 td_semibold td_heading_color">
          {{ $hero['students']['count'] }}
        </p>
        <p class="mb-0 td_fs_12 td_opacity_6">
          {{ $hero['students']['label'] }}
        </p>
      </div>
    </div>

    <div class="td_hero_funfact td_hover_layer_5">
      <img src="{{ asset($hero['active']['icon']) }}" alt="">
      <div>
        <p class="td_fs_40 td_bold td_heading_color">
          {{ $hero['active']['count'] }}
        </p>
        <p class="td_mb_5 td_heading_color td_opacity_5 td_fs_12">
          {{ $hero['active']['label'] }}
        </p>
      </div>
    </div>

    <div class="td_hero_shape_1 td_accent_color position-absolute">
      {!! $hero['shape_svg'] !!}
    </div>

  </div>

  <div class="td_hero_shape_2 position-absolute td_hover_layer_3"></div>
  <div class="td_hero_shape_3 position-absolute td_hover_layer_5"></div>
  <div class="td_hero_shape_4 position-absolute td_hover_layer_3"></div>

  <div class="td_hero_shape_5 position-absolute td_hover_layer_5">
    <img src="{{ asset($hero['shape_image']) }}" alt="">
  </div>

</section>
