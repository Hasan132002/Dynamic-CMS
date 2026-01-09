<section class="td_gray_bg_5">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="row align-items-center td_gap_y_40">
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <h2 class="td_fs_32 td_heading_color td_mb_15">
          <span class="td_accent_color td_italic">{{ $page['excellence']['title_highlight'] ?? 'EXPERIENCE EXCELLENCE' }}</span> {{ $page['excellence']['title'] ?? 'AS WE SHINE ON THE' }} <span class="td_semibold">{{ $page['excellence']['title_bold'] ?? 'GLOBAL STAGE,' }}</span>
        </h2>
        <p class="td_fs_18 td_heading_color td_opacity_8 td_mb_30" style="line-height:{{ $fonts['line_heights']['prose'] ?? '1.7' }};">
          {{ $page['excellence']['subtitle'] ?? 'CONSISTENTLY RANKED AMONG THE BEST IN THE WORLD.' }}
        </p>

        <div class="d-flex flex-wrap" style="gap:30px;">
          @foreach($page['excellence']['features'] ?? [] as $feature)
          <div class="d-flex align-items-center">
            <div style="width:50px; height:50px; background:var(--accent-color); border-radius:8px; display:flex; align-items:center; justify-content:center; margin-right:12px;">
              <i class="fa-solid {{ $feature['icon'] ?? 'fa-users' }}" style="font-size:{{ $fonts['sizes']['2xl'] ?? '20px' }}; color:{{ $colors['base']['white'] ?? '#fff' }};"></i>
            </div>
            <div>
              <span class="td_fs_18 td_semibold td_heading_color d-block">{{ $feature['title'] ?? '' }}</span>
              <span class="td_fs_14 td_heading_color td_opacity_7">{{ $feature['subtitle'] ?? '' }}</span>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s">
        <div class="position-relative">
          <img src="{{ asset($page['excellence']['image'] ?? 'assets/img/home_1/about_img_1.jpg') }}" alt="Excellence" class="w-100" style="border-radius:8px;">

          <div class="td_edge_box position-absolute" style="bottom:20px; right:20px; background:var(--heading-color); padding:25px; max-width:320px; border-radius:8px;">
            <h3 class="td_fs_18 td_bold td_mb_10" style="text-transform:uppercase; color:{{ $colors['text']['white'] ?? '#fff' }};">
              {{ $page['excellence']['edge']['title'] ?? 'OUR DISTINCTIVE EDGE' }}
            </h3>
            <p class="td_fs_14 mb-0" style="line-height:{{ $fonts['line_heights']['prose'] ?? '1.7' }}; color:{{ $colors['text']['white'] ?? '#fff' }}; opacity:{{ $colors['text']['opacity_95'] ?? '0.95' }};">
              {{ $page['excellence']['edge']['description'] ?? 'Our distinctiveness lies in our ability to seamlessly integrate cutting-edge technology, world-class faculty, and personalized support, ensuring that each student is not just educated but empowered to thrive in an ever-evolving world.' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
