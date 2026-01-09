<!-- Stats Section -->
<section class="td_stats_section">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_40 td_mb_50 td_heading_color">
        {{ $page['stats_section']['title'] ?? 'CAREER' }} <span class="td_semibold td_accent_color">{{ $page['stats_section']['title_highlight'] ?? 'STATISTICS' }}</span>
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['stats'] ?? [] as $index => $stat)
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_stat_card text-center" style="background: {{ $colors['base']['white'] ?? '#fff' }}; padding: 40px 25px; border-radius: 10px; height: 100%; box-shadow: 0 4px 20px {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.05)' }};">
          <div class="td_stat_icon td_mb_20" style="width: 70px; height: 70px; background: var(--accent-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
            <i class="fa-solid {{ $stat['icon'] ?? 'fa-chart-line' }}" style="font-size: 28px; color: {{ $colors['base']['white'] ?? '#fff' }};"></i>
          </div>
          <div class="td_stat_number td_bold td_heading_color td_mb_10" style="font-size: 48px; line-height: 1;">
            <span class="td_counter" data-count="{{ $stat['value'] ?? '0' }}">0</span><span class="td_accent_color">{{ $stat['suffix'] ?? '' }}</span>
          </div>
          <p class="td_fs_16 mb-0 td_heading_color td_opacity_7">
            {{ $stat['label'] ?? '' }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
