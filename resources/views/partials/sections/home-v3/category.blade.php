@php($category = isset($category['data']) && is_array($category['data']) ? $category['data'] : $category)

<section class="td_gray_bg_5">

  <div class="td_height_{{ $category['spacing']['top'] }} td_height_lg_{{ $category['spacing']['top_lg'] }}"></div>

  <div class="container">

    {{-- HEADING --}}
    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $category['heading']['subtitle'] }}
      </p>

      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $category['heading']['title'] }}
      </h2>
    </div>

    <div class="td_height_{{ $category['spacing']['between'] }} td_height_lg_{{ $category['spacing']['between_lg'] }}"></div>

    {{-- ITEMS --}}
    <div class="row td_gap_y_24">

      @foreach($category['items'] as $item)
        <div class="col-xxl-3 col-lg-4 col-md-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $item['delay'] }}s">

          <a href="{{ $item['url'] }}"
             class="td_iconbox td_style_3 td_fs_18 td_semibold td_radius_10 td_white_bg td_heading_color">

            <span class="td_iconbox_icon">
              <img src="{{ asset($item['icon']) }}" alt="">
            </span>

            <span class="td_iconbox_title">
              {{ $item['title'] }}
            </span>

          </a>
        </div>
      @endforeach

    </div>
  </div>

  <div class="td_height_{{ $category['spacing']['bottom'] }} td_height_lg_{{ $category['spacing']['bottom_lg'] }}"></div>

</section>
