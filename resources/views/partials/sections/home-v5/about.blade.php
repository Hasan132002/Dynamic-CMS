@php($about = isset($about['data']) && is_array($about['data']) ? $about['data'] : $about)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_40">

      <div class="col-lg-6 wow fadeInLeft"
           data-wow-duration="1s"
           data-wow-delay="0.3s">

        <div class="td_image_box td_style_6">

          <div class="td_image_box_img_1">
            <img src="{{ asset($about['images'][0]) }}" alt="">
          </div>

          <div class="td_image_box_img_2">
            <div class="td_image_box_img_2_in">
              <img src="{{ asset($about['images'][1]) }}" alt="">
              <a href="{{ $about['video_url'] }}" class="td_video_open">
                <span class="td_player_btn td_center">
                  <span></span>
                </span>
              </a>
            </div>
          </div>

          <div class="td_image_box_shape_1 position-absolute"></div>

          <div class="td_image_box_shape_2 position-absolute">
            <img src="{{ asset($about['shape']) }}" alt="">
          </div>

        </div>
      </div>

      <div class="col-lg-6 wow fadeInUp"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="td_section_heading td_style_1 td_mb_30">
          <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1
                    td_mb_10 text-uppercase td_heading_color td_opacity_6">
            {{ $about['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 td_mb_20">
            {{ $about['title'] }}
          </h2>
          <p class="td_section_subtitle td_fs_18 mb-0">
            {{ $about['description'] }}
          </p>
        </div>

        <div class="td_tabs td_style_1">

          <ul class="td_tab_links td_style_3 td_mp_0 td_medium td_fs_24 td_heading_color">
            @foreach($about['tabs'] as $index => $tab)
              <li class="{{ $index === 0 ? 'active' : '' }}">
                <a href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
              </li>
            @endforeach
          </ul>

          <div class="td_height_40 td_height_lg_30"></div>

          <div class="td_tab_body">

            <div class="td_tab active" id="{{ $about['tabs'][0]['id'] }}">
              <ul class="td_list td_style_5 td_mp_0">
                @foreach($about['tabs'][0]['items'] as $item)
                  <li>
                    <h3 class="td_fs_24 td_mb_8">{{ $item['title'] }}</h3>
                    <p class="td_fs_18 mb-0">{{ $item['text'] }}</p>
                  </li>
                @endforeach
              </ul>
            </div>

            <div class="td_tab" id="{{ $about['tabs'][1]['id'] }}">
              <p class="td_fs_18 mb-0">{!! $about['tabs'][1]['content'] !!}</p>
            </div>

            <div class="td_tab" id="{{ $about['tabs'][2]['id'] }}">
              <p class="td_fs_18 mb-0">{!! $about['tabs'][2]['content'] !!}</p>
            </div>

          </div>
        </div>

        <div class="td_height_40 td_height_lg_40"></div>

        <a href="{{ $about['button']['url'] }}"
           class="td_btn td_style_1 td_radius_10 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $about['button']['label'] }}</span>
            @include('svg.home-v5.about.btn-arrow')
          </span>
        </a>

      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
