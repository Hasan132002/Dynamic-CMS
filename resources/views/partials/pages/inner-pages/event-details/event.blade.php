<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_50">
      <div class="col-lg-8">
        <div class="td_card td_style_1 td_type_3">
          <img src="{{ asset($event['main_image']) }}" alt="" class="w-100 td_radius_10 td_mb_30">
          <div class="td_card_info">
            <div class="td_card_info_in">
              <div class="td_mb_30">
                <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                  <li>
                    @include('svg.pages.event-details.calendar')
                    <span>{{ $event['date'] }}</span>
                  </li>
                  <li>
                    @include('svg.pages.event-details.clock')
                    <span>{{ $event['time'] }}</span>
                  </li>
                </ul>
              </div>

              <h2 class="td_card_title td_fs_38 td_mb_50">{{ $event['title'] }}</h2>

              <h3 class="td_fs_32 td_mb_20">{{ $event['about_heading'] }}</h3>

              @foreach ($event['about_paragraphs'] as $paragraph)
                <p class="td_mb_30 td_fs_18">{{ $paragraph }}</p>
              @endforeach

              <div class="td_mb_40">
                <ul class="td_list td_style_2 td_type_2 td_fs_18 td_medium td_heading_color td_mp_0">
                  @foreach ($event['features'] as $feature)
                    <li>
                      @include('svg.pages.event-details.check')
                      {{ $feature }}
                    </li>
                  @endforeach
                </ul>
              </div>

              <h3 class="td_fs_32 td_mb_20">{{ $event['location_heading'] }}</h3>

              <div class="td_mb_40">
                <ul class="td_card_meta td_type_2 td_mp_0 td_heading_color">
                  <li>
                    @include('svg.pages.event-details.location')
                    <span class="td_opacity_7">{{ $event['address'] }}</span>
                  </li>
                  <li>
                    @include('svg.pages.event-details.clock')
                    <span class="td_opacity_7">{{ $event['map_time'] }}</span>
                  </li>
                </ul>
              </div>

              <div class="td_map">
                <iframe id="map" src="{{ $event['map_iframe'] }}" allowfullscreen=""></iframe>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="td_card td_style_6 td_white_bg td_radius_10">
          <img src="{{ asset($event['sidebar']['image']) }}" alt="" class="td_radius_10 td_mb_20 w-100">

          <h3 class="td_fs_20 td_semibold td_mb_10">{{ $event['sidebar']['title'] }}</h3>
          <p class="td_mb_10 td_fs_18 td_mb_20">{{ $event['sidebar']['description'] }}</p>

          <div class="td_mb_30">
            <ul class="td_card_list td_mp_0 td_fs_18 td_semibold">
              <li>
                <span class="td_heading_color">{{ $event['sidebar']['labels']['cost'] }}</span>
                <span class="td_accent_color">{{ $event['sidebar']['values']['cost'] }}</span>
              </li>
              <li>
                <span class="td_heading_color">{{ $event['sidebar']['labels']['total_slots'] }}</span>
                <span class="td_accent_color">{{ $event['sidebar']['values']['total_slots'] }}</span>
              </li>
              <li>
                <span class="td_heading_color">{{ $event['sidebar']['labels']['booked_slots'] }}</span>
                <span class="td_accent_color">{{ $event['sidebar']['values']['booked_slots'] }}</span>
              </li>
            </ul>
          </div>

          <a href="{{ $event['sidebar']['button_url'] }}" class="td_btn td_style_1 td_radius_10 td_medium w-100 td_mb_20">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $event['sidebar']['button_text'] }}</span>
            </span>
          </a>

          <p class="text-center td_fs_18 td_heading_color td_opacity_7 td_mb_15">
            {{ $event['sidebar']['countdown_text'] }}
          </p>

          <div class="td_countdown td_style_1" data-countdate="{{ $event['sidebar']['countdown_date'] }}">
            <div class="td_countdown_box">
              <span class="td_count_days"></span>{{ $event['sidebar']['countdown_labels']['days'] }}
            </div>
            <div class="td_countdown_box">
              <span class="td_count_hours"></span>{{ $event['sidebar']['countdown_labels']['hours'] }}
            </div>
            <div class="td_countdown_box">
              <span class="td_count_minutes"></span>{{ $event['sidebar']['countdown_labels']['minutes'] }}
            </div>
            <div class="td_countdown_box">
              <span class="td_count_seconds"></span>{{ $event['sidebar']['countdown_labels']['seconds'] }}
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
