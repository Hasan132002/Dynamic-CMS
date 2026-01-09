<!-- Scholarship Types Section - 4 Column Card Grid -->
<section class="td_scholarship_types_section">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_30">
      @foreach($page['scholarship_types'] ?? [] as $index => $type)
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_scholarship_type_card" style="padding: 30px; background: {{ $colors['base']['white'] ?? '#fff' }}; border-radius: 10px; height: 100%; box-shadow: 0 4px 20px {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.05)' }}; transition: all 0.3s ease;">
          <div class="td_type_number td_mb_20" style="font-size: 32px; font-weight: {{ $fonts['weights']['bold'] ?? 700 }}; color: var(--accent-color); line-height: 1;">
            {{ $loop->iteration }}
          </div>
          <h3 class="td_fs_20 td_semibold td_heading_color td_mb_15">
            {{ $type['title'] ?? '' }}
          </h3>
          <p class="td_fs_14 td_heading_color td_opacity_7 mb-0" style="line-height: {{ $fonts['line_heights']['prose'] ?? '1.7' }};">
            {{ $type['description'] ?? '' }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
