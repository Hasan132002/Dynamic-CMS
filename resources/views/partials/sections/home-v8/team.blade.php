@php($team = isset($team['data']) && is_array($team['data']) ? $team['data'] : $team)

<section class="">
  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $team['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $team['title'] }}
      </h2>
      <p class="td_section_subtitle td_fs_18 mb-0">
        {!! $team['description'] !!}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">
      @foreach($team['members'] as $member)
        <div class="col-xl-3 col-sm-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ $member['delay'] }}">
          <div class="td_team td_style_1 td_type_1 text-center position-relative">
            <img src="{{ asset($member['image']) }}" alt="" class="w-100 td_radius_10">
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
      @endforeach
    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    <div class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
      <a href="{{ $team['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $team['button']['label'] }}</span>
          @include('svg.home-v8.team.arrow-icon')
        </span>
      </a>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
