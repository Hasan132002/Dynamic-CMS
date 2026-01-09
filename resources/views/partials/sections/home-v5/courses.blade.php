@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)

<section class="td_gray_bg_5 td_shape_section_10">

  <div class="td_shape_position_1 position-absolute">
    <img src="{{ asset($courses['shapes'][0]) }}" alt="">
  </div>
  <div class="td_shape_position_2 position-absolute">
    <img src="{{ asset($courses['shapes'][1]) }}" alt="">
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1
                td_mb_10 text-uppercase td_heading_color td_opacity_6">
        {{ $courses['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $courses['title'] !!}
      </h2>
      <p class="td_section_subtitle td_fs_18 mb-0">
        {!! $courses['description'] !!}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30 td_row_gap_30">

      @foreach($courses['items'] as $course)
        <div class="col-xl-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $course['delay'] }}">

          <div class="td_card td_style_5 td_type_2">

            <a href="{{ $course['url'] }}" class="td_card_thumb">
              <span class="td_card_thumb_in td_radius_10">
                <img src="{{ asset($course['image']) }}" alt="">
              </span>
              <img src="{{ asset($course['flag']) }}"
                   alt="" class="td_card_flag">
            </a>

            <div class="td_card_content">

              <ul class="td_card_meta td_mp_0 td_fs_16 td_heading_color">
                <li>
                  <img src="{{ asset($courses['icons']['user']) }}" alt="">
                  <span class="td_opacity_7">{{ $course['seats'] }}</span>
                </li>
                <li>
                  <img src="{{ asset($courses['icons']['book']) }}" alt="">
                  <span class="td_opacity_7">{{ $course['semesters'] }}</span>
                </li>
              </ul>

              <h2 class="td_card_title td_fs_24 td_semibold td_mb_20">
                <a href="{{ $course['url'] }}">{{ $course['title'] }}</a>
              </h2>

              <div class="td_card_price_wrap td_mb_20">
                <div class="td_card_review">
                  <div class="td_rating" data-rating="{{ $course['rating'] }}">
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <i class="fa-regular fa-star"></i>
                    <div class="td_rating_percentage">
                      <i class="fa-solid fa-star fa-fw"></i>
                      <i class="fa-solid fa-star fa-fw"></i>
                      <i class="fa-solid fa-star fa-fw"></i>
                      <i class="fa-solid fa-star fa-fw"></i>
                      <i class="fa-solid fa-star fa-fw"></i>
                    </div>
                  </div>
                  <span class="td_heading_color td_opacity_5 td_fs_14">
                    {{ $course['rating_text'] }}
                  </span>
                </div>
              </div>

              <div class="td_card_btns_wrap">
                <a href="{{ $course['url'] }}"
                   class="td_card_label td_fs_14 td_white_color td_accent_bg">
                  <img src="{{ asset($courses['icons']['calendar']) }}" alt="">
                  {{ $course['duration'] }}
                </a>
                <span class="td_fs_18 td_medium td_heading_color">
                  {{ $course['instructor'] }}
                </span>
              </div>

            </div>
          </div>
        </div>
      @endforeach

    </div>

    <div class="td_height_50 td_height_lg_40"></div>

    <div class="text-center wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.4s">
      <a href="{{ $courses['view_all']['url'] }}"
         class="td_btn td_style_3 td_medium td_heading_color td_fs_18">
        <span>{{ $courses['view_all']['label'] }}</span>
        <i>@include('svg.home-v5.courses.arrow')</i>
      </a>
    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
