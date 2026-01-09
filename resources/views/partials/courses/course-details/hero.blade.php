@php($hero = $hero)

<section class="td_page_heading td_center td_bg_filed td_heading_bg text-center td_hobble"
  data-src="{{ asset($hero['background']) }}">
  <div class="container">
    <div class="td_page_heading_in">
      <h1 class="td_white_color td_fs_48 td_mb_10">{{ $hero['title'] }}</h1>
      <ol class="breadcrumb m-0 td_fs_20 td_opacity_8 td_semibold td_white_color">
        @foreach($hero['breadcrumb'] as $item)
          <li class="breadcrumb-item {{ $item['active'] ? 'active' : '' }}">
            @if($item['active'])
              {{ $item['label'] }}
            @else
              <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
            @endif
          </li>
        @endforeach
      </ol>
    </div>
  </div>

  <div class="td_page_heading_shape_1 position-absolute td_hover_layer_3"></div>
  <div class="td_page_heading_shape_2 position-absolute td_hover_layer_5"></div>

  <div class="td_page_heading_shape_3 position-absolute">
    <img src="{{ asset($hero['shapes']['shape_3']) }}" alt="">
  </div>

  <div class="td_page_heading_shape_4 position-absolute">
    <img src="{{ asset($hero['shapes']['shape_4']) }}" alt="">
  </div>

  <div class="td_page_heading_shape_5 position-absolute">
    <img src="{{ asset($hero['shapes']['shape_5']) }}" alt="">
  </div>

  <div class="td_page_heading_shape_6 position-absolute td_hover_layer_3"></div>
</section>
