@php($why = isset($why['data']) && is_array($why['data']) ? $why['data'] : $why)

<section class="td_gray_bg_6">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_40">
      <div class="col-lg-6 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_pr_20">
          <div class="td_section_heading td_style_1 td_mb_30">
            <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">
              {{ $why['subtitle'] }}
            </p>
            <h2 class="td_section_title td_fs_48 td_mb_24">
              {{ $why['title'] }}
            </h2>
            <p class="td_section_subtitle td_fs_18 mb-0">
              {{ $why['description'] }}
            </p>
          </div>

          <div class="td_mb_40">
            <ul class="td_list td_style_2 td_fs_20 td_medium td_heading_color td_mp_0">
              @foreach($why['list'] as $item)
                <li>
                  @include('svg.home-v7.why-choose-us.check')
                  {{ $item }}
                </li>
              @endforeach
            </ul>
          </div>

          <a href="{{ $why['button']['url'] }}"
             class="td_btn td_style_1 td_type_2 td_radius_30 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $why['button']['label'] }}</span>
              <span class="td_btn_icon td_center td_accent_bg td_white_color">
                @include('svg.home-v7.why-choose-us.arrow')
              </span>
            </span>
          </a>
        </div>
      </div>

      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="td_pl_65">
          <img src="{{ asset($why['image']) }}" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
