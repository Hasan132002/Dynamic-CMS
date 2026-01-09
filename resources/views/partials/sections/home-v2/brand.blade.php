@php($section = isset($cta_brands['data']) && is_array($cta_brands['data']) ? $cta_brands['data'] : $cta_brands)

<section class="td_heading_bg td_shape_section_6">

  {{-- BACKGROUND SHAPES --}}
  @foreach($section['background_shapes'] as $shape)
    <div class="{{ $shape }} position-absolute"></div>
  @endforeach

  {{-- CTA CARDS --}}
  <div class="td_half_white_bg">
    <div class="container">
      <div class="row td_gap_y_30">

        @foreach($section['cards'] as $card)
          <div class="col-lg-6 wow fadeInUp"
               data-wow-duration="1s"
               data-wow-delay="{{ $card['delay'] }}s">

            <div class="td_card td_style_4 td_accent_bg">

              <div class="td_card_left">
                <h3 class="td_fs_32 td_mb_16 td_white_color">
                  {!! $card['title_html'] !!}
                </h3>

                <p class="td_fs_18 td_white_color td_opacity_9 td_mb_30">
                  {{ $card['subtitle'] }}
                </p>

                <a href="{{ $card['button']['url'] }}"
                   class="td_btn td_style_1 td_type_3 td_radius_30 td_medium td_with_shadow">
                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ $card['button']['text'] }}</span>
                    @include('svg.home-v2.brand.button-arrow')
                  </span>
                </a>
              </div>

              <div class="td_card_thumb">
                <img src="{{ asset($card['image']) }}" alt="">
              </div>

              <div class="td_card_1">
                <img src="{{ asset($section['card_shapes']['shape_1']) }}" alt="">
              </div>

              <div class="td_card_2">
                <img src="{{ asset($section['card_shapes']['shape_2']) }}" alt="">
              </div>

            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>

  {{-- BRANDS --}}
  <div class="container">
    <div class="td_height_{{ $section['spacing']['before_brands'] }}"></div>

    <h2 class="td_fs_32 td_semibold td_opacity_9 td_mb_50 text-center td_white_color wow fadeInUp"
        data-wow-duration="1s"
        data-wow-delay="{{ $section['brands']['title_delay'] }}s">
      {!! nl2br(e($section['brands']['title'])) !!}
    </h2>

    <div class="td_slider td_style_1 td_slider_gap_24 td_remove_overflow wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="{{ $section['brands']['slider_delay'] }}s">

<div class="td_slider_container"
     data-autoplay="{{ $section['brands']['slider']['autoplay'] }}"
     data-loop="{{ $section['brands']['slider']['loop'] }}"
     data-speed="{{ $section['brands']['slider']['speed'] }}"
     data-center="0"
     data-variable-width="0"
     data-slides-per-view="responsive"
     data-xs-slides="{{ $section['brands']['slider']['xs'] }}"
     data-sm-slides="{{ $section['brands']['slider']['sm'] }}"
     data-md-slides="{{ $section['brands']['slider']['md'] }}"
     data-lg-slides="{{ $section['brands']['slider']['lg'] }}"
     data-add-slides="{{ $section['brands']['slider']['lg'] }}">


        <div class="td_slider_wrapper">
          @foreach($section['brands']['logos'] as $logo)
            <div class="td_slide">
              <div class="td_brand td_style_1">
                <img src="{{ asset($logo) }}" alt="">
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>

  <div class="td_height_{{ $section['spacing']['bottom'] }}"></div>
</section>
