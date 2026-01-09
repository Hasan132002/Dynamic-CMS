<!-- Video/Feature Section with Background Image -->
<section class="position-relative" style="background:url('{{ asset($page['video_section']['image'] ?? 'assets/img/home_1/video_bg.jpg') }}') center/cover no-repeat; min-height:350px;">
  <div style="position:absolute; inset:0; background:{{ $colors['components']['overlay_dark'] ?? 'rgba(0,0,0,0.5)' }};"></div>
  <div class="container position-relative" style="z-index:2;">
    <div class="td_height_120 td_height_lg_80"></div>
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_40 td_bold" style="color:{{ $colors['text']['white'] ?? '#fff' }}; text-transform:uppercase;">
        {{ $page['video_section']['title'] ?? 'MCU COMMITMENT TO EXCELLENCE' }}
      </h2>
    </div>
    <div class="td_height_120 td_height_lg_80"></div>
  </div>
</section>
