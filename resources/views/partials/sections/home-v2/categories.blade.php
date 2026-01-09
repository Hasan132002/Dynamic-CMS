@php($categories = isset($categories['data']) && is_array($categories['data']) ? $categories['data'] : ($categories ?? []))

<section>
  <div class="td_height_{{ $categories['spacing']['top'] }}
              td_height_lg_{{ $categories['spacing']['top_lg'] }}"></div>

  <div class="container">

    {{-- HEADING --}}
    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="{{ $categories['heading']['delay'] }}s">

      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
          <i></i>{{ $categories['heading']['subtitle'] }}<i></i>
        </p>
        <h2 class="td_section_title td_fs_48 mb-0">
          {{ $categories['heading']['title'] }}
        </h2>
      </div>

      <div class="td_section_heading_right">
        <p class="td_section_subtitle td_fs_18 td_mb_16 td_heading_color td_opacity_9">
          {{ $categories['heading']['description'] }}
        </p>

        <a href="{{ $categories['cta']['url'] }}"
           class="td_btn td_style_2 td_heading_color td_medium td_mb_10">
          {{ $categories['cta']['text'] }}
        </a>
      </div>
    </div>

    <div class="td_height_{{ $categories['spacing']['between'] }}
                td_height_lg_{{ $categories['spacing']['between'] }}"></div>

    {{-- CATEGORIES --}}
    <div class="row td_gap_y_24">
      @foreach($categories['items'] as $item)
        <div class="col-xl-3 col-lg-4 col-sm-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $item['delay'] }}s">

          <div class="td_iconbox td_style_2 text-center td_hobble">
            <div class="td_iconbox_in td_hover_layer_4">
              <div class="td_hover_layer_3">

                <div class="td_iconbox_icon td_mb_16">
                  <img src="{{ asset($item['icon']) }}" alt="">
                </div>

                <h3 class="td_iconbox_title td_fs_20 td_semibold td_opacity_8 td_mb_16">
                  {{ $item['title'] }}
                </h3>

                <p class="td_iconbox_subtitle mb-0 td_accent_color">
                  <span>{{ $item['courses'] }}</span> Courses
                </p>

              </div>
            </div>

            <a href="{{ $item['url'] }}" class="td_iconbox_link"></a>
          </div>

        </div>
      @endforeach
    </div>

  </div>

  <div class="td_height_{{ $categories['spacing']['bottom'] }}
              td_height_lg_{{ $categories['spacing']['bottom_lg'] }}"></div>
</section>
