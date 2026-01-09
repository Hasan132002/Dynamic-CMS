@php($pricing = isset($pricing['data']) && is_array($pricing['data']) ? $pricing['data'] : $pricing)

<section>
  <div class="td_height_{{ $pricing['spacing']['top'] }}
              td_height_lg_{{ $pricing['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="td_tabs td_style_1">

      {{-- HEADING --}}
      <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
           data-wow-duration="1s"
           data-wow-delay="0.2s">
        <div class="td_section_heading_left">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10
                    text-uppercase td_heading_color td_opacity_9">
            {{ $pricing['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 mb-0">
            {!! $pricing['title'] !!}
          </h2>
        </div>

        <div class="td_section_heading_right td_pricing_switch">
          <ul class="td_tab_links td_pricing_control td_fs_24 td_semibold td_center td_mp_0">
            @foreach($pricing['tabs'] as $index => $tab)
              <li class="{{ $index === 0 ? 'active' : '' }}">
                <a href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
                @if($index === 0)
                  <span class="td_switch"></span>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="td_height_50 td_height_lg_50"></div>

      {{-- TAB BODY --}}
      <div class="td_tab_body wow fadeInUp"
           data-wow-duration="1s"
           data-wow-delay="0.35s">

        @foreach($pricing['plans'] as $tabIndex => $tab)
          <div class="td_tab {{ $tabIndex === 0 ? 'active' : '' }}"
               id="{{ $tab['id'] }}">

            <div class="row td_gap_y_30">
              @foreach($tab['items'] as $plan)
                <div class="col-lg-4">
                  <div class="td_pricing td_style_1 td_radius_10">

                    <h2 class="td_pricing_package_name td_fs_24 td_medium td_accent_bg td_white_color mb-0">
                      {{ $plan['name'] }}
                    </h2>

                    <div class="td_pricing_icon td_center">
                      <img src="{{ asset($plan['icon']) }}" alt="">
                    </div>

                    <div class="td_pricing_in">
                      <h2 class="td_fs_64 td_mb_20">
                        {{ $plan['price'] }}
                        <span class="td_fs_16 td_medium">{{ $plan['duration'] }}</span>
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
                        <a href="{{ $plan['cta']['url'] }}"
                           class="td_btn td_style_1 td_radius_30 td_medium w-100">
                          <span class="td_btn_in td_white_color td_accent_bg">
                            <span>{{ $plan['cta']['text'] }}</span>
                            @include('svg.home-v3.pricing.arrow')
                          </span>
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
              @endforeach
            </div>

          </div>
        @endforeach

      </div>
    </div>
  </div>

  <div class="td_height_{{ $pricing['spacing']['bottom'] }}
              td_height_lg_{{ $pricing['spacing']['bottom_lg'] }}"></div>
</section>
