@php($pricing = isset($pricing['data']) && is_array($pricing['data']) ? $pricing['data'] : $pricing)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1
                td_mb_10 text-uppercase td_heading_color td_opacity_6">
        {{ $pricing['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $pricing['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.35s">

      @foreach($pricing['plans'] as $plan)
        <div class="col-lg-4">
          <div class="td_pricing td_style_1 td_type_1 td_radius_10">

            <h2 class="td_pricing_package_name td_fs_24">
              {{ $plan['name'] }}
            </h2>

            <p class="td_heading_color td_opacity_8 td_mb_20">
              {{ $plan['description'] }}
            </p>

            <div class="td_pricing_in">
              <h2 class="td_fs_64 td_mb_20 td_accent_color">
                ${{ $plan['price'] }}
                <span class="td_fs_16 td_medium td_heading_color">
                  {{ $plan['duration'] }}
                </span>
              </h2>

              <h3 class="td_pricing_title td_fs_32 td_mb_20">
                {{ $plan['features_title'] }}
              </h3>

              <ul class="td_pricing_feature td_mp_0 td_medium td_heading_color">
                @foreach($plan['features'] as $feature)
                  <li>
                    <i class="fa-solid fa-check"></i>
                    {{ $feature }}
                  </li>
                @endforeach
              </ul>

              <div class="text-center">
                <a href="{{ $plan['button']['url'] }}"
                   class="td_btn td_style_1 td_radius_10 td_medium w-100">
                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ $plan['button']['label'] }}</span>
                    @include('svg.home-v5.header.btn-arrow')
                  </span>
                </a>
              </div>

            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
