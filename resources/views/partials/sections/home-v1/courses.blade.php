@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)
<section class="td_gray_bg_3">
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.15s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $courses['section']['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $courses['section']['title'] }}
      </h2>
    </div>

    <div class="td_height_30 td_height_lg_30"></div>

    <div class="td_tabs">
      <ul class="td_tab_links td_style_1 td_mp_0 td_fs_20 td_medium td_heading_color wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
        @foreach($courses['tabs'] as $tab)
          <li class="{{ $tab['active'] ?? false ? 'active' : '' }}">
            <a href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
          </li>
        @endforeach
      </ul>

      <div class="td_height_50 td_height_lg_50"></div>

      <div class="td_tab_body">
        @foreach($courses['tabs'] as $tab)
          @php($tabCourses = $tab['courses'] === 'SAME_AS_TAB_1' ? $courses['tabs'][0]['courses'] : $tab['courses'])
          <div class="td_tab {{ $tab['active'] ?? false ? 'active' : '' }}" id="{{ $tab['id'] }}">
            <div class="row td_gap_y_24">
              @foreach($tabCourses as $course)
                <div class="col-lg-4 col-md-6 wow fadeInUp">
                  <div class="td_card td_style_3 d-block td_radius_10">
                    <a href="{{ $course['title_url'] }}" class="td_card_thumb">
                      <img src="{{ asset($course['thumb']) }}" alt="">
                    </a>
                    <div class="td_card_info td_white_bg">
                      <div class="td_card_info_in">
                        <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                          <li>
                            <img src="{{ asset('assets/img/icons/user_3.svg') }}" alt="">
                            <span class="td_opacity_7">{{ $course['seats'] }}</span>
                          </li>
                          <li>
                            <img src="{{ asset('assets/img/icons/book.svg') }}" alt="">
                            <span class="td_opacity_7">{{ $course['semester'] }}</span>
                          </li>
                        </ul>

                        <a href="{{ $course['category_url'] }}" class="td_card_category td_fs_14 td_bold td_heading_color td_mb_14">
                          <span>{{ $course['category'] }}</span>
                        </a>

                        <h2 class="td_card_title td_fs_24 td_mb_16">
                          <a href="{{ $course['title_url'] }}">{{ $course['title'] }}</a>
                        </h2>

                        <p class="td_card_subtitle td_heading_color td_opacity_7 td_mb_20">
                          {{ $course['description'] }}
                        </p>

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
                          <span class="td_heading_color td_opacity_5 td_medium">{{ $course['rating_text'] }}</span>
                        </div>

                        <div class="td_card_btn">
                          <a href="{{ $course['title_url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
                            <span class="td_btn_in td_white_color td_accent_bg">
                              <span>Enroll Now</span>
                            </span>
                          </a>
                        </div>

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
  <div class="td_height_120 td_height_lg_80"></div>
</section>
