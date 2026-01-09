<section class="td_stats_section_dark td_accent_bg">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_36 td_mb_40 td_white_color">
        CAREER <span class="td_semibold td_white_color">STATISTICS</span>
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['stats'] ?? [] as $index => $stat)
      <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.1 * $loop->index }}s">
        <div class="td_stat_card_dark text-center">
          <div class="td_stat_icon td_mb_15">
            <i class="fa-solid {{ $stat['icon'] ?? 'fa-chart-line' }} td_white_color td_fs_32"></i>
          </div>
          <div class="td_stat_number td_bold td_white_color td_mb_10 td_fs_48 td_leading_tight">
            <span class="td_counter" data-count="{{ $stat['value'] ?? '0' }}">0</span><span class="td_white_color">{{ $stat['suffix'] ?? '' }}</span>
          </div>
          <p class="td_fs_16 mb-0 td_white_color td_opacity_9 td_leading_loose">
            {{ $stat['label'] ?? '' }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
