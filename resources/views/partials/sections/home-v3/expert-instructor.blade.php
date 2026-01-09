@php($expert_instructor = isset($expert_instructor['data']) && is_array($expert_instructor['data']) ? $expert_instructor['data'] : $expert_instructor)

<section class="td_gray_bg_4">
  <div class="td_height_{{ $expert_instructor['spacing']['top'] }} td_height_lg_{{ $expert_instructor['spacing']['top_lg'] }}"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_40">

      {{-- LEFT CONTENT --}}
      <div class="col-lg-6 wow fadeInLeft"
           data-wow-duration="1s"
           data-wow-delay="{{ $expert_instructor['animations']['left_delay'] }}s">

        <div class="td_pr_50">
          <div class="td_section_heading td_style_1">
            <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
              {{ $expert_instructor['heading']['subtitle'] }}
            </p>

            <h2 class="td_section_title td_fs_48 td_mb_20">
              {{ $expert_instructor['heading']['title'] }}
            </h2>

            <p class="td_section_subtitle td_fs_18 td_mb_43">
              {!! nl2br(e($expert_instructor['heading']['description'])) !!}
            </p>

            <a href="{{ $expert_instructor['button']['url'] }}"
               class="td_btn td_style_1 td_radius_30 td_medium">
              <span class="td_btn_in td_white_color td_accent_bg">
                <span>{{ $expert_instructor['button']['label'] }}</span>
                @include('svg.home-v3.expert-instructor.arrow')
              </span>
            </a>
          </div>
        </div>
      </div>

      {{-- RIGHT TEAM --}}
      <div class="col-lg-6 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="{{ $expert_instructor['animations']['right_delay'] }}s">

        <div class="row td_gap_y_24 td_row_gap_30">

          @foreach($expert_instructor['members'] as $member)
            <div class="col-md-6">
              <div class="td_team td_style_2 text-center position-relative td_radius_10">
                <div class="td_team_in">
                  <img src="{{ asset($member['image']) }}"
                       alt="{{ $member['name'] }}"
                       class="w-100 td_radius_10">

                  <div class="td_team_info">
                    <div class="td_team_info_in">
                      <h3 class="td_team_member_title td_fs_16 td_semibold td_white_color mb-0">
                        {{ $member['name'] }}
                      </h3>
                      <p class="td_team_member_designation mb-0 td_fs_14 td_white_color td_opacity_9">
                        {{ $member['designation'] }}
                      </p>

                      <ul class="td_team_member_meta_list td_mp_0">
                        <li>
                          <img src="{{ asset($member['meta']['students_icon']) }}" alt="">
                          <span class="td_white_color td_opacity_7 td_fs_14">
                            {{ $member['meta']['students'] }}
                          </span>
                        </li>
                        <li>
                          <img src="{{ asset($member['meta']['courses_icon']) }}" alt="">
                          <span class="td_white_color td_opacity_7 td_fs_14">
                            {{ $member['meta']['courses'] }}
                          </span>
                        </li>
                      </ul>
                    </div>

                    @include('svg.home-v3.expert-instructor.team-bg')
                  </div>
                </div>

                <div class="td_team_shape_1"></div>
                <div class="td_team_shape_2"></div>
              </div>
            </div>
          @endforeach

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_{{ $expert_instructor['spacing']['bottom'] }} td_height_lg_{{ $expert_instructor['spacing']['bottom_lg'] }}"></div>
</section>
