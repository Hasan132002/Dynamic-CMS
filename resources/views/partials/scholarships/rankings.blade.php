<!-- Rankings Section - 4 Column Stats Display -->
<section style="background: {{ $colors['base']['light'] ?? '#f8f9fa' }};">
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row td_gap_y_30">
      @foreach($page['rankings'] ?? [] as $index => $ranking)
      <div class="col-xl-3 col-lg-6 col-md-6 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_ranking_item" style="padding: 30px; background: {{ $colors['base']['white'] ?? '#fff' }}; border-radius: 10px; box-shadow: 0 4px 20px {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.05)' }};">
          <div class="td_ranking_number td_bold" style="font-size: 56px; color: var(--accent-color); line-height: 1; margin-bottom: 15px;">
            {{ $ranking['rank'] ?? '' }}
          </div>
          <p class="td_fs_16 td_heading_color td_opacity_8 mb-0" style="font-weight: {{ $fonts['weights']['medium'] ?? 500 }};">
            {{ $ranking['label'] ?? '' }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
