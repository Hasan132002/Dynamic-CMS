<!-- What Sets Us Apart Section -->
<section class="td_white_bg">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="row align-items-center">
      <!-- Left - Image with Card Overlay -->
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <div class="td_wsa_image_wrap position-relative">
          <!-- Main Image -->
          <img src="{{ asset($page['what_sets_apart']['image'] ?? 'assets/img/home_1/about_img_2.jpg') }}" alt="What Sets Us Apart" class="td_wsa_main_image">

          <!-- Stat Card Overlay -->
          <div class="td_wsa_stat_card td_accent_bg">
            <div class="td_white_color td_bold td_wsa_stat_value">
              <span class="td_counter_wsa" data-count="{{ $page['what_sets_apart']['stat']['value'] ?? '87' }}">0</span>{{ $page['what_sets_apart']['stat']['suffix'] ?? '%' }}
            </div>
            <p class="td_white_color td_fs_14 mb-0 td_mt_5">
              {{ $page['what_sets_apart']['stat']['label'] ?? 'Graduates Working in MNCs' }}
            </p>
          </div>

          <!-- Bottom Card -->
          <div class="td_wsa_bottom_card">
            <!-- Small accent line -->
            <div class="td_wsa_accent_line"></div>
            <h3 class="td_fs_22 td_semibold td_heading_color td_mb_12">
              {{ $page['what_sets_apart']['title'] ?? 'WHAT SETS US APART' }}
            </h3>
            <p class="td_fs_14 td_heading_color td_opacity_7 mb-0 td_leading_relaxed">
              {{ $page['what_sets_apart']['description'] ?? '' }}
            </p>
          </div>
        </div>
      </div>

      <!-- Right - Quote -->
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_pl_lg_50 td_pt_40">
          <!-- Large Quote Mark -->
          <div class="td_accent_color td_opacity_3 td_quote_mark">"</div>

          <p class="td_fs_24 td_heading_color td_fw_normal td_leading_spacious">
            {!! $page['what_sets_apart']['quote'] ?? 'Our Emphasis on <strong>Real-World Skills</strong> and <strong>Experiential Learning</strong> Ensures that our Graduates are <strong>Well-Prepared</strong> to Excel in their Careers.' !!}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
