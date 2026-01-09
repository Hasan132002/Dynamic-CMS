@php($features = isset($features['data']) && is_array($features['data']) ? $features['data'] : $features)

<section>
  <div class="td_heading_bg">
    <div class="td_height_80 td_height_lg_80"></div>
    <div class="container">
      <div class="row td_gap_y_30">

        @foreach($features['items'] as $item)
          <div class="col-xl-3 col-md-6 wow fadeInUp"
               data-wow-duration="1s"
               data-wow-delay="{{ $item['delay'] }}">
            <div class="td_iconbox td_style_9">
              <div class="td_iconbox_icon td_center td_accent_bg td_radius_10">
                <img src="{{ asset($item['icon']) }}" alt="">
              </div>
              <div class="td_iconbox_right">
                <h3 class="td_iconbox_title td_white_color td_fs_20 td_mb_8">
                  {{ $item['title'] }}
                </h3>
                <p class="td_iconbox_subtitle mb-0 td_fs_14 td_white_color td_opacity_7">
                  {{ $item['description'] }}
                </p>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
    <div class="td_height_80 td_height_lg_80"></div>
  </div>
</section>
