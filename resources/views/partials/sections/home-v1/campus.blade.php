@php($campus = isset($campus['data']) && is_array($campus['data']) ? $campus['data'] : $campus)

<section class="td_accent_bg td_shape_section_1">
  <div class="td_shape_position_4 td_accent_color position-absolute">
    @include('svg.home-v1.campus.shape-top')
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_gap_y_40">
      <div class="col-lg-5 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_height_57 td_height_lg_0"></div>

        <div class="td_section_heading td_style_1">
          <h2 class="td_section_title td_fs_48 mb-0 td_white_color">
            {{ $campus['title'] }}
          </h2>
          <p class="td_section_subtitle td_fs_18 mb-0 td_white_color td_opacity_7">
            {{ $campus['description'] }}
          </p>
        </div>

        <div class="td_btn_box">
          @include('svg.home-v1.campus.arrow-curve')

          <div class="td_btn_box_in">
            <a href="{{ $campus['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium td_fs_18">
              <span class="td_btn_in td_heading_color td_white_bg">
                <span>{{ $campus['button']['label'] }}</span>
              </span>
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-6 offset-lg-1">
        <div class="row">
          @foreach($campus['cards'] as $card)
            <div class="col-sm-6">
              <div class="td_card td_style_2 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ $card['delay'] }}">
                <a href="{{ $card['url'] }}" class="td_card_thumb d-block">
                  <img src="{{ asset($card['image']) }}" alt="" class="w-100">
                </a>
                <div class="td_card_info">
                  <h2 class="td_card_title mb-0 td_fs_18 td_semibold td_white_color">
                    <a href="{{ $card['url'] }}">{{ $card['title'] }}</a>
                  </h2>
                  <a href="{{ $card['url'] }}" class="td_card_btn">
                    @include('svg.home-v1.campus.card-arrow')
                    @include('svg.home-v1.campus.card-arrow')
                  </a>
                </div>
              </div>

              <div class="td_height_40 td_height_lg_30"></div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="td_height_112 td_height_lg_75"></div>
</section>
