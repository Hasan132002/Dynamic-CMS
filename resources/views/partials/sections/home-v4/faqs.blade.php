@php($faq = isset($faq['data']) && is_array($faq['data']) ? $faq['data'] : $faq)

<section>
  <div class="td_gray_bg_5 td_shape_section_4 td_hobble">

    <div class="td_shape td_shape_position_1 td_hover_layer_5">
      <img src="{{ asset($faq['shapes'][0]) }}" alt="">
    </div>
    <div class="td_shape td_shape_position_2">
      <img src="{{ asset($faq['shapes'][1]) }}" alt="">
    </div>
    <div class="td_shape td_shape_position_3 td_hover_layer_3">
      <img src="{{ asset($faq['shapes'][2]) }}" alt="">
    </div>
    <div class="td_shape td_shape_position_4">
      <img src="{{ asset($faq['shapes'][3]) }}" alt="">
    </div>

    <div class="td_height_112 td_height_lg_75"></div>

    <div class="container">
      <div class="row align-items-center td_gap_y_40">

        <div class="col-xl-6 wow fadeInLeft"
             data-wow-duration="1s"
             data-wow-delay="0.3s">

          <div class="td_section_heading td_style_1">
            <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
              {{ $faq['subtitle'] }}
            </p>
            <h2 class="td_section_title td_fs_48 mb-0">
              {{ $faq['title'] }}
            </h2>
          </div>

          <div class="td_height_50 td_height_lg_50"></div>

          <div class="td_accordians td_style_1 td_type_1">

            @foreach($faq['items'] as $item)
              <div class="td_accordian {{ $item['active'] ? 'active' : '' }}">
                <div class="td_accordian_head">
                  <h2 class="td_accordian_title td_fs_20 td_medium">
                    {{ $item['question'] }}
                  </h2>
                  <span class="td_accordian_toggle">
                    @include('svg.home-v4.faq.accordion-arrow')
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
             data-wow-delay="0.4s">

          <div class="td_image_box td_style_9">
            <div class="td_image_box_img_1">
              <img src="{{ asset($faq['image']) }}" alt="">
            </div>

            @foreach($faq['image_shapes'] as $shape)
              <div class="{{ $shape['class'] }}">
                <img src="{{ asset($shape['src']) }}" alt="">
              </div>
            @endforeach

          </div>
        </div>

      </div>
    </div>

    <div class="td_height_120 td_height_lg_80"></div>
  </div>
</section>
