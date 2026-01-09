<!-- Steps Section -->
<section class="td_steps_section" style="background: {{ $colors['base']['light'] ?? '#f8f9fa' }};">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_40 td_heading_color td_mb_50">
        {{ $page['steps_section']['title'] ?? '3 SIMPLE' }} <span class="td_semibold td_accent_color">{{ $page['steps_section']['title_highlight'] ?? 'STEPS TO APPLY' }}</span>
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['steps'] ?? [] as $index => $step)
      <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_step_card text-center" style="background: {{ $colors['base']['white'] ?? '#fff' }}; padding: 40px 30px; border-radius: 10px; height: 100%; box-shadow: 0 4px 20px {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.05)' }};">
          <div class="td_step_number td_mb_25" style="width: 70px; height: 70px; background: var(--accent-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 28px; font-weight: {{ $fonts['weights']['bold'] ?? 700 }}; color: {{ $colors['base']['white'] ?? '#fff' }};">
            {{ $step['number'] ?? str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
          </div>
          <h3 class="td_fs_18 td_semibold td_heading_color td_mb_15" style="text-transform: uppercase;">
            {{ $step['title'] ?? '' }}
          </h3>
          <p class="td_fs_14 td_heading_color td_opacity_7 mb-0" style="line-height: {{ $fonts['line_heights']['prose'] ?? '1.7' }};">
            {{ $step['description'] ?? '' }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
