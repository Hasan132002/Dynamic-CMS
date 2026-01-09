<!-- Transforming the World Section -->
<section class="td_white_bg">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="row align-items-start">
      <!-- Left Content -->
      <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s">
        <h2 class="td_fs_32 td_heading_color td_mb_10 td_fw_normal td_leading_snug">
          {{ $page['research']['title'] ?? 'TRANSFORMING THE WORLD WITH' }}
        </h2>
        <h2 class="td_fs_32 td_heading_color td_mb_25 td_bold td_leading_snug">
          {{ $page['research']['subtitle'] ?? 'SUPERIOR RESEARCH' }}
        </h2>
        <p class="td_fs_16 td_heading_color td_opacity_7 td_leading_extra">
          {{ $page['research']['description'] ?? '' }}
        </p>
      </div>

      <!-- Right Links -->
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_research_links">
          @foreach($page['research']['links'] ?? [] as $link)
          <a href="{{ $link['url'] ?? '#' }}" class="td_research_link_item d-flex align-items-center justify-content-between">
            <span class="td_fs_18 td_heading_color td_medium">{{ $link['title'] ?? '' }}</span>
            <i class="fa-solid fa-arrow-right td_heading_color td_opacity_5 td_research_link_icon"></i>
          </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
