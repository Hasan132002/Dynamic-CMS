@php($instagram = isset($instagram['data']) && is_array($instagram['data']) ? $instagram['data'] : $instagram)

<section>
  <div class="container">
    <div class="td_height_112 td_height_lg_75"></div>

    <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
        {{ $instagram['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {{ $instagram['title'] }}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>
  </div>

  <ul class="td_instagram_list td_style_1 td_mp_0 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
    @foreach($instagram['items'] as $item)
      <li>
        <a href="{{ $item['url'] }}">
          <img src="{{ asset($item['image']) }}" alt="">
          <i class="fa-brands fa-instagram"></i>
        </a>
      </li>
    @endforeach
  </ul>

  <div class="td_height_30 td_height_lg_30"></div>
</section>
