@php($team = isset($team['data']) && is_array($team['data']) ? $team['data'] : $team)

<section>
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">
        {{ $team['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $team['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">
      @foreach($team['members'] as $index => $member)
        <div class="col-xl-3 col-sm-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $member['delay'] }}">
          <div class="td_team td_style_5 text-center">

            <div class="td_team_thumb d-block td_mb_16">
              <img src="{{ asset($member['image']) }}" alt="" class="w-100">
              <div class="td_team_social_list td_fs_14 td_white_color">
                @foreach($member['socials'] as $social)
                  <a href="{{ $social['url'] }}">
                    <i class="{{ $social['icon'] }}"></i>
                  </a>
                @endforeach
              </div>
            </div>

            <div class="td_team_info">
              <div class="td_team_info_in">
                <h3 class="td_team_member_title td_fs_20 mb-0">
                  <a href="{{ $member['profile_url'] }}">
                    {{ $member['name'] }}
                  </a>
                </h3>
                <p class="td_team_member_designation mb-0 td_fs_16 td_opacity_6 td_heading_color">
                  {{ $member['designation'] }}
                </p>
              </div>
            </div>

          </div>
        </div>
      @endforeach
    </div>

  </div>
  <div class="td_height_112 td_height_lg_75"></div>
</section>
