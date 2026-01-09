<!-- Career & Insights Section -->
<section style="background:{{ $colors['base']['white'] ?? '#fff' }};">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <!-- Section Title -->
    <div class="td_section_heading td_style_1 text-center td_mb_50 wow fadeInUp" data-wow-duration="1s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $page['mission']['section_title'] ?? 'CAREER & INSIGHTS' }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0 td_heading_color">
        Explore Your Future
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['mission']['items'] ?? [] as $index => $item)
      <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_career_card" style="background: {{ $colors['base']['white'] ?? '#fff' }}; height: 100%; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 20px {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.05)' }}; transition: all 0.3s ease;">
          <!-- Image with bottom border accent -->
          <div style="position: relative; overflow: hidden;">
            <img src="{{ asset($item['image'] ?? 'assets/img/home_1/course_thumb_1.jpg') }}" alt="{{ $item['title'] ?? '' }}" style="width: 100%; height: 220px; object-fit: cover; transition: transform 0.3s ease;">
            <!-- Bottom accent line -->
            <div style="position: absolute; bottom: 0; left: 0; width: 50px; height: 4px; background: var(--accent-color);"></div>
          </div>

          <!-- Content -->
          <div style="padding: 25px;">
            <h3 class="td_fs_22 td_semibold td_heading_color td_mb_15" style="line-height: {{ $fonts['line_heights']['normal'] ?? '1.3' }};">
              {{ $item['title'] ?? '' }}
            </h3>
            <p class="td_fs_14 td_heading_color td_opacity_7 mb-0" style="line-height: {{ $fonts['line_heights']['prose'] ?? '1.7' }};">
              {{ $item['description'] ?? '' }}
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
