@php($testimonial = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : $testimonial)

<section class="td_heading_bg td_hobble">
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <h2 class="td_section_title td_fs_48 mb-0 td_white_color">
        {{ $testimonial['heading']['title'] }}
      </h2>
      <p class="td_section_subtitle td_fs_18 mb-0 td_white_color td_opacity_7">
        {!! $testimonial['heading']['subtitle'] !!}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row align-items-center td_gap_y_40">

      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_testimonial_img_wrap">
          <img src="{{ asset($testimonial['image']) }}" alt="" class="td_testimonial_img">
          <span class="td_testimonial_img_shape_1"><span></span></span>
          <span class="td_testimonial_img_shape_2 td_accent_color td_hover_layer_3">
            @include('svg.home-v1.testimonial.shape')
          </span>
        </div>
      </div>

      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_slider td_style_1">
          <div class="td_slider_container" data-autoplay="0" data-loop="1" data-speed="800" data-center="0" data-variable-width="0" data-slides-per-view="1">
            <div class="td_slider_wrapper">

              @foreach($testimonial['slides'] as $slide)
                <div class="td_slide">
                  <div class="td_testimonial td_style_1 td_white_bg td_radius_5">

                    <span class="td_quote_icon td_accent_color">
                      <svg width="65" height="46" viewBox="0 0 65 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.05" d="M13.9286 26.6H1V1H26.8571V27.362L17.956 45H6.26764L14.8213 28.0505L15.5534 26.6H13.9286ZM51.0714 26.6H38.1429V1H64V27.362L55.0988 45H43.4105L51.9642 28.0505L52.6962 26.6H51.0714Z" fill="currentColor" stroke="currentColor" stroke-width="2"/>
                      </svg>
                    </span>

                    <div class="td_testimonial_meta td_mb_24">
                      <img src="{{ asset($slide['avatar']) }}" alt="">
                      <div class="td_testimonial_meta_right">
                        <h3 class="td_fs_24 td_semibold td_mb_2">{{ $slide['name'] }}</h3>
                        <p class="td_fs_14 mb-0 td_heading_color td_opacity_7">{{ $slide['designation'] }}</p>
                      </div>
                    </div>

                    <blockquote class="td_testimonial_text td_fs_20 td_medium td_heading_color td_mb_24 td_opacity_9">
                      {{ $slide['text'] }}
                    </blockquote>

                    <div class="td_rating" data-rating="{{ $slide['rating'] }}">
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
