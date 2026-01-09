<footer class="td_footer td_style_1 td_type_1 td_color_1">
  <div class="container">
    <div class="td_footer_row">
      <div class="td_footer_col">
        <div class="td_footer_widget">
          <div class="td_footer_text_widget td_fs_18">
            <img src="{{ asset(!empty($logos['footer']['v4']) ? $logos['footer']['v4'] : ($logos['footer']['default'] ?? '')) }}" alt="Logo">
            <p>{{ $footer['about']['text'] ?? '' }}</p>
          </div>
          @if(!empty($footer['about']['socials']))
          <div class="td_footer_social_btns td_fs_20">
            @foreach($footer['about']['socials'] as $social)
              <a href="{{ $social['url'] ?? '#' }}" class="td_center">
                <i class="{{ $social['icon'] ?? '' }}"></i>
              </a>
            @endforeach
          </div>
          @endif
        </div>
      </div>

      @if(!empty($footer['navigate']))
      <div class="td_footer_col">
        <div class="td_footer_widget">
          <h2 class="td_footer_widget_title td_fs_32 td_white_color td_medium td_mb_30">
            {{ $footer['navigate']['title'] ?? '' }}
          </h2>
          <ul class="td_footer_widget_menu">
            @foreach($footer['navigate']['links'] ?? [] as $link)
              <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif

      @if(!empty($footer['courses']))
      <div class="td_footer_col">
        <div class="td_footer_widget">
          <h2 class="td_footer_widget_title td_fs_32 td_white_color td_medium td_mb_30">
            {{ $footer['courses']['title'] ?? '' }}
          </h2>
          <ul class="td_footer_widget_menu">
            @foreach($footer['courses']['links'] ?? [] as $link)
              <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      @endif

      @if(!empty($footer['subscribe']))
      <div class="td_footer_col">
        <div class="td_footer_widget">
          <h2 class="td_footer_widget_title td_fs_32 td_white_color td_medium td_mb_30">
            {{ $footer['subscribe']['title'] ?? '' }}
          </h2>
          <div class="td_newsletter td_style_1">
            <p class="td_mb_20 td_opacity_7">{{ $footer['subscribe']['text'] ?? '' }}</p>
            <form action="{{ $footer['subscribe']['form_action'] ?? '#' }}" class="td_newsletter_form">
              <input type="email" class="td_newsletter_input" placeholder="{{ $footer['subscribe']['placeholder'] ?? 'Email address' }}">
              <button type="submit" class="td_btn td_style_1 td_radius_30 td_medium">
                <span class="td_btn_in td_white_color td_accent_bg">
                  <span>{{ $footer['subscribe']['button'] ?? 'Subscribe' }}</span>
                </span>
              </button>
            </form>
          </div>
          @if(!empty($footer['about']['socials']))
          <div class="td_footer_social_btns td_fs_20">
            @foreach($footer['about']['socials'] as $social)
              <a href="{{ $social['url'] ?? '#' }}" class="td_center">
                <i class="{{ $social['icon'] ?? '' }}"></i>
              </a>
            @endforeach
          </div>
          @endif
        </div>
      </div>
      @endif
    </div>
  </div>

  <div class="td_footer_bottom td_fs_18">
    <div class="container">
      <div class="td_footer_bottom_in">
        <p class="td_copyright mb-0">
          {{ $footer['bottom']['copyright'] ?? '' }}
        </p>
      </div>
    </div>
  </div>
</footer>
