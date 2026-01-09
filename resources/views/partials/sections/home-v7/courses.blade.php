@php($courses = isset($courses['data']) && is_array($courses['data']) ? $courses['data'] : $courses)

<section class="td_shape_section_10 td_hobble">

  <div class="td_shape_position_4 position-absolute td_accent_color td_hover_layer_3">
    @include('svg.home-v7.courses.shape-1')
  </div>

  <div class="td_shape_position_5 position-absolute td_hover_layer_5">
    @include('svg.home-v7.courses.shape-2')
  </div>

  <div class="td_shape_position_6 position-absolute td_accent_color td_hover_layer_3">
    @include('svg.home-v7.courses.shape-3')
  </div>

  <div class="td_shape_position_7 position-absolute td_accent_color td_hover_layer_5">
    @include('svg.home-v7.courses.shape-4')
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 td_accent_color">
          {{ $courses['subtitle'] }}
        </p>
        <h2 class="td_section_title td_fs_48 mb-0">
          {!! $courses['title'] !!}
        </h2>
      </div>
      <div class="td_section_heading_right">
        <a href="{{ $courses['view_all']['url'] }}"
           class="td_btn td_style_2 td_heading_color td_medium td_mb_10 td_fs_18">
          {{ $courses['view_all']['label'] }}
          <i>
            @include('svg.home-v7.courses.arrow')
            @include('svg.home-v7.courses.arrow')
          </i>
        </a>
      </div>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">
      @foreach($courses['items'] as $item)
        <div class="col-lg-4 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $item['delay'] }}">
          <div class="td_card td_style_3 td_type_2 d-block">
            <a href="{{ $item['url'] }}" class="td_card_thumb">
              <img src="{{ asset($item['image']) }}" alt="">
            </a>
            <div class="td_card_info td_white_bg">
              <div class="td_card_info_in">
                <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                  <li>
                    <img src="{{ asset($item['meta']['user_icon']) }}" alt="">
                    <span class="td_opacity_7">{{ $item['meta']['seats'] }}</span>
                  </li>
                  <li>
                    <img src="{{ asset($item['meta']['book_icon']) }}" alt="">
                    <span class="td_opacity_7">{{ $item['meta']['semesters'] }}</span>
                  </li>
                </ul>

                <h2 class="td_card_title td_fs_24 td_mb_16">
                  <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                </h2>

                <p class="td_card_subtitle td_heading_color td_opacity_7 td_mb_25">
                  {{ $item['description'] }}
                </p>

                <a href="{{ $item['button']['url'] }}"
                   class="td_btn td_style_1 td_type_2 td_radius_30 td_medium">
                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ $item['button']['label'] }}</span>
                    <span class="td_btn_icon td_center td_accent_bg td_white_color">
                      @include('svg.home-v7.courses.card-arrow')
                    </span>
                  </span>
                </a>

              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
