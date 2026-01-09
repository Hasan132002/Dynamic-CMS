@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)

<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $courses['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">{!! $courses['title'] !!}</h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">
      @foreach($courses['items'] as $item)
        <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ $item['delay'] }}">
          <div class="td_card td_style_3 td_type_3 d-block td_accent_bg">
            <a href="{{ $item['url'] }}" class="td_card_thumb">
              <img src="{{ asset($item['image']) }}" alt="">
              <span class="td_card_lable td_accent_bg td_white_color td_fs_14 td_medium td_radius_10">
                {{ $item['label'] }}
              </span>
            </a>

            <ul class="td_card_meta td_mp_0 td_fs_16 td_heading_color td_white_bg">
              <li>
                <img src="{{ asset($courses['icons']['user']) }}" alt="">
                <span class="td_opacity_7">{{ $item['seats'] }}</span>
              </li>
              <li>
                <img src="{{ asset($courses['icons']['cloud']) }}" alt="">
                <span class="td_opacity_7">{{ $item['shift'] }}</span>
              </li>
            </ul>

            <div class="td_card_info">
              <div class="td_card_info_in">
                <h2 class="td_card_title td_fs_24 td_white_color td_mb_16">
                  <a href="{{ $item['url'] }}">{{ $item['course_title'] }}</a>
                </h2>
                <p class="td_card_subtitle td_white_color td_opacity_7 td_mb_25">
                  {{ $item['description'] }}
                </p>

                <div class="td_card_enroll">
                  <a href="{{ $item['enroll_url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
                    <span class="td_btn_in td_accent_color td_white_bg">
                      <span>{{ $item['enroll_label'] }}</span>
                    </span>
                  </a>

                  <div class="td_card_review td_fs_14">
                    <div class="td_rating" data-rating="5">
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
                    <span class="td_white_color td_opacity_5">{{ $item['rating'] }}</span>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="text-center">
      <a href="{{ $courses['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $courses['button']['label'] }}</span>
          @include('svg.home-v8.courses.arrow-icon')
        </span>
      </a>
    </div>

  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
