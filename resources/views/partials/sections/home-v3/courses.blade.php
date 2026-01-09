@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)

<section>
  <div class="td_height_{{ $courses['spacing']['top'] }}
              td_height_lg_{{ $courses['spacing']['top_lg'] }}"></div>

  <div class="container">

    {{-- SECTION HEADING --}}
    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
         data-wow-duration="1s" data-wow-delay="0.2s">

      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
          {{ $courses['heading']['subtitle'] }}
        </p>
        <h2 class="td_section_title td_fs_48 mb-0">
          {!! nl2br(e($courses['heading']['title'])) !!}
        </h2>
      </div>

      <div class="td_section_heading_right">
        <p class="td_section_subtitle td_fs_18 td_mb_16 td_heading_color td_opacity_9">
          {{ $courses['heading']['description'] }}
        </p>

        <a href="{{ $courses['button']['url'] }}"
           class="td_btn td_style_2 td_heading_color td_medium td_mb_10">
          {{ $courses['button']['text'] }}
          <i>
            @include('svg.home-v3.courses.arrow-right')
            @include('svg.home-v3.courses.arrow-right')
          </i>
        </a>
      </div>
    </div>

    <div class="td_height_40 td_height_lg_40"></div>

    {{-- TABS --}}
    <div class="td_tabs td_style_1">

      {{-- TAB LINKS --}}
      <ul class="td_tab_links td_style_2 td_type_1 td_mp_0 td_medium td_fs_20 td_heading_color wow fadeInUp"
          data-wow-duration="1s" data-wow-delay="0.25s">

        @foreach($courses['tabs'] as $tab)
          <li class="{{ $loop->first ? 'active' : '' }}">
            <a href="#{{ $tab['id'] }}">{{ $tab['title'] }}</a>
          </li>
        @endforeach

      </ul>

      <div class="td_height_40 td_height_lg_40"></div>

      {{-- TAB CONTENT --}}
      <div class="td_tab_body">

        @foreach($courses['tabs'] as $tab)

          <div class="td_tab {{ $loop->first ? 'active' : '' }}"
               id="{{ $tab['id'] }}">

            @if(!empty($tab['coming_soon']))
              <div class="td_tab_comming_soon td_center td_fs_24 td_semibold td_heading_color">
                Comming Soon...
              </div>
            @else

              <div class="row td_gap_y_30 td_row_gap_30">

                @foreach($tab['courses'] as $course)
                  <div class="col-xl-6 wow fadeInUp"
                       data-wow-duration="1s"
                       data-wow-delay="{{ 0.3 + ($loop->index * 0.05) }}s">

                    <div class="td_card td_style_5">

                      <a href="{{ $course['url'] }}" class="td_card_thumb">
                        <span class="td_card_thumb_in td_radius_10">
                          <img src="{{ asset($course['image']) }}" alt="">
                          <span class="td_card_label td_fs_14 td_white_color td_accent_bg">
                            <img src="{{ asset('assets/img/icons/calendar_2.svg') }}" alt="">
                            {{ $course['duration'] }}
                          </span>
                        </span>
                      </a>

                      <div class="td_card_content">

                        <ul class="td_card_meta td_mp_0 td_fs_16 td_heading_color">
                          <li>
                            <img src="{{ asset('assets/img/icons/user_3.svg') }}" alt="">
                            <span class="td_opacity_7">{{ $course['seats'] }}</span>
                          </li>
                          <li>
                            <img src="{{ asset('assets/img/icons/book.svg') }}" alt="">
                            <span class="td_opacity_7">{{ $course['lessons'] }}</span>
                          </li>
                        </ul>

                        <h2 class="td_card_title td_fs_24 td_semibold td_mb_12">
                          <a href="{{ $course['url'] }}">{{ $course['title'] }}</a>
                        </h2>

                        <div class="td_card_price_wrap td_mb_12">
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

            @endif
          </div>

        @endforeach

      </div>
    </div>

  </div>

  <div class="td_height_{{ $courses['spacing']['bottom'] }}
              td_height_lg_{{ $courses['spacing']['bottom_lg'] }}"></div>
</section>
