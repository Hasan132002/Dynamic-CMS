<section class="td_stats_section_dept">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <div class="row td_gap_y_30">
      @foreach($stats as $index => $stat)
      <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 + ($index * 0.1) }}s">
        <div class="td_stat_card_dept text-center">
          <h2 class="td_fs_48 td_bold td_accent_color td_mb_12 td_leading_tight">
            {!! $stat['value'] !!}
          </h2>
          <p class="td_fs_15 td_medium td_heading_color mb-0 td_leading_loose td_opacity_75">
            {{ $stat['label'] }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
