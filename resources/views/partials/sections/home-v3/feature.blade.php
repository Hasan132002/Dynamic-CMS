@php($feature = isset($feature['data']) && is_array($feature['data']) ? $feature['data'] : $feature)

<section class="td_features_2_wrap">
  <div class="td_height_{{ $feature['spacing']['top'] }} td_height_lg_{{ $feature['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="td_features td_style_2">

      {{-- VIDEO --}}
      <div class="td_features_thumb td_radius_10 td_center td_bg_filed"
           data-src="{{ asset($feature['video']['background']) }}">

        <a href="{{ $feature['video']['url'] }}"
           class="td_player_btn_wrap td_video_open td_medium td_heading_color wow zoomIn"
           data-wow-duration="1s"
           data-wow-delay="{{ $feature['video']['delay'] }}s">

          <span class="td_player_btn td_center">
            <span></span>
          </span>

        </a>
      </div>

      {{-- CONTENT --}}
      <div class="td_features_content_wrap">
        <div class="td_features_content td_white_bg td_radius_10 wow fadeInRight"
             data-wow-duration="1s"
             data-wow-delay="{{ $feature['content']['delay'] }}s">

          <div class="td_section_heading td_style_1">
            <h2 class="td_section_title td_fs_48 mb-0">
              {{ $feature['heading']['title'] }}
            </h2>
            <p class="td_section_subtitle td_fs_18 mb-0">
              {{ $feature['heading']['description'] }}
            </p>
          </div>

          <div class="td_height_40 td_height_lg_40"></div>

          {{-- FEATURES LIST --}}
          <ul class="td_feature_list td_mp_0">
            @foreach($feature['items'] as $item)
              <li>
                <div class="td_feature_icon">
                  <img src="{{ asset($item['icon']) }}" alt="">
                </div>
                <div class="td_feature_info">
                  <h3 class="td_fs_20 td_semibold td_mb_4">
                    {{ $item['title'] }}
                  </h3>
                  <p class="td_fs_14 td_heading_color td_opacity_7 mb-0">
                    {{ $item['description'] }}
                  </p>
                </div>
              </li>
            @endforeach
          </ul>

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_{{ $feature['spacing']['bottom'] }} td_height_lg_{{ $feature['spacing']['bottom_lg'] }}"></div>
</section>
