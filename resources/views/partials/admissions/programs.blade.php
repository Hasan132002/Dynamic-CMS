<!-- Programs Section -->
<section class="td_programs_section">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_40 td_heading_color td_mb_50">
        <span class="td_accent_color">{{ $page['programs_section']['title_highlight'] ?? 'PROGRAMS' }}</span> {{ $page['programs_section']['title'] ?? 'OFFERED' }}
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['programs'] ?? [] as $index => $program)
      <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_program_card" style="background: {{ $colors['base']['white'] ?? '#fff' }}; padding: 30px; border-radius: 10px; height: 100%; box-shadow: 0 4px 20px {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.05)' }}; border-left: 4px solid var(--accent-color);">
          <div class="d-flex align-items-start">
            <div class="td_program_icon" style="width: 60px; height: 60px; background: var(--accent-color); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0;">
              <i class="fa-solid {{ $program['icon'] ?? 'fa-graduation-cap' }}" style="font-size: 24px; color: {{ $colors['base']['white'] ?? '#fff' }};"></i>
            </div>
            <div>
              <h3 class="td_fs_20 td_semibold td_heading_color td_mb_10">
                <span class="td_accent_color">{{ $program['highlight'] ?? '' }}</span> {{ $program['title'] ?? '' }}
              </h3>
              <p class="td_fs_14 td_heading_color td_opacity_7 mb-0" style="line-height: {{ $fonts['line_heights']['prose'] ?? '1.7' }};">
                {{ $program['description'] ?? '' }}
              </p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
