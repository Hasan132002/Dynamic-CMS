<!-- Why Consider Credit Transfer Section -->
<section class="td_why_consider_section">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_40">
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <h2 class="td_fs_40 td_heading_color td_bold td_mb_25 td_leading_snug">
          <span class="td_accent_color">{{ $page['why_consider']['title_highlight'] ?? 'WHY CONSIDER' }}</span><br>
          {{ $page['why_consider']['title'] ?? 'CREDIT TRANSFER?' }}
        </h2>
        <p class="td_fs_16 td_heading_color td_opacity_8 td_leading_extra">
          {{ $page['why_consider']['description'] ?? 'Considering credit transfer can be a strategic choice for students seeking to optimize their academic journey. It allows individuals to leverage prior learning experiences and coursework, saving both time and resources while progressing toward their degree goals.' }}
        </p>
        <p class="td_fs_16 td_heading_color td_opacity_8 td_leading_extra">
          {{ $page['why_consider']['note'] ?? "Whether you've completed courses at another institution, hold professional certifications, or have military training, credit transfer can recognize and reward your hard work." }}
        </p>
      </div>
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
        <div class="position-relative">
          <img src="{{ asset($page['why_consider']['image'] ?? 'assets/img/credit-transfer/why-consider.jpg') }}" alt="Why Consider Credit Transfer" class="w-100 td_why_consider_image">
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
