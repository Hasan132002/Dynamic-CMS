<!-- Corporate Partners Section - Horizontal Logo Grid -->
<section class="td_partners_section">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_28 td_heading_color td_semibold td_mb_40">
        {{ $page['partners']['title'] ?? 'OUR CORPORATE PARTNERS' }}
      </h2>
    </div>

    <div class="row align-items-center justify-content-center">
      @foreach($page['partners']['logos'] ?? [] as $index => $logo)
      <div class="col-lg-2 col-md-3 col-4 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.05 * $loop->index }}s">
        <div class="td_partner_logo_ct">
          <img src="{{ asset($logo) }}" alt="Partner {{ $loop->iteration }}" class="td_partner_img_ct">
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
