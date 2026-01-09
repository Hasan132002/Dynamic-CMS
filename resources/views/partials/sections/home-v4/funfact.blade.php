@php($funfact = isset($funfact['data']) && is_array($funfact['data']) ? $funfact['data'] : $funfact)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container-fluid td_plr_60">
    <div class="row td_gap_y_30">

      @foreach($funfact['items'] as $item)
        <div class="col-xxl-3 col-md-6 d-flex justify-content-center">
          <div class="td_funfact td_style_2">

            <div class="td_funfact_border"></div>

            <div class="td_funfact_icon td_center td_accent_bg">
              <img src="{{ asset($item['icon']) }}" alt="">
            </div>

            <div class="td_funfact_right td_heading_bg">
              <h3 class="td_funfact_number mb-0 td_accent_color td_fs_36 d-flex">
                <span class="odometer" data-count-to="{{ $item['count'] }}"></span>{{ $item['suffix'] }}
              </h3>
              <p class="m-0 td_fs_16 td_accent_color td_medium">
                {{ $item['label'] }}
              </p>
            </div>

          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
