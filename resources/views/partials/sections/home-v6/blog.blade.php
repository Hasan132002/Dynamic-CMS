@php($blog = isset($blog['data']) && is_array($blog['data']) ? $blog['data'] : $blog)

<section>
  <div class="td_height_112 td_height_lg_75"></div>

  <div class="container">

    <div class="td_section_heading td_style_1 text-center wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <p class="td_section_subtitle_up td_fs_18 td_medium td_spacing_1
                td_mb_10 td_accent_color">
        {{ $blog['subtitle'] }}
      </p>
      <h2 class="td_section_title td_fs_48 mb-0">
        {!! $blog['title'] !!}
      </h2>
    </div>

    <div class="td_height_50 td_height_lg_50"></div>

    <div class="row td_gap_y_30">

      @foreach($blog['items'] as $item)
        <div class="col-lg-4 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $item['delay'] }}">

          <div class="td_post td_style_1 td_type_4">

            <a href="{{ $item['url'] }}"
               class="td_post_thumb d-block">
              <img src="{{ asset($item['image']) }}" alt="">
              <i class="fa-solid fa-link"></i>
            </a>

            <div class="td_post_info">

              <span class="td_post_label td_accent_bg
                           td_white_color td_fs_14">
                {{ $item['label'] }}
              </span>

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

              <h2 class="td_post_title td_fs_24 td_medium td_mb_20">
                <a href="{{ $item['url'] }}">
                  {{ $item['title'] }}
                </a>
              </h2>

              <a href="{{ $item['url'] }}"
                 class="td_btn td_style_3 td_semibold
                        td_accent_color text-uppercase">
                <span>{{ $blog['read_more'] }}</span>
                <i>
                  @include('svg.home-v6.blog.read-more-arrow')
                </i>
              </a>

            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
