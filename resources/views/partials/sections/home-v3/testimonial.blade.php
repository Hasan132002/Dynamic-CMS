@php($testimonial = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : $testimonial)

<section class="td_shape_section_9 td_hobble">
  <div class="td_shape_position_4 position-absolute td_hover_layer_3">
    <img src="{{ asset($testimonial['shapes']['shape_1']) }}" alt="">
  </div>

  <div class="td_shape_position_5 position-absolute td_accent_color td_hover_layer_5">
    @include('svg.home-v3.testimonial.shape-main')
  </div>

  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $testimonial['heading']['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $testimonial['heading']['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="td_slider td_style_1 td_slider_gap_24 td_remove_overflow wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
      <div class="td_slider_container"
           data-autoplay="{{ $testimonial['slider']['settings']['autoplay'] }}"
           data-loop="{{ $testimonial['slider']['settings']['loop'] }}"
           data-speed="{{ $testimonial['slider']['settings']['speed'] }}"
           data-center="{{ $testimonial['slider']['settings']['center'] }}"
           data-variable-width="{{ $testimonial['slider']['settings']['variable_width'] }}"
           data-slides-per-view="{{ $testimonial['slider']['settings']['slides_per_view'] }}"
           data-xs-slides="{{ $testimonial['slider']['settings']['xs'] }}"
           data-sm-slides="{{ $testimonial['slider']['settings']['sm'] }}"
           data-md-slides="{{ $testimonial['slider']['settings']['md'] }}"
           data-lg-slides="{{ $testimonial['slider']['settings']['lg'] }}"
           data-add-slides="{{ $testimonial['slider']['settings']['add'] }}">

        <div class="td_slider_wrapper">
          @foreach($testimonial['slider']['items'] as $item)
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

                <blockquote class="td_testimonial_text td_fs_18 td_medium td_heading_color td_mb_30 td_opacity_9">
                  {{ $item['text'] }}
                </blockquote>

                <div class="td_testimonial_meta td_mb_24">
                  <img src="{{ asset($item['avatar']) }}" alt="">
                  <div class="td_testimonial_meta_right">
                    <h3 class="td_fs_20 td_semibold td_mb_2">{{ $item['name'] }}</h3>
                    <p class="td_fs_14 mb-0 td_heading_color td_opacity_7">{{ $item['designation'] }}</p>
                  </div>
                </div>

                <span class="td_quote_icon td_accent_color">
                  @include('svg.home-v3.testimonial.quote')
                </span>

              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="td_height_40 td_height_lg_40"></div>

      <div class="td_slider_arrows td_style_1">
        <div class="td_left_arrow td_accent_bg rounded-circle td_center td_white_color">
          @include('svg.home-v3.testimonial.arrow-left')
        </div>
        <div class="td_right_arrow td_accent_bg rounded-circle td_center td_white_color">
          @include('svg.home-v3.testimonial.arrow-right')
        </div>
      </div>
    </div>
  </div>
</section>
