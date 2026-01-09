@php($cta = isset($cta['data']) && is_array($cta['data']) ? $cta['data'] : $cta)

<section class="td_cta td_style_3 td_accent_bg">

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_40">

      <div class="col-lg-6 wow fadeInLeft"
           data-wow-duration="1s"
           data-wow-delay="0.3s">
        <div class="td_cta_img">
          <img src="{{ asset($cta['image']) }}" alt="">
        </div>
      </div>

      <div class="col-lg-6 wow fadeIn"
           data-wow-duration="1s"
           data-wow-delay="0.2s">
        <div class="td_cta_in">

          <h2 class="td_fs_48 td_white_color td_mb_25">
            {{ $cta['title'] }}
          </h2>

          <p class="td_mb_30 td_white_color td_opacity_7 td_fs_18">
            {{ $cta['description'] }}
          </p>

          <a href="{{ $cta['button']['url'] }}"
             class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_accent_color td_white_bg">
              <span>{{ $cta['button']['label'] }}</span>
              @include('svg.home-v5.cta.btn-arrow')
            </span>
          </a>

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
