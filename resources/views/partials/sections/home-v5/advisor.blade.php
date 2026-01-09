@php($advisors = isset($advisors['data']) && is_array($advisors['data']) ? $advisors['data'] : $advisors)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="td_slider td_style_1 td_slider_gap_24">

      <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="td_section_heading_left">
          <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1
                    td_mb_10 text-uppercase td_heading_color td_opacity_6">
            {{ $advisors['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 mb-0">
            {!! $advisors['title'] !!}
          </h2>
        </div>

        <div class="td_section_heading_right">
          <div class="td_slider_arrows td_style_1 td_type_1">
            <div class="td_left_arrow td_accent_bg td_radius_10 td_center td_white_color">
              @include('svg.home-v5.advisors.arrow-left')
            </div>
            <div class="td_right_arrow td_accent_bg td_radius_10 td_center td_white_color">
              @include('svg.home-v5.advisors.arrow-right')
            </div>
          </div>
        </div>

      </div>

      <div class="td_height_50 td_height_lg_50"></div>

      <div class="td_slider_container wow fadeInUp"
           data-wow-duration="1s"
           data-wow-delay="0.3s"
           data-autoplay="0"
           data-loop="1"
           data-speed="800"
           data-center="0"
           data-variable-width="0"
           data-slides-per-view="responsive"
           data-xs-slides="1"
           data-sm-slides="2"
           data-md-slides="3"
           data-lg-slides="3"
           data-add-slides="4">

        <div class="td_slider_wrapper">

          @foreach($advisors['items'] as $item)
            <div class="td_slide">
              <div class="td_team td_style_4">

                <a href="{{ $item['url'] }}"
                   class="td_team_thumb d-block td_radius_10
                          td_mb_16 overflow-hidden">
                  <img src="{{ asset($item['image']) }}"
                       alt=""
                       class="w-100">
                </a>

                <div class="td_team_info">
                  <div class="td_team_info_in">
                    <h3 class="td_team_member_title td_fs_20 td_semibold mb-0">
                      <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                    </h3>
                    <p class="td_team_member_designation mb-0 td_fs_14
                              td_opacity_6 td_heading_color">
                      {{ $item['designation'] }}
                    </p>
                  </div>

                  <div class="td_team_social_list td_fs_14 td_accent_color">
                    @foreach($item['socials'] as $social)
                      <a href="{{ $social['url'] }}">
                        <i class="{{ $social['icon'] }}"></i>
                      </a>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          @endforeach

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
