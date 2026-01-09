<!-- CTA Section -->
<section class="td_cta_section position-relative" style="background: var(--accent-color); overflow: hidden;">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container position-relative" style="z-index: 2;">
    <div class="row align-items-center">
      <div class="col-lg-8 wow fadeInLeft" data-wow-duration="1s">
        <div class="td_cta_content">
          <h2 class="td_fs_32 td_white_color td_mb_10" style="text-transform: uppercase;">
            {{ $page['cta']['title'] ?? 'APPLY NOW & EXPERIENCE' }}
          </h2>
          <h3 class="td_fs_48 td_bold td_white_color td_mb_30" style="text-transform: uppercase;">
            {{ $page['cta']['subtitle'] ?? 'THE QUALITY EDUCATION' }}
          </h3>
          <a href="{{ $page['cta']['button_url'] ?? '/students-registrations' }}" class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_white_bg" style="padding: 16px 35px; color: var(--accent-color); font-weight: {{ $fonts['weights']['semibold'] ?? 600 }};">
              {{ $page['cta']['button_text'] ?? 'APPLY NOW' }}
              <i class="fa-solid fa-arrow-right" style="margin-left: 10px;"></i>
            </span>
          </a>
        </div>
      </div>
      <div class="col-lg-4 text-center d-none d-lg-block wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="td_white_color" style="opacity: 0.9;">
          <i class="fa-solid fa-graduation-cap" style="font-size: 140px;"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
