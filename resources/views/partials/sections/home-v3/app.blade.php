@php($app = isset($app['data']) && is_array($app['data']) ? $app['data'] : $app)

<section class="td_heading_bg td_center td_cta td_style_1 td_hobble">

  <div class="container">
    <div class="td_cta_text wow fadeInLeft"
         data-wow-duration="{{ $app['animations']['text']['duration'] }}"
         data-wow-delay="{{ $app['animations']['text']['delay'] }}">

      <div class="td_section_heading td_style_1 td_mb_40">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_white_color td_opacity_7">
          {{ $app['heading']['subtitle'] }}
        </p>

        <h2 class="td_section_title td_fs_48 mb-0 td_white_color">
          {!! nl2br(e($app['heading']['title'])) !!}
        </h2>
      </div>

      <div class="td_btns_group">
        @foreach($app['buttons'] as $button)
          <a href="{{ $button['url'] }}"
             class="td_btn td_style_1 td_type_3 td_radius_30 td_medium">
            <span class="td_btn_in td_white_color">
              @include('svg.home-v3.app.' . $button['icon'])
              <span>{{ $button['label'] }}</span>
            </span>
          </a>
        @endforeach
      </div>

    </div>
  </div>

  {{-- RIGHT IMAGE --}}
  <div class="td_cta_thumb wow fadeIn"
       data-wow-duration="{{ $app['animations']['thumb']['duration'] }}"
       data-wow-delay="{{ $app['animations']['thumb']['delay'] }}">
    <img src="{{ asset($app['image']) }}" alt="">
    <div class="td_cta_thumb_shape"></div>
  </div>

  {{-- SHAPES --}}
  <div class="td_cta_shape_1 td_hover_layer_3"></div>

  <div class="td_cta_shape_2">
    @include('svg.home-v3.app.shape-2')
  </div>

  <div class="td_cta_shape_3 td_hover_layer_5">
    @include('svg.home-v3.app.shape-3')
  </div>

</section>
