@php
  $section = isset($rate['data']) && is_array($rate['data']) ? $rate['data'] : ($rate ?? null);
@endphp

@if($section)
<section class="{{ $section['section_classes'] }} wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

  {{-- HEADING --}}
  <div class="td_rate_heading td_fs_20 td_semibold td_white_color">
    {{ $section['heading'] }}

    <div class="td_rating_wrap">
      <div class="td_rating" data-rating="{{ $section['rating']['value'] }}">

        {{-- Empty stars --}}
        @for($i = 1; $i <= $section['rating']['max']; $i++)
          <i class="fa-regular fa-star"></i>
        @endfor

        {{-- Filled stars --}}
        <div class="td_rating_percentage">
          @for($i = 1; $i <= $section['rating']['value']; $i++)
            <i class="fa-solid fa-star fa-fw"></i>
          @endfor
        </div>

      </div>
    </div>
  </div>

  {{-- MOVING FEATURES --}}
  <div class="td_rate_feature_list_wrap">
    <div class="td_moving_box_wrap">
      <div class="td_moving_box_in">

        {{-- LOOP 1 --}}
        <div class="td_moving_box">
          <ul class="td_rate_feature_list td_mp_0">
            @foreach($section['features'] as $feature)
              <li>
                <div class="td_rate_feature_icon td_center td_white_bg">
                  <img src="{{ asset($feature['icon']) }}" alt="">
                </div>
                <div class="td_rate_feature_right">
                  <h3 class="td_fs_24 td_semibold td_white_color td_mb_4">
                    {{ $feature['title'] }}
                  </h3>
                  <p class="mb-0 td_white_color td_opacity_7">
                    {{ $feature['description'] }}
                  </p>
                </div>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- LOOP 2 (duplicate for animation) --}}
        <div class="td_moving_box">
          <ul class="td_rate_feature_list td_mp_0">
            @foreach($section['features'] as $feature)
              <li>
                <div class="td_rate_feature_icon td_center td_white_bg">
                  <img src="{{ asset($feature['icon']) }}" alt="">
                </div>
                <div class="td_rate_feature_right">
                  <h3 class="td_fs_24 td_semibold td_white_color td_mb_4">
                    {{ $feature['title'] }}
                  </h3>
                  <p class="mb-0 td_white_color td_opacity_7">
                    {{ $feature['description'] }}
                  </p>
                </div>
              </li>
            @endforeach
          </ul>
        </div>

      </div>
    </div>
  </div>
</section>
@endif
