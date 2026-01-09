<!-- Services Section -->
<section class="td_gray_bg_5">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_40 td_heading_color td_mb_20">
        <span class="td_accent_color">CONSULTATION</span> SERVICES
      </h2>
      <p class="td_fs_18 td_heading_color td_opacity_7 td_mb_50 td_services_subtitle">
        Consult With Us, We Are Here For You!
      </p>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['services'] ?? [] as $index => $service)
      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.1 * $loop->index }}s">
        <div class="td_service_card">
          <!-- Accent border on left -->
          <div class="td_service_accent_bar"></div>

          <div class="d-flex align-items-start">
            <div class="td_service_icon">
              <i class="fa-solid {{ $service['icon'] ?? 'fa-comments' }}"></i>
            </div>
            <div>
              <h3 class="td_fs_20 td_semibold td_heading_color td_mb_10">
                {{ $service['title'] ?? '' }}
              </h3>
              <p class="td_fs_14 td_heading_color td_opacity_7 mb-0 td_leading_prose">
                {{ $service['description'] ?? '' }}
              </p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
