<footer class="td_footer td_style_1">
  <div class="container">
    <div class="td_footer_row">
      <div class="td_footer_col">
        <div class="td_footer_widget">
          <div class="td_footer_text_widget td_fs_18">
            <img src="{{ asset(!empty($logos['footer']['v1']) ? $logos['footer']['v1'] : ($logos['footer']['default'] ?? '')) }}" alt="Logo">
            <p>{{ $footer['about']['text'] ?? '' }}</p>
          </div>
          <ul class="td_footer_address_widget td_medium td_mp_0">
            @if(!empty($footer['about']['phone']))
            <li>
              <i class="fa-solid fa-phone-volume"></i>
              <a href="{{ $footer['about']['phone_link'] ?? '#' }}">{{ $footer['about']['phone'] }}</a>
            </li>
            @endif
            @if(!empty($footer['about']['email']))
            <li>
              <i class="fa-solid fa-envelope"></i>
              <a href="mailto:{{ $footer['about']['email'] }}">{{ $footer['about']['email'] }}</a>
            </li>
            @endif
            @if(!empty($footer['about']['address']))
            <li>
              <i class="fa-solid fa-location-dot"></i>
              {!! $footer['about']['address'] !!}
            </li>
            @endif
          </ul>
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
        @if(!empty($footer['bottom']['links']))
        <ul class="td_footer_widget_menu">
          @foreach($footer['bottom']['links'] as $link)
            <li><a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
          @endforeach
        </ul>
        @endif
      </div>
    </div>
  </div>
</footer>
