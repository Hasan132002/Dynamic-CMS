@php($rate = isset($rate['data']) && is_array($rate['data']) ? $rate['data'] : $rate)

<section class="td_heading_bg td_rate_section td_type_1">

  {{-- HEADING + RATING --}}
  <div class="td_rate_heading td_fs_20 td_semibold td_white_color">
    {{ $rate['heading'] }}

    <div class="td_rating_wrap">
      <div class="td_rating" data-rating="{{ $rate['rating'] }}">
        @for($i = 0; $i < 5; $i++)
          <i class="fa-regular fa-star"></i>
        @endfor

        <div class="td_rating_percentage">
          @for($i = 0; $i < 5; $i++)
            <i class="fa-solid fa-star fa-fw"></i>
          @endfor
        </div>
      </div>
    </div>
  </div>

  {{-- MOVING FEATURE LIST --}}
  <div class="td_rate_feature_list_wrap">
    <div class="td_moving_box_wrap">
      <div class="td_moving_box_in">

        @foreach($rate['lists'] as $list)
          <div class="td_moving_box">
            <ul class="td_rate_feature_list td_mp_0">
              @foreach($list as $item)
                <li>
                  <div class="td_rate_feature_icon td_center td_white_bg">
                    <img src="{{ asset($item['icon']) }}" alt="">
                  </div>
                  <div class="td_rate_feature_right">
                    <h3 class="td_fs_24 td_semibold td_white_color td_mb_4">
                      {{ $item['title'] }}
                    </h3>
                    <p class="mb-0 td_white_color td_opacity_7">
                      {{ $item['text'] }}
                    </p>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach

      </div>
    </div>
  </div>

</section>
