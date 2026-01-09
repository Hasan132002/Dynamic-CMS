@php($blog = isset($blog['data']) && is_array($blog['data']) ? $blog['data'] : $blog)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up_2 td_fs_18 td_semibold td_spacing_1
                  td_mb_10 text-uppercase td_heading_color td_opacity_6">
          {{ $blog['subtitle'] }}
        </p>
        <h2 class="td_section_title td_fs_48 mb-0">
          {!! $blog['title'] !!}
        </h2>
      </div>

      <div class="td_section_heading_right">
        <a href="{{ $blog['view_all']['url'] }}"
           class="td_btn td_style_2 td_heading_color td_medium td_mb_10">
          {{ $blog['view_all']['label'] }}
          <i>
            @include('svg.home-v5.blog.heading-arrow')
            @include('svg.home-v5.blog.heading-arrow')
          </i>
        </a>
      </div>

    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">

      @foreach($blog['items'] as $item)
        <div class="col-lg-4 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $item['delay'] }}">

          <div class="td_post td_style_1 td_type_3">

            <a href="{{ $item['url'] }}" class="td_post_thumb d-block">
              <img src="{{ asset($item['image']) }}" alt="">
              <i class="fa-solid fa-link"></i>
            </a>

            <div class="td_post_info">

              <div class="td_post_meta td_fs_14 td_medium td_mb_20">
                <span>
                  <img src="{{ asset($blog['icons']['calendar']) }}" alt="">
                  {{ $item['date'] }}
                </span>
                <span>
                  <img src="{{ asset($blog['icons']['user']) }}" alt="">
                  {{ $item['author'] }}
                </span>
              </div>

              <h2 class="td_post_title td_fs_30 td_medium td_mb_16">
                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
              </h2>

              <p class="td_post_subtitle td_fs_18 td_mb_20 td_heading_color">
                {{ $item['excerpt'] }}
              </p>

              <a href="{{ $item['url'] }}"
                 class="td_btn td_style_3 td_heading_color td_fs_18">
                <span>{{ $blog['read_more'] }}</span>
                <i>@include('svg.home-v5.blog.read-more-arrow')</i>
              </a>

            </div>
          </div>

        </div>
      @endforeach

    </div>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
