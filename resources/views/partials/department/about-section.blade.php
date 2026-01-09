<section class="td_about_section_dept">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_40">
      <!-- Left Image with Accent -->
      <div class="col-lg-5 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.25s">
        <div class="td_about_image_wrap position-relative">
          <img src="{{ asset($about['image']) }}" alt="{{ $about['title'] }}" class="td_about_image_dept">
          <!-- Bottom Left Accent -->
          <div class="td_about_accent_line"></div>
        </div>
      </div>

      <!-- Right Content -->
      <div class="col-lg-7 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="td_pl_lg_30">
          <!-- Title with Side Accent -->
          <div class="d-flex align-items-start td_mb_20">
            <div class="td_side_accent_bar"></div>
            <div>
              <span class="td_fs_14 td_semibold td_spacing_1 text-uppercase td_accent_color d-block td_mb_8">
                {{ $about['subtitle'] }}
              </span>
              <h2 class="td_fs_36 td_semibold td_heading_color mb-0 td_leading_snug">
                {{ $about['title'] }}
              </h2>
            </div>
          </div>

          <p class="td_fs_16 td_heading_color td_opacity_8 mb-0 td_leading_extra">
            {{ $about['text'] }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
