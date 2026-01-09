@php($funfact = isset($funfact['data']) && is_array($funfact['data']) ? $funfact['data'] : $funfact)

<section>
  <div class="td_accent_bg">

    <div class="td_height_{{ $funfact['spacing']['top'] }}
                td_height_lg_{{ $funfact['spacing']['top_lg'] }}"></div>

    <div class="container">
      <div class="td_funfact_1_wrap">

        @foreach($funfact['items'] as $item)
          <div class="td_funfact td_style_1">

            <div class="td_funfact_in">
              <div class="td_funfact_icon">
                <img src="{{ asset($item['icon']) }}" alt="">
              </div>

              <div class="td_funfact_right">
                <h3 class="td_fs_36 td_white_color mb-0">
                  <span class="odometer"
                        data-count-to="{{ $item['count'] }}"></span>+
                </h3>
                <p class="mb-0 td_white_color td_opacity_7">
                  {{ $item['label'] }}
                </p>
              </div>
            </div>

            {{-- SVG BORDER --}}
            @include('svg.home-v3.funfact.border')

          </div>
        @endforeach

      </div>
    </div>

    <div class="td_height_{{ $funfact['spacing']['bottom'] }}
                td_height_lg_{{ $funfact['spacing']['bottom_lg'] }}"></div>

  </div>
</section>
