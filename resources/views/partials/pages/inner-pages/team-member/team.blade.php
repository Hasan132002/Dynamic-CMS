<section>
      <div class="td_height_120 td_height_lg_80"></div>
      <div class="container">
        <div class="row td_gap_y_30">

          @foreach($team['members'] as $member)
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="td_team td_style_3 text-center position-relative">
              <div class="td_team_thumb_wrap td_mb_20">
                <div class="td_team_thumb">
                  <img src="{{ asset($member['image']) }}" alt="" class="w-100 td_radius_10">
                </div>
                <img class="td_team_thumb_shape" src="{{ asset($team['thumb_shape']) }}" alt="">
              </div>
              <div class="td_team_info td_white_bg">
                <h3 class="td_team_member_title td_fs_24 td_semibold mb-0">{{ $member['name'] }}</h3>
                <p class="td_team_member_designation mb-0 td_fs_18 td_opacity_7 td_heading_color">
                  {{ $member['designation'] }}
                </p>
              </div>
            </div>
          </div>
          @endforeach

        </div>

        <div class="td_height_60 td_height_lg_40"></div>

        <ul class="td_page_pagination td_mp_0 td_fs_18 td_semibold">
          <li>
            <button class="td_page_pagination_item td_center" type="button">
              <i class="fa-solid fa-angles-left"></i>
            </button>
          </li>

          @foreach($team['pagination']['pages'] as $page)
          <li>
            <a class="td_page_pagination_item td_center {{ $loop->first ? 'active' : '' }}" href="#">
              {{ $page }}
            </a>
          </li>
          @endforeach

          <li>
            <button class="td_page_pagination_item td_center" type="button">
              <i class="fa-solid fa-angles-right"></i>
            </button>
          </li>
        </ul>
      </div>
      <div class="td_height_120 td_height_lg_80"></div>
    </section>
