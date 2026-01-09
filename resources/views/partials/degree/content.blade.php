<section class="td_degree_section">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3">
        <div class="td_sidebar td_sticky_sidebar">
          <ul class="td_sidebar_menu td_mp_0">
            @foreach($sidebar as $index => $item)
            <li class="td_sidebar_item">
              <a href="#{{ $item['id'] }}"
                 class="td_sidebar_link td_fs_18 td_medium d-block {{ $index === 0 ? 'active' : '' }}">
                {{ $item['label'] }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-lg-9">
        <div class="td_degree_content">

          <!-- Program Overview Section -->
          <div id="program-overview" class="td_content_section td_content_box">
            <h2 class="td_fs_36 td_semibold td_heading_color td_mb_24">PROGRAM OVERVIEW</h2>

            <!-- Program Stats -->
            <div class="td_program_stats td_mb_30">
              <div class="td_program_stat_item">
                <p class="td_fs_14 td_heading_color td_text_muted mb-1">Duration</p>
                <p class="td_fs_16 td_semibold td_accent_color mb-0">{{ $program['overview']['duration'] }}</p>
              </div>
              <div class="td_program_stat_item">
                <p class="td_fs_14 td_heading_color td_text_muted mb-1">Total Courses</p>
                <p class="td_fs_16 td_semibold td_accent_color mb-0">{{ $program['overview']['total_courses'] }}</p>
              </div>
              <div class="td_program_stat_item td_no_border">
                <p class="td_fs_14 td_heading_color td_text_muted mb-1">Total Credit Hours</p>
                <p class="td_fs_16 td_semibold td_accent_color mb-0">{{ $program['overview']['credit_hours'] }}</p>
              </div>
            </div>

            <p class="td_fs_16 td_heading_color td_text_muted_light td_content_text">
              {{ $program['overview']['description'] }}
            </p>

            @foreach($program['overview']['sections'] as $section)
            <div class="td_content_subsection">
              <h3 class="td_fs_24 td_semibold td_heading_color td_mb_12">{{ $section['title'] }}:</h3>
              <p class="td_fs_16 td_heading_color td_text_muted_light td_leading_spacious">
                {{ $section['content'] }}
              </p>
            </div>
            @endforeach
          </div>

          <!-- Curriculum Section -->
          <div id="curriculum" class="td_content_section td_content_box">
            <h2 class="td_fs_36 td_semibold td_heading_color td_mb_24">CURRICULUM</h2>

            @foreach($program['curriculum'] as $year)
            <div class="td_curriculum_year td_mb_30">
              <h3 class="td_fs_20 td_semibold td_white_color td_accent_bg td_curriculum_year_header">
                {{ $year['year'] }}
              </h3>
              <div class="td_curriculum_courses">
                @foreach($year['courses'] as $course)
                <div class="td_curriculum_course_item">
                  <span class="td_fs_16 td_heading_color">{{ $course['name'] }}</span>
                  <span class="td_fs_16 td_heading_color td_text_muted">{{ $course['credits'] }} Credit Hours</span>
                </div>
                @endforeach
              </div>
            </div>
            @endforeach
          </div>

          <!-- Tuition Fee Section -->
          <div id="tuition-fee" class="td_content_section td_content_box">
            <h2 class="td_fs_36 td_semibold td_heading_color td_mb_24">TUITION FEE</h2>

            <div class="td_tuition_table">
              <div class="td_tuition_header">
                <span class="td_fs_16 td_semibold td_heading_color">Description</span>
                <span class="td_fs_16 td_semibold td_heading_color">Amount</span>
              </div>
              @foreach($program['tuition']['items'] as $item)
              <div class="td_tuition_row">
                <span class="td_fs_16 td_heading_color">{{ $item['description'] }}</span>
                <span class="td_fs_16 td_heading_color">{{ $item['amount'] }}</span>
              </div>
              @endforeach
              <div class="td_tuition_footer">
                <span class="td_fs_18 td_semibold td_heading_color">Total Tuition</span>
                <span class="td_fs_18 td_semibold td_accent_color">{{ $program['tuition']['total'] }}</span>
              </div>
            </div>

            @if(!empty($program['tuition']['note']))
            <p class="td_fs_14 td_heading_color td_text_muted td_tuition_note">
              {{ $program['tuition']['note'] }}
            </p>
            @endif
          </div>

          <!-- Admissions & Eligibility Section -->
          <div id="admissions" class="td_content_section td_content_box">
            <h2 class="td_fs_36 td_semibold td_heading_color td_mb_24">ADMISSIONS & ELIGIBILITY</h2>

            @foreach($program['admissions']['sections'] as $section)
            <div class="td_content_subsection">
              <h3 class="td_fs_20 td_semibold td_heading_color td_mb_12">{{ $section['title'] }}</h3>
              @if(isset($section['content']))
              <p class="td_fs_16 td_heading_color td_text_muted_light td_leading_spacious">
                {{ $section['content'] }}
              </p>
              @endif
              @if(isset($section['items']))
              <ul class="td_admission_list">
                @foreach($section['items'] as $item)
                <li class="td_fs_16 td_heading_color td_text_muted_light">
                  {{ $item }}
                </li>
                @endforeach
              </ul>
              @endif
            </div>
            @endforeach

            <!-- Apply Now Button -->
            <div class="td_apply_wrap">
              <a href="{{ $program['admissions']['apply_url'] ?? '#' }}" class="td_btn td_style_1 td_radius_10 td_medium td_apply_btn">
                <span class="td_btn_in td_white_color td_accent_bg">
                  <span>Apply Now</span>
                  <i class="fa-solid fa-arrow-right"></i>
                </span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
