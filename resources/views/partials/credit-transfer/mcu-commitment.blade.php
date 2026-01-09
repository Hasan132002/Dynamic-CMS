<!-- MCU Commitment Section -->
<section class="td_gray_bg_5">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_40">
      <!-- Left Side - Image with Text Overlay -->
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <div class="position-relative">
          <img src="{{ asset($page['mcu_commitment']['image'] ?? 'assets/img/credit-transfer/mcu-commitment.jpg') }}" alt="MCU Commitment" class="w-100 td_mcu_image">

          <!-- Text Overlay Box -->
          <div class="td_mcu_overlay_box position-absolute">
            <div class="d-flex align-items-start">
              <div class="td_mcu_accent_bar"></div>
              <div>
                <h3 class="td_fs_14 td_heading_color td_mb_5 td_mcu_subtitle">
                  {{ $page['mcu_commitment']['subtitle'] ?? 'WHAT SETS US APART' }}
                </h3>
                <h4 class="td_fs_22 td_heading_color td_semibold td_mb_15">
                  {{ $page['mcu_commitment']['title'] ?? "MCU'S COMMITMENT?" }}
                </h4>
                <p class="td_fs_14 td_heading_color td_opacity_7 mb-0 td_leading_prose">
                  {{ $page['mcu_commitment']['description'] ?? "Our university's exceptional ranking among its peers is no accident. It's a result of our unwavering commitment to academic excellence, innovative teaching methods, and a dedicated faculty who go above and beyond to empower our students." }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Side - Stats and Quote -->
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
        <div class="td_mcu_right_content d-flex flex-column align-items-center justify-content-center h-100">
          <!-- Big Stat -->
          <div class="text-center td_mb_30">
            <div class="td_mcu_stat_number td_accent_color td_bold">
              <span class="td_counter" data-count="{{ $page['mcu_commitment']['stat_value'] ?? '87' }}">0</span><span>%</span>
            </div>
            <p class="td_fs_18 td_heading_color td_semibold mb-0">
              {{ $page['mcu_commitment']['stat_label'] ?? 'Graduates' }}<br>
              {{ $page['mcu_commitment']['stat_sublabel'] ?? 'Working in MNCs' }}
            </p>
          </div>

          <!-- Quote -->
          <div class="td_mcu_quote position-relative text-center">
            <span class="td_mcu_quote_mark td_accent_color">"</span>
            <p class="td_fs_18 td_heading_color td_leading_spacious">
              {{ $page['mcu_commitment']['quote_line1'] ?? 'Our Emphasis on' }} <strong class="td_semibold">{{ $page['mcu_commitment']['quote_highlight1'] ?? 'Real-World' }}</strong>
              {{ $page['mcu_commitment']['quote_line2'] ?? 'Skills and Experiential Learning Ensures that our Graduates are' }} <strong class="td_semibold">{{ $page['mcu_commitment']['quote_highlight2'] ?? 'Well-Prepared' }}</strong> {{ $page['mcu_commitment']['quote_line3'] ?? 'to Excel in their Careers.' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
