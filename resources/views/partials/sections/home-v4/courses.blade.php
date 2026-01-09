@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)

<section class="td_gray_bg_7 td_shape_section_3">

  <div class="td_shape td_shape_position_1">
    <img src="{{ asset($courses['shapes'][0]) }}" alt="">
  </div>
  <div class="td_shape td_shape_position_2">
    <img src="{{ asset($courses['shapes'][1]) }}" alt="">
  </div>
  <div class="td_shape td_shape_position_3">
    <img src="{{ asset($courses['shapes'][2]) }}" alt="">
  </div>
  <div class="td_shape td_shape_position_4"></div>

  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1
                td_mb_10 text-uppercase td_accent_color">
        {{ $courses['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $courses['title'] }}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">

      @foreach($courses['items'] as $course)
        <div class="col-lg-4 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $course['delay'] }}">

          <div class="td_card td_style_3 td_type_1 d-block td_radius_10">

            <a href="{{ $course['details_url'] }}"
               class="td_card_thumb">
              <img src="{{ asset($course['image']) }}" alt="">
            </a>

            <div class="td_card_info">
              <div class="td_card_info_in">

                <a href="{{ $course['category_url'] }}"
                   class="td_card_category td_fs_14 td_semibold
                          td_heading_color td_mb_14">
                  <span>{{ $course['category'] }}</span>
                </a>

                <h2 class="td_card_title td_fs_24 td_mb_16">
                  <a href="{{ $course['details_url'] }}">
                    {{ $course['title'] }}
                  </a>
                </h2>

                <p class="td_card_subtitle td_heading_color
                          td_opacity_7 td_mb_20">
                  {{ $course['description'] }}
                </p>

                <ul class="td_card_meta td_mp_0 td_fs_18
                           td_medium td_heading_color">
                  <li>
                    <img src="{{ asset($courses['icons']['user']) }}" alt="">
                    <span class="td_opacity_7">{{ $course['seats'] }}</span>
                  </li>
                  <li>
                    <img src="{{ asset($courses['icons']['book']) }}" alt="">
                    <span class="td_opacity_7">{{ $course['semesters'] }}</span>
                  </li>
                </ul>

                <div class="td_card_btn">
                  <a href="{{ $course['enroll_url'] }}"
                     class="td_btn td_style_1 td_radius_30 td_medium">
                    <span class="td_btn_in td_white_color td_accent_bg">
                      <span>Enroll Now</span>
                      @include('svg.home-v4.courses.enroll-arrow')
                    </span>
                  </a>
                </div>

              </div>
            </div>

          </div>
        </div>
      @endforeach

    </div>

    <div class="td_height_50 td_height_lg_40"></div>

    <div class="text-center wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.3s">
      <a href="{{ $courses['view_all']['url'] }}"
         class="td_btn td_style_3 td_medium td_heading_color td_fs_18">
        <span>{{ $courses['view_all']['label'] }}</span>
        <i>@include('svg.home-v4.courses.view-all-arrow')</i>
      </a>
    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
