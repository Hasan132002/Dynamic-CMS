@php($blog = isset($blog['data']) && is_array($blog['data']) ? $blog['data'] : $blog)

<section>

  <div class="td_height_{{ $blog['spacing']['top'] }} td_height_lg_{{ $blog['spacing']['top_lg'] }}"></div>

  <div class="container">

    {{-- HEADING --}}
    <div class="td_section_heading td_style_1 td_type_1 wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <div class="td_section_heading_left">
        <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
          {{ $blog['heading']['subtitle'] }}
        </p>

        <h2 class="td_section_title td_fs_48 mb-0">
          {!! nl2br(e($blog['heading']['title'])) !!}
        </h2>
      </div>

      <div class="td_section_heading_right">
        <a href="{{ $blog['heading']['button']['url'] }}"
           class="td_btn td_style_2 td_heading_color td_medium td_mb_10">
          {{ $blog['heading']['button']['label'] }}
          <i>
            @include('svg.home-v3.blog.heading-arrow')
            @include('svg.home-v3.blog.heading-arrow')
          </i>
        </a>
      </div>
    </div>

    <div class="td_height_{{ $blog['spacing']['between'] }} td_height_lg_{{ $blog['spacing']['between_lg'] }}"></div>

    {{-- POSTS --}}
    <div class="row td_gap_y_24">

      @foreach($blog['posts'] as $post)
        <div class="col-lg-4 wow fadeInUp"
             data-wow-duration="1s"
             data-wow-delay="{{ $post['delay'] }}s">

          <div class="td_post td_style_1">
            <a href="{{ $post['url'] }}" class="td_post_thumb d-block">
              <img src="{{ asset($post['image']) }}" alt="">
              <i class="fa-solid fa-link"></i>
            </a>

            <div class="td_post_info">

              <div class="td_post_meta td_fs_14 td_medium td_mb_20">
                <span>
                  <img src="{{ asset($blog['meta_icons']['date']) }}" alt="">
                  {{ $post['date'] }}
                </span>
                <span>
                  <img src="{{ asset($blog['meta_icons']['author']) }}" alt="">
                  {{ $post['author'] }}
                </span>
              </div>

              <h2 class="td_post_title td_fs_24 td_medium td_mb_16">
                <a href="{{ $post['url'] }}">{{ $post['title'] }}</a>
              </h2>

              <p class="td_post_subtitle td_mb_24 td_heading_color td_opacity_7">
                {{ $post['excerpt'] }}
              </p>

              <a href="{{ $post['url'] }}"
                 class="td_btn td_style_1 td_type_4 td_radius_30 td_medium">
                <span class="td_btn_in td_accent_color">
                  <span class="td_btn_text">Read More</span>
                  <span class="td_btn_icon">
                    @include('svg.home-v3.blog.read-more-icon')
                  </span>
                </span>
              </a>

            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="td_height_{{ $blog['spacing']['bottom'] }} td_height_lg_{{ $blog['spacing']['bottom_lg'] }}"></div>
</section>
