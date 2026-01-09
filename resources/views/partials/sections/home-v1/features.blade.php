@php($features = isset($features['data']) && is_array($features['data']) ? $features['data'] : $features)

<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="td_features td_style_1 td_hobble">

      <div class="td_features_thumb">
        <img src="{{ $features['image'] }}" alt=""
             class="td_radius_10 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="0.2s">
      </div>

      <div class="td_features_content td_white_bg td_radius_10 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="0.25s">

        <div class="td_section_heading td_style_1">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
            {{ $features['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 mb-0">
            {{ $features['title'] }}
          </h2>
        </div>

        <div class="td_height_50 td_height_lg_50"></div>

        <ul class="td_feature_list td_mp_0">
          @foreach($features['items'] as $index => $item)
            <li>
              <div class="td_feature_icon td_center">
                @if($index === 0)
                  @include('svg.home-v1.features.smart-hostel')
                @elseif($index === 1)
                  @include('svg.home-v1.features.student-life')
                @elseif($index === 2)
                  @include('svg.home-v1.features.arts-club')
                @elseif($index === 3)
                  @include('svg.home-v1.features.sports-fitness')
                @endif
              </div>

              <div class="td_feature_info">
                <h3 class="td_fs_32 td_semibold td_mb_15">
                  {{ $item['title'] }}
                </h3>
                <p class="td_fs_14 td_heading_color td_opacity_7 mb-0">
                  {{ $item['text'] }}
                </p>
              </div>
            </li>
          @endforeach
        </ul>
      </div>

      <div class="td_features_shape_1 position-absolute td_accent_color td_hover_layer_3">
        @include('svg.home-v1.features.shape-1')
      </div>

      <div class="td_features_shape_2 position-absolute td_accent_color td_hover_layer_5">
        @include('svg.home-v1.features.shape-2')
      </div>

    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
