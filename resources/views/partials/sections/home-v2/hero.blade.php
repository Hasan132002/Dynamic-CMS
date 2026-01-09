@php
  $section = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : ($hero ?? null);
@endphp

@if($section)
<section class="{{ $section['section_classes'] }}">
  <div class="container">
    <div class="td_hero_text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">

      <h1 class="td_hero_title td_fs_64 td_mb_30">
        {{ $section['title']['before'] }}
        <span>
          {{ $section['title']['highlight'] }}
          @includeIf('svg.home-v2.hero.' . $section['title']['highlight_shape'])
        </span>
        {{ $section['title']['after'] }}
      </h1>

      <p class="td_hero_subtitle td_fs_18 td_heading_color td_mb_40">
        {{ $section['subtitle'] }}
      </p>

      <div class="td_btns_group">
        <a href="{{ $section['button']['url'] }}" class="td_btn td_style_1 td_radius_30 td_medium td_with_shadow">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $section['button']['text'] }}</span>
            @includeIf('svg.home-v2.hero.' . $section['button']['icon'])
          </span>
        </a>

        <div class="td_avatars_wrap">
          <div class="td_avatars">
            @foreach($section['students']['avatars'] as $index => $avatar)
              <div>
                <img src="{{ asset($avatar) }}" alt="">
                @if($loop->last)
                  <i class="fa-solid fa-plus"></i>
                @endif
              </div>
            @endforeach
          </div>

          <div>
            <h3 class="mb-0 td_fs_20 td_semibold">{{ $section['students']['count'] }}</h3>
            <p class="mb-0 td_fs_18 td_opacity_6">{{ $section['students']['label'] }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- LEFT IMAGES --}}
  <div class="td_hero_img_box_left">
    @foreach($section['images_left'] as $img)
      <div class="{{ $img['class'] }} position-absolute wow" data-wow-duration="1s" data-wow-delay="0.25s">
        <img src="{{ asset($img['src']) }}" alt="">
      </div>
    @endforeach
  </div>

  {{-- RIGHT IMAGES --}}
  <div class="td_hero_img_box_right">
    @foreach($section['images_right'] as $img)
      <div class="{{ $img['class'] }} position-absolute wow" data-wow-duration="1s" data-wow-delay="0.25s">
        <img src="{{ asset($img['src']) }}" alt="">
      </div>
    @endforeach
  </div>

  {{-- SHAPES --}}
  @foreach($section['shapes'] as $shape)
    <div class="{{ $shape['class'] }} position-absolute">
      <img src="{{ asset($shape['src']) }}" alt="">
    </div>
  @endforeach
</section>
@endif
