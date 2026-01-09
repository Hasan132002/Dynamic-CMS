<section>
  <div class="td_height_112 td_height_lg_75"></div>
  <div class="container">
    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $departments['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $departments['title'] }}
      </h2>
      <p class="td_section_subtitle td_fs_18 mb-0">
        {!! $departments['description'] !!}
      </p>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="td_iconbox_1_wrap">
      @foreach($departments['items'] as $item)
      <div class="td_iconbox td_style_1 text-center wow fadeInUp" data-wow-duration="1s">
        <div class="td_iconbox_icon td_accent_color td_mb_10">
          @include('svg.about.department.' . $item['icon'])
        </div>
        <h3 class="td_iconbox_title mb-0 td_medium td_fs_36">
          {{ $item['title'] }}
        </h3>
      </div>
      @endforeach
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
