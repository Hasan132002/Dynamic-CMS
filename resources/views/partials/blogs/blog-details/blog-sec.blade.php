<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_gap_y_50">

      {{-- ================= LEFT CONTENT ================= --}}
      <div class="col-lg-8">

        {{-- HEADER --}}
        <div class="td_blog_details_head td_mb_40">
          <img src="{{ asset($blog['header']['image']) }}" alt="">

          <div class="td_blog_details_head_meta">
            <div class="td_blog_details_avatar">
              <img src="{{ asset($blog['header']['author_avatar']) }}" alt="">
              <p class="mb-0 td_heading_color td_bold">
                <span class="td_normal td_opacity_5">By</span>
                {{ $blog['header']['author'] }}
              </p>
            </div>

            <ul class="td_blog_details_head_meta_list td_mp_0 td_heading_color">
              <li>
                <div class="td_icon_btns">
                  <span class="td_icon_btn td_center td_heading_color">
                    @include('svg.blogs.blog-details.calendar')
                  </span>
                </div>
                {{ $blog['header']['date'] }}
              </li>

              <li>
                <div class="td_icon_btns">
                  <button class="td_icon_btn td_center td_heading_color">
                    @include('svg.blogs.blog-details.like')
                  </button>
                  <button class="td_icon_btn td_center td_heading_color">
                    @include('svg.blogs.blog-details.like')
                  </button>
                </div>
                {{ $blog['header']['likes'] }}
              </li>

              <li>
                <div class="td_icon_btns">
                  <a href="#" class="td_icon_btn td_center td_heading_color">
                    @include('svg.blogs.blog-details.share')
                  </a>
                </div>
                {{ $blog['header']['shares'] }}
              </li>
            </ul>
          </div>
        </div>

        {{-- CONTENT --}}
        <div class="td_blog_details">
          <h2>{{ $blog['content']['title'] }}</h2>
          <p>{!! $blog['content']['paragraph_1'] !!}</p>

          <blockquote>
            {{ $blog['content']['quote'] }}
            @include('svg.blogs.blog-details.quote')
          </blockquote>

          <h3>{{ $blog['content']['subheading'] }}</h3>
          <p>{{ $blog['content']['paragraph_2'] }}</p>

          <div class="row">
            <div class="col-xxl-5">
              <div class="td_video_block td_style_1 td_accent_bg td_bg_filed td_center text-center"
                   data-src="{{ asset($blog['video']['background']) }}">
                <a href="{{ $blog['video']['url'] }}" class="td_player_btn_wrap_2 td_video_open">
                  <span class="td_player_btn td_center"><span></span></span>
                </a>
              </div>
            </div>

            <div class="col-xxl-6">
              <div class="td_blog_details_inside_box">
                <h3>{{ $blog['inside_box']['title'] }}</h3>
                <p>{{ $blog['inside_box']['text'] }}</p>

                <ul class="td_list td_style_2 td_fs_18 td_medium td_heading_color td_mp_0">
                  @foreach($blog['inside_box']['list'] as $item)
                    <li>
                      @include('svg.blogs.blog-details.check')
                      {{ $item }}
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>

          <p>{{ $blog['content']['paragraph_3'] }}</p>
        </div>

        {{-- TAGS & SOCIAL --}}
        <div class="td_post_share">
          <div class="td_categories">
            <h4 class="mb-0 td_fs_18">{{ $blog['post_share']['tags_label'] }}</h4>
            @foreach($blog['tags'] as $tag)
              <a href="#" class="td_category">{{ $tag }}</a>
            @endforeach
          </div>

          <div class="td_footer_social_btns td_fs_18 td_accent_color">
            @foreach($blog['socials'] as $social)
              <a href="{{ $social['link'] }}" class="td_center"><i class="{{ $social['icon'] }}"></i></a>
            @endforeach
          </div>
        </div>

        <div class="td_height_40 td_height_lg_40"></div>

        {{-- AUTHOR --}}
        <div class="td_author_card">
          <div class="td_author_card_in">
            <img src="{{ asset($blog['author']['image']) }}" class="td_author_card_thumb" alt="">
            <div class="td_author_card_right">
              <p class="td_medium td_accent_color td_mb_10">{{ $blog['author']['label'] }}</p>
              <h3 class="td_fs_20 td_semibold td_mb_10">{{ $blog['author']['name'] }}</h3>
              <p class="mb-0">{{ $blog['author']['bio'] }}</p>
            </div>
          </div>
        </div>

        <div class="td_height_40 td_height_lg_40"></div>

        {{-- COMMENTS --}}
        <div id="comments" class="comments-area">
          <h2 class="comments-title td_fs_20 td_semibold">
            {{ count($blog['comments']) }} Comments
          </h2>

          <ol class="comment-list">
            @foreach($blog['comments'] as $comment)
              <li class="comment {{ $comment['highlight'] ? 'cs-accent_4_bg' : '' }}">
                <div class="comment-body">

                  <div class="comment-author vcard">
                    <img class="avatar" src="{{ asset($comment['avatar']) }}" alt="">
                    <a href="#" class="url">{{ $comment['name'] }}</a>
                  </div>

                  <div class="comment-meta">
                    <a href="#">{{ $comment['date'] }}</a>
                  </div>

                  <p>{{ $comment['text'] }}</p>

                  <div class="reply">
                    <a class="comment-reply-link" href="{{ $comment['reply_link'] }}">
                      {{ $blog['post_share']['reply_text'] }}
                    </a>
                  </div>

                </div>
              </li>
            @endforeach
          </ol>
        </div>

        <div class="td_height_60 td_height_lg_40"></div>

        {{-- COMMENT FORM --}}
        <div class="td_comment_wrap">
          <h2 class="td_fs_24 td_semibold td_mb_10">{{ $blog['comment_form']['title'] }}</h2>
          <p class="td_mb_16 td_heading_color">
            {{ $blog['comment_form']['description'] }}
          </p>

          <form class="row td_gap_y_20">
            <div class="col-lg-12">
              <textarea class="td_form_field" rows="{{ $blog['comment_form']['fields']['comment']['rows'] }}" 
                placeholder="{{ $blog['comment_form']['fields']['comment']['placeholder'] }}"></textarea>
            </div>

            <div class="col-lg-4">
              <input class="td_form_field" placeholder="{{ $blog['comment_form']['fields']['name']['placeholder'] }}">
            </div>
            <div class="col-lg-4">
              <input class="td_form_field" placeholder="{{ $blog['comment_form']['fields']['email']['placeholder'] }}">
            </div>
            <div class="col-lg-4">
              <input class="td_form_field" placeholder="{{ $blog['comment_form']['fields']['website']['placeholder'] }}">
            </div>

            <div class="col-lg-12">
              <button class="td_btn td_style_1 td_radius_10 td_medium">
                <span class="td_btn_in td_white_color td_accent_bg">
                  <span>{{ $blog['comment_form']['button']['text'] }}</span>
                  @include('svg.blogs.blog-details.submit')
                </span>
              </button>
            </div>
          </form>
        </div>

      </div>

      {{-- ================= SIDEBAR ================= --}}
      <div class="col-lg-4">
        <div class="td_left_sidebar">

          {{-- SEARCH --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">{{ $sidebar['search']['title'] }}</h3>
            <form class="td_sidebar_search">
              <input type="text" placeholder="{{ $sidebar['search']['placeholder'] }}" class="td_sidebar_search_input">
              <button class="td_sidebar_search_btn td_center">
                <i class="{{ $sidebar['search']['button_icon'] }}"></i>
              </button>
            </form>
          </div>

          {{-- RECENT POSTS --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">{{ $sidebar['recent_posts']['title'] }}</h3>

            <ul class="td_recent_post_list td_mp_0">
              @foreach($sidebar['recent_posts']['posts'] as $post)
                <li>
                  <div class="td_recent_post">
                    <a href="{{ $post['link'] }}" class="td_recent_post_thumb">
                      <img src="{{ asset($post['image']) }}" alt="">
                    </a>

                    <div class="td_recent_post_right">
                      <p class="td_recent_post_date mb-0 td_fs_14">
                        <i class="{{ $post['calendar_icon'] }}"></i>
                        <span>{{ $post['date'] }}</span>
                      </p>

                      <h3 class="td_fs_16 td_semibold mb-0">
                        <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
                      </h3>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>

          {{-- POPULAR KEYWORDS --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">{{ $sidebar['popular_keywords']['title'] }}</h3>

            <ul class="td_sidebar_widget_list">
              @foreach($sidebar['popular_keywords']['keywords'] as $item)
                <li class="cat-item">
                  <a href="{{ $item['link'] }}">
                    <span>{{ $item['label'] }}</span>
                    <span>({{ $item['count'] }})</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>

          {{-- TAGS --}}
          <div class="td_sidebar_widget">
            <h3 class="td_sidebar_widget_title td_fs_20 td_mb_30">{{ $sidebar['tags']['title'] }}</h3>

            <div class="tagcloud">
              @foreach($sidebar['tags']['tags'] as $tag)
                <a href="{{ $tag['link'] }}" class="tag-cloud-link">{{ $tag['label'] }}</a>
              @endforeach
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>