<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="td_error text-center">

      <img src="{{ asset($errorContent['image']) }}" alt="">

      <div class="td_height_90 td_height_lg_40"></div>

      <h2 class="td_fs_48 td_mb_27">
        {{ $errorContent['title'] }}
      </h2>

      <p class="td_mb_35">
        {!! $errorContent['description'] !!}
      </p>

      <a href="{{ $errorContent['button']['link'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
        <span class="td_btn_in td_white_color td_accent_bg">
          <span>{{ $errorContent['button']['text'] }}</span>
          @include('svg.pages.error.go-home-arrow')
        </span>
      </a>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
