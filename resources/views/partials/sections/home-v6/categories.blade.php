@php($categories = isset($categories['data']) && is_array($categories['data']) ? $categories['data'] : $categories)

<section>
  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_medium
                td_spacing_1 td_mb_10 td_accent_color">
        {{ $categories['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $categories['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_24">

      @foreach($categories['items'] as $item)
        <div class="col-xl-3 col-sm-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $item['delay'] }}">

          <div class="td_iconbox td_style_7 td_radius_10 text-center">

            <div class="td_iconbox_icon td_accent_bg td_mb_10 td_center">
              <img src="{{ asset($item['icon']) }}" alt="">
            </div>

            <div class="td_iconbox_right">
              <h3 class="td_iconbox_title td_fs_20 td_semibold td_mb_5">
                {{ $item['title'] }}
              </h3>
              <p class="td_iconbox_subtitle td_fs_14
                        td_heading_color td_opacity_7 mb-0">
                {{ $item['description'] }}
              </p>
            </div>

            <a href="{{ $item['url'] }}"
               class="td_iconbox_btn td_center">
              @include('svg.home-v6.categories.arrow')
            </a>

          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
