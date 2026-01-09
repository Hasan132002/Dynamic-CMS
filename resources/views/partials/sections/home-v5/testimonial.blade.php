@php($testimonial = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : $testimonial)

<section class="td_gray_bg_9 td_shape_section_10">
  <div class="td_shape_position_3 position-absolute">
    <img src="{{ asset($testimonial['shape']) }}" alt="">
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_gap_y_40">

      {{-- LEFT --}}
      <div class="col-lg-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.35s">
        <div class="td_section_heading td_style_1">
          <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_heading_color td_opacity_6">
            {{ $testimonial['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 td_mb_20">
            {{ $testimonial['title'] }}
          </h2>
          <p class="td_section_subtitle td_fs_18 mb-0">
            {!! $testimonial['description'] !!}
          </p>
        </div>
      </div>

      {{-- RIGHT SLIDER --}}
      <div class="col-lg-7 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
        <div class="td_full_width">
          <div class="td_slider td_style_1 td_slider_gap_24 td_remove_overflow">

            <div class="td_slider_container"
              data-autoplay="0"
              data-loop="1"
              data-speed="800"
              data-center="0"
              data-variable-width="1"
              data-slides-per-view="responsive"
              data-xs-slides="2"
              data-sm-slides="2"
              data-md-slides="2"
              data-lg-slides="2"
              data-add-slides="3">

              <div class="td_slider_wrapper">

                {{-- ✅ MULTIPLE SLIDES --}}
                @foreach($testimonial['items'] as $item)
                  <div class="td_slide">
                    <div class="td_testimonial td_style_1 td_type_2 td_white_bg td_radius_5">

                      <div class="td_rating td_mb_20" data-rating="{{ $item['rating'] }}">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <div class="td_rating_percentage">
                          <i class="fa-solid fa-star fa-fw"></i>
                          <i class="fa-solid fa-star fa-fw"></i>
                          <i class="fa-solid fa-star fa-fw"></i>
                          <i class="fa-solid fa-star fa-fw"></i>
                          <i class="fa-solid fa-star fa-fw"></i>
                        </div>
                      </div>

                      <blockquote class="td_testimonial_text td_fs_20 td_medium td_heading_color td_mb_30 td_opacity_9">
                        {{ $item['text'] }}
                      </blockquote>

                      <div class="td_testimonial_meta td_mb_24">
                        <img src="{{ asset($item['avatar']) }}" alt="">
                        <div class="td_testimonial_meta_right">
                          <h3 class="td_fs_20 td_semibold td_mb_2">
                            {{ $item['name'] }}
                          </h3>
                          <p class="td_fs_14 mb-0 td_heading_color td_opacity_7">
                            {{ $item['designation'] }}
                          </p>
                        </div>
                      </div>

                      <span class="td_quote_icon td_accent_color">
                        @include('svg.home-v5.testimonial.quote')
                      </span>

                    </div>
                  </div>
                @endforeach

              </div>
            </div>

            <div class="td_height_40 td_height_lg_30"></div>

            {{-- ARROWS (FLOW SAME) --}}
            <div class="td_slider_arrows td_style_1 td_type_2">
              <div class="td_left_arrow td_accent_bg td_radius_10 td_center td_white_color">
                @include('svg.home-v5.testimonial.left-arrow')
              </div>
              <div class="td_right_arrow td_accent_bg td_radius_10 td_center td_white_color">
                @include('svg.home-v5.testimonial.right-arrow')
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
