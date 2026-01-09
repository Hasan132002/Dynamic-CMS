<!-- Benefits Section - 3 Column Feature Card Grid with Images -->
<section class="td_white_bg">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container">
    <div class="text-center wow fadeInUp" data-wow-duration="1s">
      <h2 class="td_fs_32 td_heading_color td_mb_40">
        BENEFITS OF FINANCIAL AID
      </h2>
    </div>

    <div class="row td_gap_y_30">
      @foreach($page['benefits'] ?? [] as $index => $benefit)
      <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.15 * $loop->index }}s">
        <div class="td_benefit_card_fa">
          <div class="td_benefit_image">
            <img src="{{ asset($benefit['image'] ?? 'assets/img/home_1/course_thumb_1.jpg') }}" alt="{{ $benefit['title'] ?? '' }}">
          </div>
          <div class="td_benefit_content">
            <h3 class="td_fs_20 td_semibold td_heading_color td_mb_12">
              {{ $benefit['title'] ?? '' }}
            </h3>
            <p class="td_fs_14 td_heading_color td_opacity_7 mb-0 td_leading_relaxed">
              {{ $benefit['description'] ?? '' }}
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
