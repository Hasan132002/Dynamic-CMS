@php
  $section = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : ($testimonial ?? null);
@endphp

@if($section)
<section class="{{ $section['section_classes'] }}">

  {{-- SHAPES --}}
  @foreach($section['shapes'] as $shape)
    <div class="{{ $shape['class'] }} position-absolute">
      <img src="{{ asset($shape['src']) }}" alt="">
    </div>
  @endforeach

  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    {{-- HEADING --}}
    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        <i></i>
        {{ $section['subtitle'] }}
        <i></i>
      </p>

      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $section['title'] !!}
      </h2>

      <p class="td_section_subtitle td_fs_18 mb-0">
        {!! $section['description'] !!}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    {{-- SLIDER --}}
    <div class="td_slider td_style_1 td_slider_gap_24 td_remove_overflow wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.3s">

      <div class="td_slider_container"
           data-autoplay="{{ $section['slider']['autoplay'] }}"
           data-loop="{{ $section['slider']['loop'] }}"
           data-speed="{{ $section['slider']['speed'] }}"
           data-center="0"
           data-variable-width="0"
           data-slides-per-view="responsive"
           data-xs-slides="{{ $section['slider']['slides']['xs'] }}"
           data-sm-slides="{{ $section['slider']['slides']['sm'] }}"
           data-md-slides="{{ $section['slider']['slides']['md'] }}"
           data-lg-slides="{{ $section['slider']['slides']['lg'] }}"
           data-add-slides="{{ $section['slider']['slides']['add'] }}">

        <div class="td_slider_wrapper">

          @foreach($section['items'] as $item)
            <div class="td_slide">
              <div class="td_testimonial td_style_1 td_type_1 td_white_bg td_radius_5">

                {{-- QUOTE ICON (SVG) --}}
                <span class="td_quote_icon td_accent_color">
                  @includeIf('svg.home-v2.testimonial.quote')
                </span>

                <div class="td_testimonial_meta td_mb_24">
                  <img src="{{ asset($item['avatar']) }}" alt="">
                  <div class="td_testimonial_meta_right">
                    <h3 class="td_fs_24 td_semibold td_mb_2">
                      {{ $item['name'] }}
                    </h3>
                    <p class="td_fs_14 mb-0 td_heading_color td_opacity_7">
                      {{ $item['designation'] }}
                    </p>
                  </div>
                </div>

                <blockquote class="td_testimonial_text td_fs_20 td_medium td_heading_color td_mb_24 td_opacity_9">
                  {{ $item['text'] }}
                </blockquote>

                {{-- RATING --}}
                <div class="td_rating" data-rating="{{ $item['rating'] }}">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="fa-regular fa-star"></i>
                  @endfor
                  <div class="td_rating_percentage">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="fa-solid fa-star fa-fw"></i>
                    @endfor
                  </div>
                </div>

              </div>
            </div>
          @endforeach

        </div>
      </div>

      <div class="td_height_50 td_height_lg_40"></div>
      <div class="td_pagination td_style_1"></div>
    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
@endif
