@php($instructor = isset($instructor['data']) && is_array($instructor['data']) ? $instructor['data'] : $instructor)

<section>
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">
        {{ $instructor['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $instructor['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">
      @foreach($instructor['members'] as $member)
        <div class="col-xl-3 col-sm-6 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $member['delay'] }}">
          <div class="td_team td_style_5 td_type_1 text-center">
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
                  <a href="{{ $member['profile_url'] }}">{{ $member['name'] }}</a>
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

    <div class="td_height_60 td_height_lg_40"></div>

    <div class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
      <a href="{{ $instructor['button']['url'] }}"
         class="td_btn td_style_1 td_type_2 td_radius_30 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $instructor['button']['label'] }}</span>
          <span class="td_btn_icon td_center td_accent_bg td_white_color">
            @include('svg.home-v7.instructor.arrow')
          </span>
        </span>
      </a>
    </div>

  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
