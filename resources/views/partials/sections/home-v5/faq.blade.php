@php($faq = isset($faq['data']) && is_array($faq['data']) ? $faq['data'] : $faq)

<section>
  <div class="td_shape_section_4 td_hobble">

    <div class="td_shape td_shape_position_5 td_hover_layer_3">
      <img src="{{ asset($faq['shapes'][0]) }}" alt="">
    </div>
    <div class="td_shape td_shape_position_6 td_hover_layer_5">
      <img src="{{ asset($faq['shapes'][1]) }}" alt="">
    </div>
    <div class="td_shape td_shape_position_7 td_hover_layer_3">
      <img src="{{ asset($faq['shapes'][2]) }}" alt="">
    </div>
    <div class="td_shape td_shape_position_8 td_hover_layer_5">
      <img src="{{ asset($faq['shapes'][3]) }}" alt="">
    </div>

    <div class="td_height_112 td_height_lg_75"></div>

    <div class="container">
      <div class="row align-items-center td_gap_y_40">

        <div class="col-xl-6 wow fadeInLeft"
             data-wow-duration="1s"
             data-wow-delay="0.25s">

          <div class="td_section_heading td_style_1">
            <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1
                      td_mb_10 text-uppercase td_heading_color td_opacity_6">
              {{ $faq['subtitle'] }}
            </p>
            <h2 class="td_section_title td_fs_48 mb-0">
              {{ $faq['title'] }}
            </h2>
          </div>

          <div class="td_height_50 td_height_lg_50"></div>

          <div class="td_accordians td_style_1 td_color_1 td_type_1">

            @foreach($faq['items'] as $index => $item)
              <div class="td_accordian {{ $index === 0 ? 'active' : '' }}">
                <div class="td_accordian_head">
                  <h2 class="td_accordian_title td_fs_20 td_medium">
                    {{ $item['question'] }}
                  </h2>
                  <span class="td_accordian_toggle">
                    @include('svg.home-v5.faq.toggle')
                  </span>
                </div>
                <div class="td_accordian_body">
                  <p>{{ $item['answer'] }}</p>
                </div>
              </div>
            @endforeach

          </div>
        </div>

        <div class="col-xl-6 wow fadeInRight"
             data-wow-duration="1s"
             data-wow-delay="0.25s">

          <div class="td_image_box td_style_10">
            <img src="{{ asset($faq['image']) }}" alt="">

            <div class="td_image_box_contact td_accent_bg text-center">
              <i class="fa-solid fa-phone td_center td_heading_color"></i>
              <div class="td_image_box_contact_in">
                <h4 class="td_fs_20 td_mb_10 td_white_color">
                  {{ $faq['contact']['title'] }}
                </h4>
                <p class="td_fs_14 td_opacity_7 td_white_color td_mb_2">
                  {{ $faq['contact']['subtitle'] }}
                </p>
                <h4 class="td_fs_20 td_mb_10 td_white_color mb-0">
                  {{ $faq['contact']['phone'] }}
                </h4>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="td_height_120 td_height_lg_80"></div>
  </div>
</section>
