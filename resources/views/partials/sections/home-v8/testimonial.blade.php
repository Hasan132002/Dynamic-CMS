@php($testimonial = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : $testimonial)

<section class="td_accent_bg td_shape_section_5 td_hobble">
  <div class="td_shape_position_1 position-absolute td_hover_layer_3"></div>

  <div class="td_shape_position_2 position-absolute td_hover_layer_5">
    <img src="{{ asset($testimonial['shapes']['shape_1']) }}" alt="">
  </div>

  <div class="td_shape_position_3 position-absolute td_hover_layer_3"></div>
  <div class="td_shape_position_4 position-absolute td_hover_layer_5"></div>

  <div class="td_shape_position_5 position-absolute td_hover_layer_3">
    <img src="{{ asset($testimonial['shapes']['shape_3']) }}" alt="">
  </div>

  <div class="td_shape_position_6 position-absolute">
    <img src="{{ asset($testimonial['shapes']['shape_4']) }}" alt="">
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_gap_y_40">

      <div class="col-lg-7 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_image_box td_style_8 td_type_1">
          <img src="{{ asset($testimonial['images']['img_1']) }}" alt="" class="td_image_box_img_1">
          <img src="{{ asset($testimonial['images']['img_2']) }}" alt="" class="td_image_box_img_2 position-absolute">
          <img src="{{ asset($testimonial['images']['img_3']) }}" alt="" class="td_image_box_img_3 position-absolute">
          <div class="td_image_box_shape_1 td_accent_color position-absolute">
            <img src="{{ asset($testimonial['shapes']['shape_2']) }}" alt="">
          </div>
        </div>
      </div>

      <div class="col-lg-5 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_section_heading td_style_1">
          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_white_color">
            {{ $testimonial['subtitle'] }}
          </p>
          <h2 class="td_section_title td_white_color td_fs_48 mb-0">
            {{ $testimonial['title'] }}
          </h2>
        </div>

        <div class="td_height_50 td_height_lg_50"></div>

        <div class="td_slider td_style_1">
          <div class="td_slider_container"
               data-autoplay="0"
               data-loop="1"
               data-speed="800"
               data-center="0"
               data-variable-width="0"
               data-slides-per-view="1">

            <div class="td_slider_wrapper">
              @foreach($testimonial['items'] as $item)
                <div class="td_slide">
                  <div class="td_testimonial td_style_1 td_type_3">

                    <div class="td_rating td_mb_35" data-rating="5">
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

                    <blockquote class="td_testimonial_text td_fs_24 td_medium td_white_color td_mb_35 td_opacity_9">
                      {{ $item['text'] }}
                    </blockquote>

                    <div class="td_testimonial_meta">
                      <img src="{{ asset($item['avatar']) }}" alt="">
                      <div class="td_testimonial_meta_right">
                        <h3 class="td_fs_24 td_semibold td_mb_2 td_white_color">
                          {{ $item['name'] }}
                        </h3>
                        <p class="td_fs_14 mb-0 td_white_color td_opacity_7">
                          {{ $item['designation'] }}
                        </p>
                      </div>
                    </div>

                  </div>
                </div>
              @endforeach
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
