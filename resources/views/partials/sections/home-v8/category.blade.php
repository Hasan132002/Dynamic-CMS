@php($category = isset($category['data']) && is_array($category['data']) ? $category['data'] : $category)

<section>
  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">{{ $category['subtitle'] }}</p>
      <h2 class="td_section_title td_fs_48 mb-0">{{ $category['title'] }}</h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_24">
      @foreach($category['items'] as $item)
        <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ $item['delay'] }}">
          <div class="td_iconbox td_style_8 td_radius_10">
            <div class="td_iconbox_in">
              <h2 class="td_iconbox_title td_fs_32 td_semibold td_mb_30">{!! $item['title'] !!}</h2>
              <a href="{{ $item['url'] }}" class="td_btn td_style_3 td_heading_color td_medium td_fs_18">
                <span>{{ $item['button'] }}</span>
                <i>@include('svg.home-v8.category.arrow-icon')</i>
              </a>
            </div>
            <div class="td_icon_shape td_accent_color">
              @include('svg.home-v8.category.circle-shape')
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
