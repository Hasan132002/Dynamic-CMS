@php($event = isset($event['data']) && is_array($event['data']) ? $event['data'] : $event)

<section>
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $event['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $event['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">
      {{-- LEFT BIG EVENT --}}
      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_card td_style_1 td_radius_5">
          <a href="{{ $event['main']['url'] }}" class="td_card_thumb td_mb_30 d-block">
            <img src="{{ $event['main']['image'] }}" alt="">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span class="td_card_location td_medium td_white_color td_fs_18">
              @include('svg.home-v1.event.location')
              {{ $event['main']['location'] }}
            </span>
          </a>

          <div class="td_card_info">
            <div class="td_card_info_in">
              <div class="td_mb_30">
                <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                  <li>
                    @include('svg.home-v1.event.calendar')
                    <span>{{ $event['main']['date'] }}</span>
                  </li>
                  <li>
                    @include('svg.home-v1.event.clock')
                    <span>{{ $event['main']['time'] }}</span>
                  </li>
                </ul>
              </div>

              <h2 class="td_card_title td_fs_32 td_semibold td_mb_20">
                <a href="{{ $event['main']['url'] }}">{{ $event['main']['title'] }}</a>
              </h2>

              <p class="td_mb_30 td_fs_18">
                {{ $event['main']['description'] }}
              </p>

              <a href="{{ $event['main']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
                <span class="td_btn_in td_white_color td_accent_bg">
                  <span>{{ $event['main']['button'] }}</span>
                  @include('svg.home-v1.event.arrow')
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>

      {{-- RIGHT EVENTS --}}
      <div class="col-lg-6 td_gap_y_30 flex-wrap d-flex wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
        @foreach($event['items'] as $item)
          <div class="td_card td_style_1 td_type_1">
            <a href="{{ $item['url'] }}" class="td_card_thumb d-block">
              <img src="{{ $item['image'] }}" alt="">
              <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

            <div class="td_card_info">
              <div class="td_card_info_in">
                <div class="td_mb_20">
                  <ul class="td_card_meta td_mp_0 td_medium td_heading_color">
                    <li>
                      @include('svg.home-v1.event.calendar')
                      <span>{{ $item['date'] }}</span>
                    </li>
                    <li>
                      @include('svg.home-v1.event.clock')
                      <span>{{ $item['time'] }}</span>
                    </li>
                  </ul>
                </div>

                <h2 class="td_card_title td_fs_20 td_semibold td_mb_20">
                  <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                </h2>

                <span class="td_card_location td_medium td_heading_color">
                  @include('svg.home-v1.event.location')
                  {{ $item['location'] }}
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
