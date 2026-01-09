<section class="td_gray_bg_3">
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.15s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $featured_programs['heading']['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $featured_programs['heading']['title'] }}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <!-- Carousel Wrapper -->
    <div class="td_featured_carousel_wrapper">
      <div class="td_featured_carousel">
        <div class="td_carousel_track">
          @foreach ($featured_programs['programs'] as $index => $program)
          <div class="td_carousel_item">
            <a href="{{ $program['url'] ?? '#' }}" class="td_program_card_link">
              <div class="td_featured_program_card">
                <span class="td_fs_14 td_white_color td_accent_bg td_radius_5 td_program_badge">
                  {{ $program['degree'] }}
                </span>

                <h2 class="td_fs_20 td_semibold td_heading_color td_program_title">
                  {{ $program['title'] }}
                </h2>

                @if($program['accredited'])
                <p class="td_accent_color td_medium td_fs_14 td_program_accredited">
                  <i class="fa-solid fa-check-circle"></i> Accredited
                </p>
                @endif

                <div class="td_fs_14 td_heading_color td_program_meta">
                  <div class="td_opacity_7 td_program_meta_item">
                    <i class="fa-solid fa-dollar-sign"></i>
                    {{ $program['tuition'] }}
                  </div>
                  <div class="td_opacity_7 td_program_meta_item">
                    <i class="fa-regular fa-clock"></i>
                    {{ $program['mode'] }}
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Carousel Navigation -->
      <button class="td_carousel_btn td_carousel_prev">
        <i class="fa-solid fa-chevron-left td_heading_color"></i>
      </button>
      <button class="td_carousel_btn td_carousel_next">
        <i class="fa-solid fa-chevron-right td_heading_color"></i>
      </button>

      <!-- Carousel Dots -->
      <div class="td_carousel_dots"></div>
    </div>

    <div class="td_height_50 td_height_lg_40"></div>

    <div class="text-center">
      <a href="{{ $featured_programs['cta']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium td_cta_btn">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $featured_programs['cta']['text'] }}</span>
          <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>
    </div>
  </div>
</section>
