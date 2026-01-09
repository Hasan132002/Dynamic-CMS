@php
  $section = isset($event_schedule['data']) && is_array($event_schedule['data']) ? $event_schedule['data'] : ($event_schedule ?? null);
@endphp

@if($section)
<section class="{{ $section['section_classes'] }}">
  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    {{-- SECTION HEADING --}}
    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_white_color td_opacity_9">
          <i></i>
          {{ $section['subtitle'] }}
          <i></i>
        </p>

        <h2 class="td_section_title td_fs_48 mb-0 td_white_color">
          {{ $section['title'] }}
        </h2>
      </div>

      <div class="td_section_heading_right">
        <p class="td_section_subtitle td_fs_18 mb-0 td_white_color">
          {{ $section['description'] }}
        </p>
      </div>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    {{-- EVENTS --}}
    <div class="row td_gap_y_30">
      @php $delay = 0.25; @endphp

      @foreach($section['events'] as $event)
        <div class="col-lg-12 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $delay }}s">

          <div class="td_card td_style_1 td_type_2 td_white_bg">

            <a href="{{ $event['detail_url'] }}" class="td_card_thumb d-block">
              <img src="{{ asset($event['image']) }}" alt="">
              <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

            <div class="td_card_info">
              <div class="td_card_info_in">

                <div class="td_mb_30">
                  <ul class="td_card_meta td_mp_0 td_medium td_heading_color">

                    <li>
                      @includeIf('svg.home-v2.event-schedule.' . ($event['icons']['date'] ?? ''))
                      <span>{{ $event['date'] }}</span>
                    </li>

                    <li>
                      @includeIf('svg.home-v2.event-schedule.' . ($event['icons']['time'] ?? ''))
                      <span>{{ $event['time'] }}</span>
                    </li>

                    <li>
                      @includeIf('svg.home-v2.event-schedule.' . ($event['icons']['location'] ?? ''))
                      <span>{{ $event['location'] }}</span>
                    </li>

                  </ul>
                </div>

                <h2 class="td_card_title td_fs_32 td_semibold td_mb_25">
                  <a href="{{ $event['detail_url'] }}">
                    {{ $event['title'] }}
                  </a>
                </h2>

                <p class="td_fs_18 td_mb_40">
                  {{ $event['excerpt'] }}
                </p>

                <a href="{{ $event['button']['url'] }}"
                   class="td_btn td_style_1 td_radius_30 td_medium td_with_shadow">

                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ $event['button']['text'] }}</span>
                    @includeIf('svg.home-v2.event-schedule.' . ($event['button']['icon'] ?? ''))
                  </span>

                </a>

              </div>
            </div>
          </div>
        </div>

        @php $delay += 0.05; @endphp
      @endforeach
    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
@endif
