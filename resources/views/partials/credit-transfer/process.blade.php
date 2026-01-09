<!-- Our Process Section - 3 Column Cards -->
<section class="td_process_section">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_36 td_heading_color td_mb_40">
        {{ $page['process']['title'] ?? 'OUR PROCESS' }}
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['process']['steps'] ?? [] as $index => $step)
      <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_process_card_ct">
          <div class="td_step_number">
            <span>{{ $step['number'] ?? '' }}</span>
          </div>
          <h3 class="td_fs_20 td_semibold td_heading_color td_mb_15">
            {{ $step['title'] ?? '' }}
          </h3>
          <p class="td_fs_14 td_heading_color td_opacity_7 mb-0 td_leading_prose">
            {{ $step['description'] ?? '' }}
          </p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
