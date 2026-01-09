<section class="td_ranking_section">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_30">
      <!-- Left Content -->
      <div class="col-lg-7 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.25s">
        <!-- Title with Side Accent -->
        <div class="d-flex align-items-start td_mb_20">
          <div class="td_side_accent_bar"></div>
          <div>
            <span class="td_fs_14 td_semibold td_spacing_1 text-uppercase td_accent_color d-block td_mb_8">
              {{ $ranking['subtitle'] }}
            </span>
            <h2 class="td_fs_36 td_semibold td_heading_color mb-0 td_leading_snug">
              {!! $ranking['title'] !!}
            </h2>
          </div>
        </div>

        @foreach($ranking['paragraphs'] as $para)
        <p class="td_fs_16 td_heading_color td_mb_12 td_leading_spacious td_opacity_75">{{ $para }}</p>
        @endforeach

        <div class="td_mt_25">
          <a href="{{ $ranking['cta']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium td_ranking_btn">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $ranking['cta']['label'] }}</span>
              <i class="fa-solid fa-arrow-right"></i>
            </span>
          </a>
        </div>
      </div>

      <!-- Right Image -->
      <div class="col-lg-5 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="text-center">
          <img src="{{ asset($ranking['badge']) }}" alt="Ranking Badge" class="td_ranking_badge">
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
