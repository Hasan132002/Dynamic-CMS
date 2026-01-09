<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_30">

      @foreach($events['items'] as $event)
      <div class="col-lg-6">
        <div class="td_card td_style_1 td_radius_5">
          <a href="{{ $event['url'] }}" class="td_card_thumb td_mb_30 d-block">
            <img src="{{ asset($event['image']) }}" alt="">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span class="td_card_location td_medium td_white_color td_fs_18">
              @include('svg.pages.upcoming-event.location')
              {{ $event['location'] }}
            </span>
          </a>

          <div class="td_card_info">
            <div class="td_card_info_in">
              <div class="td_mb_30">
                <ul class="td_card_meta td_mp_0 td_fs_18 td_medium td_heading_color">
                  <li>
                    @include('svg.pages.upcoming-event.calendar')
                    <span>{{ $event['date'] }}</span>
                  </li>
                  <li>
                    @include('svg.pages.upcoming-event.clock')
                    <span>{{ $event['time'] }}</span>
                  </li>
                </ul>
              </div>

              <h2 class="td_card_title td_fs_32 td_semibold td_mb_20">
                <a href="{{ $event['url'] }}">{{ $event['title'] }}</a>
              </h2>

              <p class="td_mb_30 td_fs_18">{{ $event['description'] }}</p>

              <a href="{{ $event['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
                <span class="td_btn_in td_white_color td_accent_bg">
                  <span>Learn More</span>
                  @include('svg.pages.upcoming-event.arrow')
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    <div class="text-center">
      <a href="{{ $events['load_more']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $events['load_more']['text'] }}</span>
          @include('svg.pages.upcoming-event.arrow')
        </span>
      </a>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
