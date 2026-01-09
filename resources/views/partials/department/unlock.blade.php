<section class="td_unlock_section td_accent_bg">
  <div class="td_height_100 td_height_lg_70"></div>
  <div class="container">
    <!-- Header -->
    <div class="text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.15s">
      <h2 class="td_fs_40 td_semibold td_mb_12 td_white_color">
        {{ $unlock['title'] }}
      </h2>
      <p class="td_fs_16 mb-0 td_white_color td_opacity_85 td_unlock_subtitle">
        {{ $unlock['text'] }}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_40"></div>

    <!-- Feature Cards -->
    <div class="row td_gap_y_24">
      @foreach($unlock['features'] as $index => $feature)
      <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
        <div class="td_unlock_card h-100">
          <!-- Card Number -->
          <div class="td_unlock_card_number">
            <span class="td_white_color td_bold td_fs_16">{{ $index + 1 }}</span>
          </div>
          <h3 class="td_fs_22 td_semibold td_heading_color td_mb_12">
            {{ $feature['title'] }}
          </h3>
          <p class="td_fs_15 td_heading_color mb-0 td_leading_prose td_opacity_75">
            {{ $feature['text'] }}
          </p>
        </div>
      </div>
      @endforeach
    </div>

    <div class="td_height_50 td_height_lg_40"></div>

    <!-- CTA Button -->
    <div class="text-center">
      <a href="{{ $unlock['cta']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium td_fs_16 td_unlock_cta_btn">
        <span class="td_btn_in td_heading_color td_white_bg">
          <span>{{ $unlock['cta']['label'] }}</span>
          <i class="fa-solid fa-arrow-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="td_height_100 td_height_lg_70"></div>
</section>
