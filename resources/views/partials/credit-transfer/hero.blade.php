<section
  class="td_page_heading td_center td_bg_filed td_heading_bg text-left td_hobble"
  data-src="{{ asset($page['hero']['bg'] ?? 'assets/img/others/page_heading_bg.jpg') }}"
>
  <div class="container">
    <div class="td_page_heading_in">
      <h1 class="td_white_color td_fs_48 td_mb_10 wow fadeInUp" data-wow-duration="1s">
        {!! $page['hero']['title'] ?? 'CREDIT TRANSFER' !!}
      </h1>

      <p class="td_fs_18 td_opacity_9 td_white_color wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" style="max-width: 600px;">
        {{ $page['hero']['text'] ?? 'Transfer your credits seamlessly and continue your academic journey with us.' }}
      </p>
    </div>
  </div>

  <div class="td_page_heading_shape_1 position-absolute td_hover_layer_3"></div>
  <div class="td_page_heading_shape_2 position-absolute td_hover_layer_5"></div>

  @if(!empty($page['hero']['shapes']))
  <div class="td_page_heading_shape_3 position-absolute">
    <img src="{{ asset($page['hero']['shapes']['shape_3'] ?? 'assets/img/others/page_heading_shape_3.svg') }}" alt="">
  </div>
  <div class="td_page_heading_shape_4 position-absolute">
    <img src="{{ asset($page['hero']['shapes']['shape_4'] ?? 'assets/img/others/page_heading_shape_4.svg') }}" alt="">
  </div>
  <div class="td_page_heading_shape_5 position-absolute">
    <img src="{{ asset($page['hero']['shapes']['shape_5'] ?? 'assets/img/others/page_heading_shape_5.svg') }}" alt="">
  </div>
  @endif

  <div class="td_page_heading_shape_6 position-absolute td_hover_layer_3"></div>
</section>
