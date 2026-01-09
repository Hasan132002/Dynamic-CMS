@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)

<section class="td_gray_bg_4">

  <div class="td_height_{{ $courses['spacing']['top'] }}
              td_height_lg_{{ $courses['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="td_tabs td_style_1">

      {{-- HEADING --}}
      <div class="td_section_heading td_style_1 td_type_2 td_with_tab_menu wow fadeInUp"
           data-wow-duration="1s"
           data-wow-delay="{{ $courses['heading']['delay'] }}s">

        <div class="td_section_heading_left">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
            <i></i>{{ $courses['heading']['subtitle'] }}<i></i>
          </p>
          <h2 class="td_section_title td_fs_48 mb-0">
            {!! nl2br(e($courses['heading']['title'])) !!}
          </h2>
        </div>

        <div class="td_section_heading_right">
          <ul class="td_tab_links td_style_2 td_mp_0 td_medium td_fs_20 td_heading_color">
            @foreach($courses['tabs'] as $tab)
              <li class="{{ !empty($tab['active']) ? 'active' : '' }}">
                <a href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="td_height_50 td_height_lg_50"></div>

      {{-- TAB CONTENT --}}
      <div class="td_tab_body">
        @foreach($courses['tabs'] as $tab)
          <div class="td_tab {{ !empty($tab['active']) ? 'active' : '' }}"
               id="{{ $tab['id'] }}">

            <div class="row td_gap_y_30 td_row_gap_30">

              @foreach($tab['courses'] as $course)
                <div class="col-xl-6 wow fadeInUp"
                     data-wow-duration="1s"
                     data-wow-delay="{{ $course['delay'] }}s">

                  <div class="td_card td_style_5 td_type_1">

                    <a href="{{ $course['url'] }}" class="td_card_thumb">
                      <span class="td_card_thumb_in">
                        <img src="{{ asset($course['image']) }}" alt="">
                        @if(!empty($course['badge']))
                          <span class="td_card_label td_fs_14 td_white_color td_accent_bg">
                            {{ $course['badge'] }}
                          </span>
                        @endif
                      </span>
                    </a>

                    <div class="td_card_content">

                      <ul class="td_card_meta td_mp_0 td_fs_16 td_heading_color">
                        <li>
                          <img src="{{ asset($courses['icons']['seats']) }}">
                          <span class="td_opacity_7">{{ $course['seats'] }}</span>
                        </li>
                        <li>
                          <img src="{{ asset($courses['icons']['semesters']) }}">
                          <span class="td_opacity_7">{{ $course['semesters'] }}</span>
                        </li>
                      </ul>

                      <h2 class="td_card_title td_fs_24 td_semibold td_mb_12">
                        <a href="{{ $course['url'] }}">{{ $course['title'] }}</a>
                      </h2>

                      {{-- REVIEWS --}}
                      <div class="td_card_price_wrap td_mb_12">
                        <div class="td_card_review">
                          <div class="td_rating" data-rating="{{ $course['rating'] }}">
                            @for($i=1;$i<=5;$i++)
                              <i class="{{ $courses['icons']['star_empty'] }}"></i>
                            @endfor
                            <div class="td_rating_percentage">
                              @for($i=1;$i<=5;$i++)
                                <i class="{{ $courses['icons']['star_filled'] }}"></i>
                              @endfor
                            </div>
                          </div>
                          <span class="td_heading_color td_opacity_5 td_fs_14">
                            {{ $course['rating_text'] }}
                          </span>
                        </div>

                        <span class="td_card_price td_accent_bg td_white_color td_fs_18 td_medium">
                          {{ $course['price'] }}
                        </span>
                      </div>

                      <div class="td_card_btns_wrap">
                        <a href="{{ $course['url'] }}"
                           class="td_btn td_style_1 td_type_3 td_radius_30 td_medium td_fs_14">
                          <span class="td_btn_in td_accent_color">
                            <span>Enroll Now</span>
                          </span>
                        </a>
                        <span class="td_fs_18 td_medium td_heading_color">
                          {{ $course['teacher'] }}
                        </span>
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

  <div class="td_height_{{ $courses['spacing']['bottom'] }}
              td_height_lg_{{ $courses['spacing']['bottom_lg'] }}"></div>

</section>
