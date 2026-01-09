<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_row_reverse_lg td_gap_y_50">

      {{-- BLOG POSTS --}}
      <div class="col-lg-8">
        <div class="row td_gap_y_30">

          @foreach($blogWithSidebar['posts'] as $post)
            <div class="col-lg-6">
              <div class="td_post td_style_1">
                <a href="{{ $post['link'] }}" class="td_post_thumb d-block">
                  <img src="{{ asset($post['image']) }}" alt="">
                  <i class="fa-solid fa-link"></i>
                </a>

                <div class="td_post_info">
                  <div class="td_post_meta td_fs_14 td_medium td_mb_20">
                    <span>
                      <img src="{{ asset($blogWithSidebar['icons']['calendar']) }}" alt="">
                      {{ $post['date'] }}
                    </span>
                    <span>
                      <img src="{{ asset($blogWithSidebar['icons']['user']) }}" alt="">
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
                      <span>{{ $blogWithSidebar['read_more'] }}</span>
                    </span>
                  </a>
                </div>
              </div>
            </div>
          @endforeach

        </div>

        <div class="td_height_60 td_height_lg_40"></div>

        {{-- PAGINATION --}}
        <ul class="td_page_pagination td_mp_0 td_fs_18 td_semibold">
          <li>
            <button class="td_page_pagination_item td_center" type="button">
              <i class="fa-solid fa-angles-left"></i>
            </button>
          </li>

          @foreach($blogWithSidebar['pagination'] as $page)
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

      {{-- SIDEBAR --}}
      <div class="col-lg-4">
        <div class="td_left_sidebar">

          {{-- SEARCH --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">
              {{ $blogWithSidebar['sidebar']['search']['title'] }}
            </h3>
            <form action="#" class="td_sidebar_search">
              <input type="text"
                     placeholder="{{ $blogWithSidebar['sidebar']['search']['placeholder'] }}"
                     class="td_sidebar_search_input">
              <button type="submit" class="td_sidebar_search_btn td_center">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </form>
          </div>

          {{-- RECENT POSTS --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">
              {{ $blogWithSidebar['sidebar']['recent']['title'] }}
            </h3>
            <ul class="td_recent_post_list td_mp_0">

              @foreach($blogWithSidebar['sidebar']['recent']['posts'] as $recent)
                <li>
                  <div class="td_recent_post">
                    <a href="{{ $recent['link'] }}" class="td_recent_post_thumb">
                      <img src="{{ asset($recent['image']) }}" alt="">
                    </a>
                    <div class="td_recent_post_right">
                      <p class="td_recent_post_date mb-0 td_fs_14">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ $recent['date'] }}</span>
                      </p>
                      <h3 class="td_fs_16 td_semibold mb-0">
                        <a href="{{ $recent['link'] }}">{{ $recent['title'] }}</a>
                      </h3>
                    </div>
                  </div>
                </li>
              @endforeach

            </ul>
          </div>

          {{-- POPULAR KEYWORD --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">
              {{ $blogWithSidebar['sidebar']['categories']['title'] }}
            </h3>
            <ul class="td_sidebar_widget_list">
              @foreach($blogWithSidebar['sidebar']['categories']['items'] as $cat)
                <li class="cat-item">
                  <a href="#">
                    <span>{{ $cat['name'] }}</span>
                    <span>({{ $cat['count'] }})</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>

          {{-- TAGS --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">
              {{ $blogWithSidebar['sidebar']['tags']['title'] }}
            </h3>
            <div class="tagcloud">
              @foreach($blogWithSidebar['sidebar']['tags']['items'] as $tag)
                <a href="#" class="tag-cloud-link">{{ $tag }}</a>
              @endforeach
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
