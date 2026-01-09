@php($faq = isset($faq['data']) && is_array($faq['data']) ? $faq['data'] : $faq)

<section class="td_gray_bg_5">
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_medium
                td_spacing_1 td_mb_10 td_accent_color">
        {{ $faq['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $faq['title'] }}
      </h2>
      <p class="td_section_subtitle mb-0">
        {{ $faq['description'] }}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="td_accordians td_style_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.3s">

      @foreach($faq['items'] as $index => $item)
        <div class="td_accordian {{ $index === 0 ? 'active' : '' }}">

          <div class="td_accordian_head">
            <h2 class="td_accordian_title td_fs_36 td_normal">
              {{ $item['question'] }}
            </h2>
            <span class="td_accordian_toggle">
              @include('svg.home-v6.faq.toggle-arrow')
            </span>
          </div>

          <div class="td_accordian_body td_fs_18">
            <p>{{ $item['answer'] }}</p>
          </div>

        </div>
      @endforeach

    </div>

    <div class="td_height_50 td_height_lg_40"></div>

    <div class="text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.35s">
      <a href="{{ $faq['button']['url'] }}"
         class="td_btn td_style_1 td_medium td_with_shadow_2">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $faq['button']['label'] }}</span>
        </span>
      </a>
    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
