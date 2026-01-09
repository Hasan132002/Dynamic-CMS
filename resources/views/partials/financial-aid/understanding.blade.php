<!-- Understanding Financial Aid Section -->
<section class="td_white_bg">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <!-- Top Center Accent -->
    <div class="text-center td_mb_40">
      <div class="td_center_accent_bar"></div>
    </div>

    <div class="row align-items-center">
      <!-- Left Image -->
      <div class="col-lg-5 wow fadeInLeft" data-wow-duration="1s">
        <div class="td_understanding_image_wrap position-relative">
          <img src="{{ asset($page['understanding']['image'] ?? 'assets/img/home_1/about_img_1.jpg') }}" alt="Understanding Financial Aid" class="td_understanding_image">
          <!-- Bottom accent line -->
          <div class="td_understanding_accent_line"></div>
        </div>
      </div>

      <!-- Right Content -->
      <div class="col-lg-7 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_pl_lg_40">
          <!-- Title with accent bar -->
          <div class="d-flex align-items-start td_mb_20">
            <div class="td_side_accent_bar_tall"></div>
            <div>
              <h2 class="td_fs_36 td_heading_color mb-0 td_bold td_leading_tight">
                {{ $page['understanding']['title'] ?? 'UNDERSTANDING' }}
              </h2>
              <h2 class="td_fs_36 td_heading_color mb-0 td_fw_normal td_leading_tight">
                {{ $page['understanding']['subtitle'] ?? 'FINANCIAL AID' }}
              </h2>
            </div>
          </div>

          <p class="td_fs_16 td_heading_color td_opacity_8 td_leading_extra">
            {{ $page['understanding']['description'] ?? '' }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
