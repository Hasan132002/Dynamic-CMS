@php($grid = $grid)

<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_50 td_row_reverse_lg">

      {{-- LEFT COLUMN --}}
      <div class="col-lg-8">
        <div class="td_section_head_2">
          <div class="td_section_head_2_left">
            <div class="td_view_btns">
              <a href="{{ $grid['views']['grid'] }}" class="td_view_btn td_center active">
                @include('svg.courses.grid-with-sidebar.grid-view-icon')
              </a>
              <a href="{{ $grid['views']['list'] }}" class="td_view_btn td_center">
                @include('svg.courses.grid-with-sidebar.list-view-icon')
              </a>
            </div>
            <span class="td_heading_color td_medium">{{ $grid['summary'] }}</span>
          </div>
          <div class="td_section_head_2_right">
            <div class="td_section_head_select td_fs_20">
              <b class="td_semibold td_heading_color">Sort By: </b>
              <select class="td_form_field td_medium">
                @foreach($grid['sort'] as $sort)
                  <option value="{{ $sort['value'] }}">{{ $sort['label'] }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="td_height_60 td_height_lg_40"></div>

        <div class="row td_gap_y_30 td_row_gap_30">
          @foreach($grid['courses'] as $course)
            <div class="col-md-6">
              <div class="td_card td_style_3 d-block td_radius_10">
                @if($course['badge'])
                  <span class="td_card_label td_accent_bg td_white_color">{{ $course['badge'] }}</span>
                @endif
                <a href="{{ $course['detail_url'] }}" class="td_card_thumb">
                  <img src="{{ asset($course['image']) }}" alt="">
                </a>
                <div class="td_card_info td_white_bg">
                  <div class="td_card_info_in">

                    <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                      @foreach($course['meta'] as $meta)
                        <li>
                          <img src="{{ asset($meta['icon']) }}" alt="">
                          <span class="td_opacity_7">{{ $meta['text'] }}</span>
                        </li>
                      @endforeach
                    </ul>

                    <a href="{{ $course['category_url'] }}" class="td_card_category td_fs_14 td_bold td_heading_color td_mb_14">
                      <span>{{ $course['category'] }}</span>
                    </a>

                    <h2 class="td_card_title td_fs_24 td_mb_16">
                      <a href="{{ $course['detail_url'] }}">{{ $course['title'] }}</a>
                    </h2>

                    <p class="td_card_subtitle td_heading_color td_opacity_7 td_mb_20">
                      {{ $course['description'] }}
                    </p>

                    <div class="td_card_review">
                      <div class="td_rating" data-rating="{{ $course['rating']['value'] }}">
                        <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="td_rating_percentage">
                          <i class="fa-solid fa-star fa-fw"></i><i class="fa-solid fa-star fa-fw"></i>
                          <i class="fa-solid fa-star fa-fw"></i><i class="fa-solid fa-star fa-fw"></i>
                          <i class="fa-solid fa-star fa-fw"></i>
                        </div>
                      </div>
                      <span class="td_heading_color td_opacity_5 td_medium">
                        ({{ $course['rating']['text'] }})
                      </span>
                    </div>

                    <div class="td_card_btn">
                      <a href="{{ $course['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
                        <span class="td_btn_in td_white_color td_accent_bg">
                          <span>{{ $course['button']['label'] }}</span>
                        </span>
                      </a>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="td_height_60 td_height_lg_40"></div>

        <div class="text-center">
          <a href="{{ $grid['more']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $grid['more']['label'] }}</span>
              @include('svg.courses.grid-with-sidebar.arrow-right')
            </span>
          </a>
        </div>
      </div>

      {{-- SIDEBAR --}}
      <div class="col-lg-4">
        <div class="td_sidebar_filter">

          {{-- Search --}}
          <div class="td_filter_widget">
            <form class="td_sidebar_search">
              <input type="text" placeholder="{{ $grid['sidebar']['search_placeholder'] }}" class="td_sidebar_search_input">
              <button class="td_sidebar_search_btn td_center">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </form>
          </div>

          {{-- Price Filter --}}
          <div class="td_filter_widget">
            <h3 class="td_filter_widget_title td_fs_20 td_mb_16">{{ $grid['sidebar']['price_filter']['title'] }}</h3>
            <div class="st-range-slider-wrap">
              <div id="slider-range"></div>
              <div class="td_amount_wrap">
                <input type="text" id="amount" readonly>
              </div>
            </div>
          </div>

          {{-- Categories --}}
          <div class="td_filter_widget">
            <h3 class="td_filter_widget_title td_fs_20 td_mb_16">{{ $grid['sidebar']['categories']['title'] }}</h3>
            <div class="td_filter_category td_fs_18 td_semibold">
              @foreach($grid['sidebar']['categories']['items'] as $cat)
                <a href="{{ $grid['views']['grid'] }}">
                  <span>{{ $cat }}</span>
                  <i class="fa-solid fa-arrow-right-long"></i>
                </a>
              @endforeach
            </div>
          </div>

          {{-- Language --}}
          <div class="td_filter_widget">
            <h3 class="td_filter_widget_title td_fs_20 td_mb_16">{{ $grid['sidebar']['language_skills']['title'] }}</h3>
            <ul class="td_filter_widget_list td_mp_0">
              @foreach($grid['sidebar']['language_skills']['items'] as $lang)
                <li>
                  <div class="td_custom_checkbox_2">
                    <input type="checkbox">
                    <span>{{ $lang }}</span>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>

          {{-- Skills --}}
          <div class="td_filter_widget">
            <h3 class="td_filter_widget_title td_fs_20 td_mb_16">{{ $grid['sidebar']['skills_level']['title'] }}</h3>
            <ul class="td_filter_widget_list td_mp_0">
              @foreach($grid['sidebar']['skills_level']['items'] as $skill)
                <li>
                  <div class="td_custom_checkbox_2">
                    <input type="checkbox">
                    <span>{{ $skill }}</span>
                  </div>
                </li>
              @endforeach
            </ul>

            <div class="td_height_30"></div>
            <hr>
            <div class="td_height_30"></div>

            <h3 class="td_filter_widget_title td_fs_20 td_mb_16">{{ $grid['sidebar']['video_duration']['title'] }}</h3>
            <ul class="td_filter_widget_list td_mp_0">
              @foreach($grid['sidebar']['video_duration']['items'] as $duration)
                <li>
                  <div class="td_custom_checkbox_2">
                    <input type="checkbox">
                    <span>{{ $duration }}</span>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>

          {{-- Rated By --}}
         <div class="td_filter_widget">
  <h3 class="td_filter_widget_title td_fs_20 td_mb_16">
    {{ $grid['sidebar']['rated_by']['title'] }}
  </h3>

  <ul class="td_filter_widget_list td_mp_0">
    @foreach($grid['sidebar']['rated_by']['ratings'] as $rating)
      <li>
        <div class="td_custom_checkbox_2">
          <input type="checkbox">
          <span>
            <span class="td_rating" data-rating="{{ $rating }}">
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <i class="fa-regular fa-star"></i>
              <span class="td_rating_percentage">
                <i class="fa-solid fa-star fa-fw"></i>
                <i class="fa-solid fa-star fa-fw"></i>
                <i class="fa-solid fa-star fa-fw"></i>
                <i class="fa-solid fa-star fa-fw"></i>
                <i class="fa-solid fa-star fa-fw"></i>
              </span>
            </span>
          </span>
        </div>
      </li>
    @endforeach
  </ul>
</div>


        </div>
      </div>

    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
