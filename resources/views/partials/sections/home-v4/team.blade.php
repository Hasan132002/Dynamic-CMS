@php($team = isset($team['data']) && is_array($team['data']) ? $team['data'] : $team)

<section>
  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1
                td_mb_10 text-uppercase td_accent_color">
        {{ $team['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $team['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_24">

      @foreach($team['members'] as $member)
        <div class="col-lg-3 col-sm-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $member['delay'] }}">

          <div class="td_team td_style_3 text-center position-relative">
            <div class="td_team_thumb_wrap td_mb_20">
              <div class="td_team_thumb">
                <img src="{{ asset($member['image']) }}"
                     alt=""
                     class="w-100 td_radius_10">
              </div>
              <img class="td_team_thumb_shape"
                   src="{{ asset($team['thumb_shape']) }}"
                   alt="">
            </div>

            <div class="td_team_info td_white_bg">
              <h3 class="td_team_member_title td_fs_24 td_semibold mb-0">
                {{ $member['name'] }}
              </h3>
              <p class="td_team_member_designation mb-0 td_fs_18
                        td_opacity_7 td_heading_color">
                {{ $member['designation'] }}
              </p>
            </div>
          </div>

        </div>
      @endforeach

    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="td_team_3_footer text_center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.3s">

      <b class="td_fs_18 td_normal td_fs_18 td_heading_color">
        {{ $team['footer']['text'] }}
      </b>

      <a href="{{ $team['footer']['button']['url'] }}"
         class="td_btn td_style_1 td_radius_30 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $team['footer']['button']['label'] }}</span>
          @include('svg.home-v4.team.team-btn-arrow')
        </span>
      </a>

    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
