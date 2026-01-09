@php($certificate = isset($certificate['data']) && is_array($certificate['data']) ? $certificate['data'] : $certificate)

<section class="td_heading_bg td_shape_section_9">

  <div class="td_shape_position_3 position-absolute"></div>

  <div class="td_height_{{ $certificate['spacing']['top'] }} td_height_lg_{{ $certificate['spacing']['top_lg'] }}"></div>

  <div class="container">

    {{-- HEADING --}}
    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_white_color">
        {{ $certificate['heading']['subtitle'] }}
      </p>

      <h2 class="td_section_title td_fs_48 mb-0 td_white_color">
        {!! nl2br(e($certificate['heading']['title'])) !!}
      </h2>
    </div>

    <div class="td_height_{{ $certificate['spacing']['between'] }} td_height_lg_{{ $certificate['spacing']['between_lg'] }}"></div>

    <div class="row align-items-center td_gap_y_40">

      {{-- LEFT IMAGE --}}
      <div class="col-xl-6 wow fadeInLeft"
           data-wow-duration="1s"
           data-wow-delay="0.2s">
        <div class="td_pr_35">
          <img src="{{ asset($certificate['image']) }}"
               alt=""
               class="td_radius_5 w-100">
        </div>
      </div>

      {{-- RIGHT FEATURES --}}
      <div class="col-xl-6 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="row td_gap_y_30 td_row_gap_30">

          @foreach($certificate['features'] as $feature)
            <div class="col-md-6">
              <div class="td_iconbox td_style_4 td_radius_10">

                <div class="td_iconbox_icon td_mb_16">
                  <img src="{{ asset($feature['icon']) }}" alt="">
                </div>

                <h3 class="td_iconbox_title td_fs_24 td_mb_12 td_semibold td_white_color">
                  {{ $feature['title'] }}
                </h3>

                <p class="td_iconbox_subtitle mb-0 td_fs_14 td_white_color td_opacity_7">
                  {{ $feature['description'] }}
                </p>

              </div>
            </div>
          @endforeach

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_{{ $certificate['spacing']['bottom'] }} td_height_lg_{{ $certificate['spacing']['bottom_lg'] }}"></div>

</section>
