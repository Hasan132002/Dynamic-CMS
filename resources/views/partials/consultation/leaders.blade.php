<section class="td_leaders_section td_gray_bg_5 position-relative overflow-hidden">
  <!-- Animated Background -->
  <div class="td_leaders_bg_circle position-absolute"></div>

  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container position-relative td_z_2">
    <div class="row align-items-center td_gap_y_40">
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <h2 class="td_fs_36 td_heading_color td_mb_25">
          <span class="td_semibold">CULTIVATING THE LEADERS</span><br>
          <span class="td_accent_color">OF THE</span> FUTURE BY MCU
        </h2>
        <p class="td_fs_18 td_heading_color td_opacity_8 mb-0 td_leading_extra">
          {{ $page['leaders']['description'] ?? 'Embark on a transformative journey through immersive internships at MCU, where hands-on learning, dedicated mentorship, and a multitude of diverse opportunities empower your future endeavors. Our internships are thoughtfully tailored to individual aspirations and strengthened by global partnerships, providing a key to unlocking personal, academic, and professional growth.' }}
        </p>
      </div>
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
        <img src="{{ asset($page['leaders']['image'] ?? 'assets/img/home_1/about_img_1.jpg') }}" alt="Leaders" class="w-100 td_leaders_image">
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
