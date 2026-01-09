@php($course = $course)

<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_50">
      <div class="col-lg-8">
        <div class="td_course_details">

          <div class="embed-responsive embed-responsive-16by9 td_radius_10 td_mb_40">
            <iframe class="embed-responsive-item" src="{{ $course['video']['embed'] }}" allowfullscreen></iframe>
          </div>

          <span class="td_course_label td_mb_10">{{ $course['category'] }}</span>
          <h2 class="td_fs_48 td_mb_30">{{ $course['title'] }}</h2>

          <div class="td_course_meta td_mb_40">
            <div class="td_course_avatar">
              <img src="{{ asset($course['trainer']['image']) }}" alt="">
              <p class="td_heading_color mb-0 td_medium">
                <span class="td_accent_color">Trainer:</span>
                <a href="#">{{ $course['trainer']['name'] }}</a>
              </p>
            </div>
            <div class="td_course_published td_medium td_heading_color">
              <span class="td_accent_color">Last Update:</span> {{ $course['last_update'] }}
            </div>
          </div>

          <div class="td_tabs td_style_1 td_mb_50">
            <ul class="td_tab_links td_style_2 td_type_2 td_mp_0 td_medium td_fs_20 td_heading_color">
              @foreach($course['tabs'] as $tab)
                <li class="{{ $loop->first ? 'active' : '' }}">
                  <a href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
                </li>
              @endforeach
            </ul>

            <div class="td_tab_body td_fs_18">
              @foreach($course['tabs'] as $tab)
                <div class="td_tab {{ $loop->first ? 'active' : '' }}" id="{{ $tab['id'] }}">
                  <h2 class="td_fs_48 td_mb_20">{{ $tab['title'] }}</h2>
                  <p class="mb-0">{!! $tab['content'] !!}</p>
                </div>
              @endforeach
            </div>
          </div>

          <h2 class="td_fs_48 td_mb_30">{{ $course['learn_title'] }}</h2>

          <ul class="td_list td_style_2 td_type_2 td_fs_18 td_medium td_heading_color td_mp_0">
            @foreach($course['learn_points'] as $point)
              <li>
                @include('svg.courses.courses-details.check-circle')
                {{ $point }}
              </li>
            @endforeach
          </ul>

          <div class="td_height_60 td_height_lg_40"></div>

          <h4 class="td_fs_24 td_semibold td_mb_20">{{ $course['requirements']['title'] }}</h4>

          <div class="td_requirements_list td_medium td_fs_18">
            @foreach($course['requirements']['items'] as $req)
              <span class="td_requirement">
                @include('svg.courses.courses-details.' . $req['icon'])
                {{ $req['label'] }}
              </span>
            @endforeach
          </div>

        </div>
      </div>

      <div class="col-lg-4">
        <div class="td_card td_style_7">

          <a href="{{ $course['sidebar']['video'] }}" class="td_card_video_block td_video_open d-block">
            <img src="{{ asset($course['sidebar']['thumbnail']) }}" alt="">
            <span class="td_player_btn_wrap_2">
              <span class="td_player_btn td_center"><span></span></span>
            </span>
          </a>

          <div class="td_height_30 td_height_lg_30"></div>

          <h3 class="td_fs_20 td_semibold td_mb_15">{{ $course['sidebar']['title'] }}</h3>

          <ul class="td_card_list td_mp_0 td_fs_18 td_medium">
            @foreach($course['sidebar']['meta'] as $meta)
              <li>
                <span>
                  @include('svg.courses.courses-details.' . $meta['icon'])
                  {{ $meta['label'] }} :
                </span>
                <span class="td_semibold td_accent_color">{{ $meta['value'] }}</span>
              </li>
            @endforeach
          </ul>

          <div class="td_height_30 td_height_lg_30"></div>

          <a href="{{ $course['sidebar']['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium w-100">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $course['sidebar']['button']['label'] }}</span>
            </span>
          </a>

          <div class="td_height_40 td_height_lg_30"></div>

          <h3 class="td_fs_20 td_semibold td_mb_15">{{ $course['sidebar']['share_title'] }}</h3>

          <div class="td_footer_social_btns td_fs_18 td_accent_color">
            @foreach($course['sidebar']['social'] as $social)
              <a href="{{ $social['url'] }}" class="td_center">
                <i class="{{ $social['icon'] }}"></i>
              </a>
            @endforeach
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
