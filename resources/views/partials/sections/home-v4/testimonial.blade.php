@php($testimonial = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : $testimonial)

<section>
  <div class="td_height_120 td_height_lg_0"></div>

  <div class="td_testimonial_with_shape_wrap">
    <div class="td_testimonial_with_shape td_hobble"
         data-src="{{ asset($testimonial['background']) }}">

      <div class="td_testimonial_shape_1 td_accent_color position-absolute td_hover_layer_3">
        @include('svg.home-v4.testimonial.shape-1')
      </div>

      <div class="td_testimonial_shape_3 td_accent_color position-absolute td_hover_layer_3">
        @include('svg.home-v4.testimonial.shape-3')
      </div>

      <div class="td_testimonial_shape_4 td_accent_color position-absolute td_hover_layer_5">
        @include('svg.home-v4.testimonial.shape-4')
      </div>

      <div class="td_height_120 td_height_lg_80"></div>

      <div class="td_slider td_style_1">
        <div class="container">
          <div class="row align-items-center td_gap_y_40">

            <div class="col-lg-7 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
              <div class="td_image_box td_style_8">
                <img src="{{ asset($testimonial['images'][0]) }}" class="td_image_box_img_1" alt="">
                <img src="{{ asset($testimonial['images'][1]) }}" class="td_image_box_img_2 position-absolute" alt="">
                <img src="{{ asset($testimonial['images'][2]) }}" class="td_image_box_img_3 position-absolute" alt="">
                <div class="td_image_box_shape_1 td_accent_color position-absolute">
                  <img src="{{ asset($testimonial['shape']) }}" alt="">
                </div>
              </div>
            </div>

            <div class="col-lg-5 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">

              <div class="td_section_heading td_style_1">
                <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
                  {{ $testimonial['subtitle'] }}
                </p>
                <h2 class="td_section_title td_fs_48 mb-0">
                  {{ $testimonial['title'] }}
                </h2>
              </div>

              <div class="td_height_50 td_height_lg_50"></div>

              <div class="td_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-slides-per-view="1">
                <div class="td_slider_wrapper">

                  @foreach($testimonial['items'] as $item)
                    <div class="td_slide">
                      <div class="td_testimonial td_style_1 td_type_3">

                        <div class="td_rating td_mb_35" data-rating="{{ $item['rating'] }}">
                          <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>
                          <i class="fa-regular fa-star"></i>
                          <div class="td_rating_percentage">
                            <i class="fa-solid fa-star fa-fw"></i><i class="fa-solid fa-star fa-fw"></i>
                            <i class="fa-solid fa-star fa-fw"></i><i class="fa-solid fa-star fa-fw"></i>
                            <i class="fa-solid fa-star fa-fw"></i>
                          </div>
                        </div>

                        <blockquote class="td_testimonial_text td_fs_24 td_medium td_heading_color td_mb_35 td_opacity_9">
                          {{ $item['text'] }}
                        </blockquote>

                        <div class="td_testimonial_meta">
                          <img src="{{ asset($item['avatar']) }}" alt="">
                          <div class="td_testimonial_meta_right">
                            <h3 class="td_fs_24 td_semibold td_mb_2">{{ $item['name'] }}</h3>
                            <p class="td_fs_14 mb-0 td_heading_color td_opacity_7">{{ $item['designation'] }}</p>
                          </div>
                        </div>

                        <span class="td_quote_icon td_accent_color">
                          @include('svg.home-v4.testimonial.quote')
                        </span>

                      </div>
                    </div>
                  @endforeach

                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="td_slider_arrows td_style_2">
          <div class="td_left_arrow rounded-circle td_center td_white_color">
            @include('svg.home-v4.testimonial.arrow-left')
          </div>
          <div class="td_right_arrow rounded-circle td_center td_white_color">
            @include('svg.home-v4.testimonial.arrow-right')
          </div>
        </div>
      </div>

      <div class="td_height_120 td_height_lg_80"></div>
    </div>
  </div>
</section>
