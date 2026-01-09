<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="td_section_head_2">
      <div class="td_section_head_2_left">
        <div class="td_view_btns">
          <a href="{{ $course['views']['grid_link'] }}" class="td_view_btn td_center">
            @include('svg.courses.courses-list.grid-view')
          </a>
          <a href="{{ $course['views']['list_link'] }}" class="td_view_btn td_center active">
            @include('svg.courses.courses-list.list-view')
          </a>
        </div>
        <span class="td_heading_color td_medium">
          {{ $course['showing_text'] }}
        </span>
      </div>

      <div class="td_section_head_2_right">
        <div class="td_section_head_select td_fs_20">
          <b class="td_semibold td_heading_color">
            {{ $course['sort']['label'] }}
          </b>
          <select class="td_form_field td_medium">
            @foreach($course['sort']['options'] as $option)
              <option value="{{ $option['value'] }}">
                {{ $option['text'] }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    <div class="row td_gap_y_30 td_row_gap_30">
      @foreach($course['items'] as $item)
      <div class="col-xl-6">
        <div class="td_card td_style_5 td_type_3">
          <a href="{{ $item['details_link'] }}" class="td_card_thumb">
            <span class="td_card_thumb_in td_radius_10">
              <img src="{{ asset($item['image']) }}" alt="">
              <span class="td_card_label td_fs_14 td_white_color td_accent_bg">
                {{ $item['badge'] }}
              </span>
            </span>
          </a>

          <div class="td_card_content">
            <ul class="td_card_meta td_mp_0 td_fs_16 td_heading_color">
              <li>
                <img src="{{ asset($item['meta']['users_icon']) }}" alt="">
                <span class="td_opacity_7">
                  {{ $item['meta']['seats'] }}
                </span>
              </li>
              <li>
                <img src="{{ asset($item['meta']['book_icon']) }}" alt="">
                <span class="td_opacity_7">
                  {{ $item['meta']['semesters'] }}
                </span>
              </li>
            </ul>

            <h2 class="td_card_title td_fs_24 td_semibold td_mb_12">
              <a href="{{ $item['details_link'] }}">
                {{ $item['title'] }}
              </a>
            </h2>

            <div class="td_card_price_wrap td_mb_12">
              <div class="td_card_review">
                <div class="td_rating" data-rating="{{ $item['rating']['value'] }}">
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
                  {{ $item['rating']['text'] }}
                </span>
              </div>

              <span class="td_card_price td_accent_color td_fs_18 td_medium">
                {{ $item['price'] }}
              </span>
            </div>

            <div class="td_card_btns_wrap">
              <a href="{{ $item['enroll_link'] }}"
                 class="td_btn td_style_1 td_type_3 td_radius_10 td_medium td_fs_14">
                <span class="td_btn_in td_accent_color">
                  <span>{{ $item['enroll_text'] }}</span>
                </span>
              </a>
              <span class="td_fs_18 td_medium td_heading_color">
                {{ $item['author'] }}
              </span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    <div class="text-center">
      <a href="{{ $course['more']['link'] }}"
         class="td_btn td_style_1 td_radius_10 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $course['more']['text'] }}</span>
          @include('svg.courses.courses-list.more-arrow')
        </span>
      </a>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
