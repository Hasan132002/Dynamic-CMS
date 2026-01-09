<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_gap_y_30">

      @foreach($blogList['posts'] as $post)
        <div class="col-lg-4">
          <div class="td_post td_style_1">

            <a href="{{ $post['link'] }}" class="td_post_thumb d-block">
              <img src="{{ asset($post['image']) }}" alt="">
              <i class="fa-solid fa-link"></i>
            </a>

            <div class="td_post_info">
              <div class="td_post_meta td_fs_14 td_medium td_mb_20">
                <span>
                  <img src="{{ asset($blogList['icons']['calendar']) }}" alt="">
                  {{ $post['date'] }}
                </span>
                <span>
                  <img src="{{ asset($blogList['icons']['user']) }}" alt="">
                  {{ $post['author'] }}
                </span>
              </div>

              <h2 class="td_post_title td_fs_24 td_medium td_mb_16">
                <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
              </h2>

              <p class="td_post_subtitle td_mb_24 td_heading_color td_opacity_7">
                {{ $post['excerpt'] }}
              </p>

              <a href="{{ $post['link'] }}" class="td_btn td_style_1 td_type_3 td_radius_30 td_medium">
                <span class="td_btn_in td_accent_color">
                  <span>{{ $blogList['read_more'] }}</span>
                </span>
              </a>
            </div>

          </div>
        </div>
      @endforeach

    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    <ul class="td_page_pagination td_mp_0 td_fs_18 td_semibold">
      <li>
        <button class="td_page_pagination_item td_center" type="button">
          <i class="fa-solid fa-angles-left"></i>
        </button>
      </li>

      @foreach($blogList['pagination'] as $page)
        <li>
          <a class="td_page_pagination_item td_center {{ $page['active'] ? 'active' : '' }}" href="#">
            {{ $page['number'] }}
          </a>
        </li>
      @endforeach

      <li>
        <button class="td_page_pagination_item td_center" type="button">
          <i class="fa-solid fa-angles-right"></i>
        </button>
      </li>
    </ul>

  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
