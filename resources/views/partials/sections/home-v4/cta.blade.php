@php($cta = isset($cta['data']) && is_array($cta['data']) ? $cta['data'] : $cta)

<section class="td_cta td_style_2 td_accent_bg td_hobble">

  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">
    <div class="td_cta_in wow fadeIn"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <div class="td_section_heading td_style_1">

        <p class="td_section_subtitle_up td_fs_18 td_semibold
                  td_spacing_1 td_mb_10 text-uppercase
                  td_heading_color">
          {{ $cta['subtitle'] }}
        </p>

        <h2 class="td_section_title td_fs_48 td_mb_20 td_white_color">
          {{ $cta['title'] }}
        </h2>

        <p class="td_section_subtitle td_fs_18 td_mb_28
                  td_white_color td_opacity_9">
          {{ $cta['description'] }}
        </p>

        <a href="{{ $cta['button']['url'] }}"
           class="td_btn td_style_1 td_radius_30 td_medium">
          <span class="td_btn_in td_heading_color td_white_bg">
            <span>{{ $cta['button']['label'] }}</span>
          </span>
        </a>

      </div>
    </div>
  </div>

  <img class="td_cta_img wow fadeInRight"
       data-wow-duration="1s"
       data-wow-delay="0.3s"
       src="{{ asset($cta['image']) }}" alt="">

  <div class="position-absolute td_cta_shape_1 td_hover_layer_3">
    <img src="{{ asset($cta['shapes'][0]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_2 td_hover_layer_5">
    <img src="{{ asset($cta['shapes'][1]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_3">
    <img src="{{ asset($cta['shapes'][2]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_4 td_hover_layer_5">
    <img src="{{ asset($cta['shapes'][3]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_5">
    <img src="{{ asset($cta['shapes'][4]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_6 td_hover_layer_3">
    <img src="{{ asset($cta['shapes'][5]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_7">
    <img src="{{ asset($cta['shapes'][6]) }}" alt="">
  </div>
  <div class="position-absolute td_cta_shape_8 td_hover_layer_5">
    <img src="{{ asset($cta['shapes'][7]) }}" alt="">
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

</section>
