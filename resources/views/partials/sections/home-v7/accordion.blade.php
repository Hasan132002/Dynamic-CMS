@php($accordion = isset($accordion['data']) && is_array($accordion['data']) ? $accordion['data'] : $accordion)

<section class="container-fluid">
  <div class="td_faq_1">
    <div class="td_faq_1_left wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
      <div class="td_faq_1_img td_bg_filed"
           data-src="{{ asset($accordion['image']) }}"></div>
    </div>

    <div class="td_faq_1_right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
      <div class="td_section_heading td_style_1">
        <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1 td_mb_10 td_accent_color">
          {{ $accordion['subtitle'] }}
        </p>
      </div>

      <div class="td_accordians td_style_1 td_type_2 td_mb_40">
        @foreach($accordion['items'] as $item)
          <div class="td_accordian {{ $item['active'] ? 'active' : '' }}">
            <div class="td_accordian_head">
              <h2 class="td_accordian_title td_fs_24">
                {{ $item['question'] }}
              </h2>
              <span class="td_accordian_toggle"></span>
            </div>
            <div class="td_accordian_body td_fs_18">
              <p>{{ $item['answer'] }}</p>
            </div>
          </div>
        @endforeach
      </div>

      <a href="{{ $accordion['button']['url'] }}"
         class="td_btn td_style_2 td_type_2 td_heading_color td_medium td_mb_10">
        {{ $accordion['button']['label'] }}
        <i>
          @include('svg.home-v7.accordion.arrow')
          @include('svg.home-v7.accordion.arrow')
        </i>
      </a>
    </div>
  </div>
</section>
