@php
  $section = isset($team['data']) && is_array($team['data']) ? $team['data'] : ($team ?? null);
@endphp

@if($section)
<section class="{{ $section['section_classes'] }}">

  {{-- SHAPES --}}
  @foreach($section['shapes'] as $shape)
    <div class="{{ $shape['class'] }} position-absolute">
      <img src="{{ asset($shape['src']) }}" alt="">
    </div>
  @endforeach

  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    {{-- HEADING --}}
    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        <i></i>
        {{ $section['subtitle'] }}
        <i></i>
      </p>

      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $section['title'] }}
      </h2>

      <p class="td_section_subtitle td_fs_18 mb-0">
        {!! $section['description'] !!}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    {{-- TEAM MEMBERS --}}
    <div class="row td_gap_y_30">
      @php $delay = 0.25; @endphp

      @foreach($section['members'] as $member)
        <div class="col-lg-3 col-sm-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $delay }}s">

          <div class="td_team td_style_1 text-center position-relative">
            <img src="{{ asset($member['image']) }}"
                 alt=""
                 class="w-100 td_radius_10">

            <div class="td_team_info td_white_bg">
              <h3 class="td_team_member_title td_fs_18 td_semibold mb-0">
                {{ $member['name'] }}
              </h3>
              <p class="td_team_member_designation mb-0 td_fs_14 td_opacity_7 td_heading_color">
                {{ $member['designation'] }}
              </p>
            </div>
          </div>
        </div>

        @php $delay += 0.05; @endphp
      @endforeach
    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    {{-- BUTTON --}}
    <div class="text-center wow zoomIn"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <a href="{{ $section['button']['url'] }}"
         class="td_btn td_style_1 td_radius_30 td_medium">

        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $section['button']['text'] }}</span>
          @includeIf('svg.home-v2.team.' . $section['button']['icon'])
        </span>

      </a>
    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
@endif
