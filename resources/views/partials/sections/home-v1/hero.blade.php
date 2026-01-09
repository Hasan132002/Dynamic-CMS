@php($hero = isset($hero['data']) && is_array($hero['data']) ? $hero['data'] : $hero)

<section>
  <section class="td_hero td_style_1 td_heading_bg td_center td_bg_filed"
           data-src="{{ $hero['background'] }}">
    <div class="container">
      <div class="td_hero_text wow fadeInRight"
           data-wow-duration="0.9s"
           data-wow-delay="0.35s">

        <p class="td_hero_subtitle_up td_fs_18 td_white_color td_spacing_1 td_semibold text-uppercase td_mb_10 td_opacity_9">
          {{ $hero['subtitle'] }}
        </p>

        <h1 class="td_hero_title td_fs_64 td_white_color td_mb_12">
          {!! $hero['title'] !!}
        </h1>

        <p class="td_hero_subtitle td_fs_18 td_white_color td_opacity_7 td_mb_30">
          {{ $hero['description'] }}
        </p>

        <a href="{{ $hero['primary_btn']['link'] }}"
           class="td_btn td_style_1 td_radius_10 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $hero['primary_btn']['text'] }}</span>
            @include('svg.home-v1.hero.arrow')
          </span>
        </a>

      </div>
    </div>

    <div class="td_lines">
      <span></span><span></span><span></span><span></span>
    </div>
  </section>

  <div class="container">
    <div class="td_hero_btn_group">

      @foreach($hero['buttons'] as $btn)
        <a href="{{ $btn['link'] }}"
           class="td_btn td_style_1 td_radius_10 td_medium td_fs_20 wow fadeInUp"
           data-wow-duration="0.9s"
           data-wow-delay="0.35s">

          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $btn['text'] }}</span>

            @if(!empty($btn['icon']))
              @include('svg.home-v1.hero.' . $btn['icon'])
            @endif

          </span>
        </a>
      @endforeach

    </div>
  </div>
</section>
