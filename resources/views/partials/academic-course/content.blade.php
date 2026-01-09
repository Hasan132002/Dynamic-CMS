<section class="td_academic_course_section">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="row">
      <!-- Main Content -->
      <div class="col-lg-8">
        <div class="td_course_content_wrapper">

          <!-- Course Image -->
          @if(!empty($course['image']))
          <div class="td_course_image td_mb_30">
            <img src="{{ asset($course['image']) }}" alt="{{ $course['title'] }}" class="w-100 td_radius_10 td_course_img">
          </div>
          @endif

          <!-- Course Overview -->
          <div class="td_content_section td_course_box td_mb_40">
            <h2 class="td_fs_28 td_semibold td_heading_color td_mb_16">Course Overview</h2>
            <p class="td_fs_16 td_heading_color td_opacity_8 td_leading_spacious mb-0">
              {{ $course['overview'] }}
            </p>
          </div>

          <!-- What You'll Learn -->
          @if(!empty($course['learning_outcomes']))
          <div class="td_content_section td_course_box td_mb_40">
            <h2 class="td_fs_28 td_semibold td_heading_color td_mb_20">What You'll Learn</h2>
            <div class="row">
              @foreach($course['learning_outcomes'] as $outcome)
              <div class="col-md-6 td_mb_14">
                <div class="td_outcome_item d-flex align-items-start">
                  <i class="fa-solid fa-check-circle td_accent_color td_fs_16 td_outcome_icon"></i>
                  <span class="td_fs_15 td_heading_color td_opacity_9">{{ $outcome }}</span>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          <!-- Curriculum -->
          @if(!empty($course['curriculum']))
          <div class="td_content_section td_course_box td_mb_40">
            <h2 class="td_fs_28 td_semibold td_heading_color td_mb_20">Curriculum</h2>

            @foreach($course['curriculum'] as $index => $semester)
            <div class="td_curriculum_semester td_mb_20">
              <div class="td_semester_header td_accent_bg td_white_color td_fs_16 td_semibold">
                <div class="d-flex justify-content-between align-items-center">
                  <span>{{ $semester['title'] }}</span>
                  <span class="td_fs_14 td_opacity_8">{{ count($semester['subjects']) }} Subjects</span>
                </div>
              </div>
              <div class="td_semester_content">
                @foreach($semester['subjects'] as $subject)
                <div class="td_subject_row d-flex justify-content-between align-items-center">
                  <div class="d-flex align-items-center">
                    <i class="fa-regular fa-file-lines td_accent_color td_subject_icon"></i>
                    <span class="td_fs_15 td_heading_color">{{ $subject['name'] }}</span>
                  </div>
                  <span class="td_fs_14 td_heading_color td_opacity_6">{{ $subject['credits'] }} Credits</span>
                </div>
                @endforeach
              </div>
            </div>
            @endforeach
          </div>
          @endif

          <!-- Requirements -->
          @if(!empty($course['requirements']))
          <div class="td_content_section td_course_box">
            <h2 class="td_fs_28 td_semibold td_heading_color td_mb_16">Requirements</h2>
            <ul class="td_requirements_list">
              @foreach($course['requirements'] as $req)
              <li class="td_fs_15 td_heading_color td_opacity_8">
                {{ $req }}
              </li>
              @endforeach
            </ul>
          </div>
          @endif

        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4">
        <div class="td_course_sidebar">

          <!-- Course Info Card -->
          <div class="td_sidebar_card td_course_info_card td_mb_24">

            <!-- Price -->
            @if(!empty($course['price']))
            <div class="td_price_wrap td_mb_24 text-center">
              <span class="td_fs_40 td_bold td_accent_color">{{ $course['price'] }}</span>
              @if(!empty($course['original_price']))
              <span class="td_fs_18 td_heading_color td_opacity_5 td_price_original">{{ $course['original_price'] }}</span>
              @endif
            </div>
            @endif

            <!-- Course Meta -->
            <div class="td_course_meta">
              <div class="td_meta_row d-flex justify-content-between align-items-center">
                <span class="td_fs_15 td_heading_color"><i class="fa-solid fa-users td_accent_color td_meta_icon"></i> Seats Available</span>
                <span class="td_fs_15 td_semibold td_heading_color">{{ $course['seats'] }}</span>
              </div>
              <div class="td_meta_row d-flex justify-content-between align-items-center">
                <span class="td_fs_15 td_heading_color"><i class="fa-regular fa-calendar td_accent_color td_meta_icon"></i> Semesters</span>
                <span class="td_fs_15 td_semibold td_heading_color">{{ $course['semesters'] }}</span>
              </div>
              <div class="td_meta_row d-flex justify-content-between align-items-center">
                <span class="td_fs_15 td_heading_color"><i class="fa-solid fa-clock td_accent_color td_meta_icon"></i> Duration</span>
                <span class="td_fs_15 td_semibold td_heading_color">{{ $course['duration'] ?? 'Self-Paced' }}</span>
              </div>
              <div class="td_meta_row d-flex justify-content-between align-items-center">
                <span class="td_fs_15 td_heading_color"><i class="fa-solid fa-signal td_accent_color td_meta_icon"></i> Level</span>
                <span class="td_fs_15 td_semibold td_heading_color">{{ $course['level'] ?? 'All Levels' }}</span>
              </div>
              <div class="td_meta_row d-flex justify-content-between align-items-center">
                <span class="td_fs_15 td_heading_color"><i class="fa-solid fa-language td_accent_color td_meta_icon"></i> Language</span>
                <span class="td_fs_15 td_semibold td_heading_color">{{ $course['language'] ?? 'English' }}</span>
              </div>
              <div class="td_meta_row td_meta_row_last d-flex justify-content-between align-items-center">
                <span class="td_fs_15 td_heading_color"><i class="fa-solid fa-certificate td_accent_color td_meta_icon"></i> Certificate</span>
                <span class="td_fs_15 td_semibold td_heading_color">{{ $course['certificate'] ?? 'Yes' }}</span>
              </div>
            </div>

            <!-- Enroll Button -->
            <div class="td_mt_24">
              <a href="{{ $course['enroll_url'] ?? '#' }}" class="td_btn td_style_1 td_radius_10 td_medium w-100 td_enroll_btn">
                <span class="td_btn_in td_white_color td_accent_bg d-flex align-items-center justify-content-center">
                  <span>Enroll Now</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </span>
              </a>
            </div>

          </div>

          <!-- Instructor Card -->
          @if(!empty($course['instructor']))
          <div class="td_sidebar_card td_instructor_card">
            <h3 class="td_fs_18 td_semibold td_heading_color td_mb_16">Instructor</h3>
            <div class="d-flex align-items-center">
              @if(!empty($course['instructor']['image']))
              <img src="{{ asset($course['instructor']['image']) }}" alt="{{ $course['instructor']['name'] }}" class="td_instructor_img">
              @else
              <div class="td_instructor_placeholder">
                <i class="fa-solid fa-user td_fs_24 td_opacity_5"></i>
              </div>
              @endif
              <div>
                <h4 class="td_fs_18 td_semibold td_heading_color mb-1">{{ $course['instructor']['name'] }}</h4>
                <p class="td_fs_14 td_heading_color td_opacity_7 mb-0">{{ $course['instructor']['title'] }}</p>
              </div>
            </div>
          </div>
          @endif

        </div>
      </div>
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
