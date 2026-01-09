<section>
  <div class="td_height_120 td_height_lg_80"></div>

  @foreach ($faq_section['blocks'] as $index => $block)
    <div class="td_faq_1 td_style_1 {{ $index === 0 ? 'td_type_1' : '' }}">
      @if ($index === 0)
        <div class="td_faq_1_left">
          <div class="td_faq_1_img td_bg_filed" data-src="{{ asset($block['background_image']) }}"></div>
        </div>
      @endif

      <div class="td_faq_1_right">
        <div class="td_section_heading td_style_1">
          <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">
            {{ $block['subtitle'] }}
          </p>
        </div>

        <div class="td_accordians td_style_1 td_type_2 td_mb_40">
          @foreach ($block['accordions'] as $accordion)
            <div class="td_accordian {{ $accordion['active'] ? 'active' : '' }}">
              <div class="td_accordian_head">
                <h2 class="td_accordian_title td_fs_24">{{ $accordion['title'] }}</h2>
                <span class="td_accordian_toggle"></span>
              </div>
              <div class="td_accordian_body td_fs_18">
                <p>{{ $accordion['content'] }}</p>
              </div>
            </div>
          @endforeach
        </div>

        <a href="{{ $block['button']['url'] }}" class="td_btn td_style_2 td_type_2 td_heading_color td_medium">
          {{ $block['button']['text'] }}
          <i>
            @include('svg.pages.faqs.arrow-double')
            @include('svg.pages.faqs.arrow-double')
          </i>
        </a>
      </div>

      @if ($index === 1)
        <div class="td_faq_1_left">
          <div class="td_faq_1_img td_bg_filed" data-src="{{ asset($block['background_image']) }}"></div>
        </div>
      @endif
    </div>

    @if ($index === 0)
      <div class="td_height_120 td_height_lg_80"></div>
    @endif
  @endforeach
</section>
