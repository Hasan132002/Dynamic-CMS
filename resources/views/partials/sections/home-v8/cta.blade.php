@php($cta = isset($cta['data']) && is_array($cta['data']) ? $cta['data'] : $cta)

<section class="td_cta td_style_4 text-center position-relative td_hobble">
  <div class="td_height_120 td_height_lg_70"></div>

  <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
    <h2 class="td_fs_48 td_mb_30">{!! $cta['title'] !!}</h2>
    <p class="td_fs_18 td_heading_color td_opacity_7 td_mb_40">{!! $cta['description'] !!}</p>

    <a href="{{ $cta['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
      <span class="td_btn_in td_white_color td_accent_bg">
        <span>{{ $cta['button']['label'] }}</span>
        @include('svg.home-v8.cta.arrow-icon')
      </span>
    </a>
  </div>

  <div class="td_cta_shape_1 position-absolute td_hover_layer_3">
    <img src="{{ asset($cta['shapes']['shape_1']) }}" alt="">
  </div>
  <div class="td_cta_shape_2 position-absolute td_hover_layer_5">
    <img src="{{ asset($cta['shapes']['shape_2']) }}" alt="">
  </div>
  <div class="td_cta_shape_3 position-absolute td_hover_layer_3">
    <img src="{{ asset($cta['shapes']['shape_3']) }}" alt="">
  </div>
  <div class="td_cta_shape_4 position-absolute">
    <img src="{{ asset($cta['shapes']['shape_4']) }}" alt="">
  </div>
  <div class="td_cta_shape_5 position-absolute td_hover_layer_3"></div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
