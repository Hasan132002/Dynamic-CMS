@php($testimonial = isset($testimonial['data']) && is_array($testimonial['data']) ? $testimonial['data'] : $testimonial)

<section class="td_heading_bg">
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">

    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 td_white_color">
          {{ $testimonial['subtitle'] }}
        </p>
        <h2 class="td_section_title td_fs_48 mb-0 td_white_color">
          {!! $testimonial['title'] !!}
        </h2>
      </div>
      <div class="td_section_heading_right">
        <p class="td_section_subtitle td_fs_18 mb-0 td_white_color td_opacity_9">
          {{ $testimonial['intro'] }}
        </p>
      </div>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row align-items-center td_gap_y_40 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.3s">

      <div class="col-xl-5 col-lg-6">
        <div class="td_image_box td_style_11 position-relative">
          <img src="{{ asset($testimonial['image']['src']) }}" alt="">
          <div class="td_image_box_text td_heading_bg text-center">
            <h3 class="td_fs_20 td_white_color mb-0">
              {{ $testimonial['image']['name'] }}
            </h3>
            <p class="mb-0 td_white_color td_opacity_7 td_fs_14">
              {{ $testimonial['image']['designation'] }}
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-6 offset-xl-1">
        <div class="td_testimonial td_style_2">

          <div class="td_mb_40">
            @include('svg.home-v7.testimonial.quote')
          </div>

          <h3 class="td_white_color td_fs_24 td_semibold td_mb_30 fst-italic">
            {{ $testimonial['highlight'] }}
          </h3>

          <blockquote class="td_testimonial_text td_fs_20 td_medium td_opacity_6 td_mb_40 td_white_color">
            {{ $testimonial['text'] }}
          </blockquote>

          <div class="td_btns_group">
            <a href="{{ $testimonial['button']['url'] }}"
               class="td_btn td_style_1 td_radius_30 td_medium">
              <span class="td_btn_in td_white_color td_accent_bg">
                <span>{{ $testimonial['button']['label'] }}</span>
                @include('svg.home-v7.testimonial.arrow')
              </span>
            </a>

            <div class="td_avatars_wrap">
              <div class="td_avatars">
                @foreach($testimonial['avatars'] as $avatar)
                  <div>
                    <img src="{{ asset($avatar['image']) }}" alt="">
                    @if(isset($avatar['plus']))
                      <i class="fa-solid fa-plus"></i>
                    @endif
                  </div>
                @endforeach
              </div>
              <div>
                <h3 class="mb-0 td_fs_16 td_medium td_white_color">
                  {!! $testimonial['stats'] !!}
                </h3>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
