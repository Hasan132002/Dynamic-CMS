@php($popular = $popular)

<section>
  <div class="td_height_60 td_height_lg_60"></div>
  <div class="container">
    <h2 class="td_fs_48 td_mb_50">{{ $popular['title'] }}</h2>
    <div class="row td_gap_y_30 td_row_gap_30">

      @foreach($popular['items'] as $item)
      <div class="col-lg-4 col-md-6">
        <div class="td_card td_style_3 d-block td_radius_10">
          <span class="td_card_label td_accent_bg td_white_color">{{ $item['badge'] }}</span>
          <a href="{{ $item['detail_url'] }}" class="td_card_thumb">
            <img src="{{ asset($item['image']) }}" alt="">
          </a>
          <div class="td_card_info td_white_bg">
            <div class="td_card_info_in">
              <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                @foreach($item['meta'] as $meta)
                <li>
                  <img src="{{ asset($meta['icon']) }}" alt="">
                  <span class="td_opacity_7">{{ $meta['text'] }}</span>
                </li>
                @endforeach
              </ul>

              <a href="{{ $item['category_url'] }}"
                 class="td_card_category td_fs_14 td_bold td_heading_color td_mb_14">
                <span>{{ $item['category'] }}</span>
              </a>

              <h2 class="td_card_title td_fs_24 td_mb_16">
                <a href="{{ $item['detail_url'] }}">{{ $item['title'] }}</a>
              </h2>

              <p class="td_card_subtitle td_heading_color td_opacity_7 td_mb_20">
                {{ $item['description'] }}
              </p>

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
                <span class="td_heading_color td_opacity_5 td_medium">
                  ({{ $item['rating']['text'] }})
                </span>
              </div>

              <div class="td_card_btn">
                <a href="{{ $item['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ $item['button']['label'] }}</span>
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
  <div class="td_height_120 td_height_lg_80"></div>
</section>
