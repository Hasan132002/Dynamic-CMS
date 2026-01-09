@php($instructor = isset($instructor['data']) && is_array($instructor['data']) ? $instructor['data'] : $instructor)

<section class="td_shape_section_9 td_hobble">

  @foreach($instructor['floating_shapes'] as $shape)
    <div class="{{ $shape['class'] }}">
      <img src="{{ asset($shape['image']) }}" alt="">
    </div>
  @endforeach

  <div class="td_height_{{ $instructor['spacing']['top'] }}
              td_height_lg_{{ $instructor['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="row td_gap_y_40">

      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_image_box td_style_4">

          <div class="td_image_box_img_1">
            <img src="{{ asset($instructor['image']) }}" class="td_radius_10" alt="">
          </div>

          <div class="td_image_box_shape_1 td_accent_color">
            @include('svg.home-v3.instructor.shape-1')
          </div>

          <div class="td_image_box_shape_2">
            <img src="{{ asset($instructor['box_shape']) }}" alt="">
          </div>

          <div class="td_image_box_shape_3 td_accent_color">
            @include('svg.home-v3.instructor.shape-3')
          </div>

          <div class="td_image_box_shape_4 td_accent_color">
            @include('svg.home-v3.instructor.shape-4')
          </div>

        </div>
      </div>

      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="td_section_heading td_style_1">

          <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
            {{ $instructor['subtitle'] }}
          </p>

          <h2 class="td_section_title td_fs_48 td_mb_20">
            {{ $instructor['title'] }}
          </h2>

          <p class="td_section_subtitle td_fs_18 td_mb_36">
            {{ $instructor['description'] }}
          </p>

          <div class="td_mb_40 td_list_3_wrap">
            <ul class="td_list td_style_3 td_mp_0">
              @foreach($instructor['features'] as $item)
                <li>
                  <div class="td_list_icon td_center">
                    <img src="{{ asset($item['icon']) }}" alt="">
                  </div>
                  <div class="td_list_right">
                    <h3 class="td_fs_24 td_semibold td_mb_6">{{ $item['title'] }}</h3>
                    <p class="mb-0 td_heading_color td_opacity_7">{{ $item['text'] }}</p>
                  </div>
                </li>
              @endforeach
            </ul>

            <div class="td_list_3_box td_accent_bg text-center">
              <h2 class="td_fs_64 td_white_color mb-0">{{ $instructor['stat']['count'] }}</h2>
              <p class="mb-0 td_fs_14 td_white_color td_opacity_8">{{ $instructor['stat']['label'] }}</p>
            </div>
          </div>

          <a href="{{ $instructor['cta']['url'] }}" class="td_btn td_style_1 td_radius_30 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $instructor['cta']['text'] }}</span>
              {!! $instructor['cta']['icon'] !!}
            </span>
          </a>

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_{{ $instructor['spacing']['bottom'] }}
              td_height_lg_{{ $instructor['spacing']['bottom_lg'] }}"></div>

</section>
