<!-- Experience Excellence Section -->
<section style="background:{{ $colors['base']['white'] ?? '#fff' }};">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row align-items-center">
      <!-- Left Content -->
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <div class="td_pr_lg_30">
          <!-- Top Line Accent -->
          <div style="width:60px; height:4px; background:var(--accent-color); margin-bottom:25px;"></div>

          <!-- Main Title -->
          <h2 class="td_fs_36 td_heading_color td_mb_30" style="line-height:{{ $fonts['line_heights']['normal'] ?? '1.3' }}; font-weight:{{ $fonts['weights']['normal'] ?? 400 }};">
            {!! $page['key_stats']['main_title'] ?? '<em>EXPERIENCE EXCELLENCE</em> AS WE SHINE ON THE <strong>GLOBAL STAGE,</strong> CONSISTENTLY RANKED AMONG THE BEST IN THE WORLD.' !!}
          </h2>

          <!-- Feature Icons -->
          <div class="d-flex flex-wrap gap-4 td_mb_20" style="gap:40px;">
            @foreach($page['key_stats']['features'] ?? [] as $feature)
            <div class="d-flex align-items-center" style="gap:15px;">
              <div style="width:60px; height:60px; border-radius:50%; background:var(--accent-color); display:flex; align-items:center; justify-content:center;">
                <i class="{{ $feature['icon'] ?? 'fa-solid fa-star' }}" style="color:{{ $colors['text']['white'] ?? '#fff' }}; font-size:{{ $fonts['sizes']['3xl'] ?? '24px' }};"></i>
              </div>
              <div>
                <h4 class="td_fs_18 td_semibold td_heading_color mb-0">{{ $feature['title'] ?? '' }}</h4>
                <span class="td_fs_14 td_heading_color td_opacity_7">{{ $feature['subtitle'] ?? '' }}</span>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Right Image with Card -->
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div style="position:relative;">
          <!-- Main Image -->
          <img src="{{ asset($page['key_stats']['image'] ?? 'assets/img/home_1/about_img_1.jpg') }}" alt="Excellence" style="width:100%; height:400px; object-fit:cover; border-radius:0;">

          <!-- Overlay Card -->
          <div style="position:absolute; bottom:-30px; right:20px; background:{{ $colors['base']['white'] ?? '#fff' }}; padding:30px; max-width:380px; box-shadow:0 10px 40px {{ $colors['components']['shadow_medium'] ?? 'rgba(0,0,0,0.1)' }};">
            <!-- Small Accent Line -->
            <div style="width:40px; height:3px; background:var(--accent-color); margin-bottom:15px;"></div>
            <h3 class="td_fs_24 td_semibold td_heading_color td_mb_15" style="text-transform:uppercase;">
              {{ $page['key_stats']['edge']['title'] ?? 'OUR DISTINCTIVE EDGE' }}
            </h3>
            <p class="td_fs_14 td_heading_color td_opacity_8 mb-0" style="line-height:{{ $fonts['line_heights']['prose'] ?? '1.7' }};">
              {{ $page['key_stats']['edge']['description'] ?? 'Our distinctiveness lies in our ability to seamlessly integrate cutting-edge technology, world-class faculty, and personalized support.' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
