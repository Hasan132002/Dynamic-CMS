<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_40">
      <div class="col-lg-5">
        <div class="td_team_details_left">
          <div class="td_team_details_thumb td_accent_bg text-center td_radius_10 td_mb_30">
            <img src="{{ asset($details['image']) }}" alt="" class="td_radius_10 w-100">
          </div>

          <div class="td_mb_30">
            <ul class="td_team_member_contact_list td_mp_0 td_fs_18 td_semibold td_heading_color">
              <li>
                <i class="td_team_member_contact_icon td_center td_accent_color">
                  @include('svg.pages.team-member-details.phone')
                </i>
                <a href="tel:{{ $details['phone'] }}">{{ $details['phone'] }}</a>
              </li>
              <li>
                <i class="td_team_member_contact_icon td_center td_accent_color">
                  @include('svg.pages.team-member-details.email')
                </i>
                <a href="mailto:{{ $details['email'] }}">{{ $details['email'] }}</a>
              </li>
              <li>
                <i class="td_team_member_contact_icon td_center td_accent_color">
                  @include('svg.pages.team-member-details.location')
                </i>
                <span>{{ $details['address'] }}</span>
              </li>
            </ul>
          </div>

          <div class="td_btns_group">
            <a href="{{ $details['contact_url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
              <span class="td_btn_in td_white_color td_accent_bg">
                <span>{{ $details['contact_text'] }}</span>
                @include('svg.pages.team-member-details.arrow')
              </span>
            </a>

            <a href="#" class="td_btn td_style_1 td_type_5 td_radius_10 td_medium">
              <span class="td_btn_in td_accent_color">
                @include('svg.pages.team-member-details.share')
                <span>{{ $details['share_text'] }}</span>
              </span>
            </a>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="td_team_details_content">
          <div class="td_section_heading td_style_2 td_mb_20">
            <h2 class="td_contact_info_title td_fs_36 mb-0">{{ $details['name'] }}</h2>
            <p class="td_medium mb-0 td_heading_color td_opacity_5">{{ $details['designation'] }}</p>
          </div>

          <p class="td_fs_18 td_mb_40">{{ $details['about'] }}</p>

          <div class="td_section_heading td_style_2 td_mb_20">
            <h2 class="td_contact_info_title td_fs_36 mb-0">{{ $details['skills_title'] }}</h2>
          </div>

          <p class="td_fs_18 td_mb_34">{{ $details['skills_desc'] }}</p>

          <div class="td_mb_40">
            @foreach($details['skills'] as $skill)
            <div class="td_progress_wrap td_mb_24">
              <h3 class="td_fs_16 td_semibold td_mb_5">{{ $skill['title'] }}</h3>
              <div class="td_progress" data-progress="{{ rtrim($skill['percent'], '%') }}">
                <div class="td_progress_in td_accent_bg">
                  <span class="td_accent_bg td_white_color td_fs_12 td_bold">{{ $skill['percent'] }}</span>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <p class="td_fs_18 mb-0">{{ $details['footer_text'] }}</p>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
