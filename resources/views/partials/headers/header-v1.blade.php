<header class="td_site_header td_style_1 td_type_3 td_sticky_header td_medium td_heading_color">
  <div class="td_main_header">
    <div class="container-fluid">
      <div class="td_main_header_in">

        {{-- LEFT --}}
        <div class="td_main_header_left">
            <a class="td_site_branding" href="{{ url('/') }}">
            <img src="{{ asset(!empty($logos['header']['v1']) ? $logos['header']['v1'] : ($logos['header']['default'] ?? '')) }}" alt="Logo">
          </a>

          @if(!empty($header['socials']))
          <div class="td_header_social_btns">
            @foreach($header['socials'] as $social)
              <a href="{{ $social['url'] ?? '#' }}" class="td_center">
                <i class="{{ $social['icon'] ?? '' }}"></i>
              </a>
            @endforeach
          </div>
          @endif
        </div>

        {{-- CENTER --}}
        <div class="td_main_header_center">
          <nav class="td_nav">
            <div class="td_nav_list_wrap">
              <div class="td_nav_list_wrap_in">

                @php
                  // Use single menu variable and split it for left/right layout
                  $menuItems = $header['menu'] ?? [];
                  $totalItems = count($menuItems);
                  $splitPoint = (int) ceil($totalItems / 2);
                  $leftMenu = array_slice($menuItems, 0, $splitPoint);
                  $rightMenu = array_slice($menuItems, $splitPoint);
                @endphp

                {{-- LEFT MENU --}}
                <ul class="td_nav_list">
                  @foreach($leftMenu as $item)
                    <li class="{{ !empty($item['children']) ? 'menu-item-has-children' : '' }}">
                      <a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a>
                      @if(!empty($item['children']))
                        <ul>
                          @foreach($item['children'] as $child)
                            <li class="{{ !empty($child['children']) ? 'menu-item-has-children' : '' }}">
                              <a href="{{ $child['url'] ?? '#' }}">{{ $child['label'] ?? '' }}</a>
                              @if(!empty($child['children']))
                                <ul>
                                  @foreach($child['children'] as $grandchild)
                                    <li>
                                      <a href="{{ $grandchild['url'] ?? '#' }}">{{ $grandchild['label'] ?? '' }}</a>
                                    </li>
                                  @endforeach
                                </ul>
                              @endif
                            </li>
                          @endforeach
                        </ul>
                      @endif
                    </li>
                  @endforeach
                </ul>

                {{-- CENTER LOGO --}}
               <a class="td_site_branding" href="{{ url('/home') }}">
              <img src="{{ asset(!empty($logos['header']['v1']) ? $logos['header']['v1'] : ($logos['header']['default'] ?? '')) }}" alt="Logo">
            </a>

                {{-- RIGHT MENU --}}
                <ul class="td_nav_list">
                  @foreach($rightMenu as $item)
                    <li class="{{ !empty($item['children']) ? 'menu-item-has-children' : '' }}">
                      <a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a>
                      @if(!empty($item['children']))
                        <ul>
                          @foreach($item['children'] as $child)
                            <li class="{{ !empty($child['children']) ? 'menu-item-has-children' : '' }}">
                              <a href="{{ $child['url'] ?? '#' }}">{{ $child['label'] ?? '' }}</a>
                              @if(!empty($child['children']))
                                <ul>
                                  @foreach($child['children'] as $grandchild)
                                    <li>
                                      <a href="{{ $grandchild['url'] ?? '#' }}">{{ $grandchild['label'] ?? '' }}</a>
                                    </li>
                                  @endforeach
                                </ul>
                              @endif
                            </li>
                          @endforeach
                        </ul>
                      @endif
                    </li>
                  @endforeach
                </ul>

              </div>
            </div>
          </nav>
        </div>

        {{-- RIGHT --}}
        <div class="td_main_header_right">

          {{-- CTA BUTTON --}}
          @if(!empty($header['cta_button']))
          <a href="{{ $header['cta_button']['url'] ?? '/students-registrations' }}"
             class="td_btn td_style_1 td_radius_30 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $header['cta_button']['label'] ?? 'Apply Now' }}</span>
            </span>
          </a>
          @endif

          {{-- HAMBURGER --}}
          <button class="td_hamburger_btn"></button>
        </div>

      </div>
    </div>
  </div>
</header>

{{-- SIDE HEADER --}}
<div class="td_side_header">
  <button class="td_close"></button>
  <div class="td_side_header_overlay"></div>

  <div class="td_side_header_in">
    <div class="td_side_header_shape"></div>

    <a class="td_site_branding" href="{{ url('/home') }}">
       <img src="{{ asset(!empty($logos['header']['v1']) ? $logos['header']['v1'] : ($logos['header']['default'] ?? '')) }}" alt="Logo">
    </a>

    @if(!empty($header['side']['heading']))
    <div class="td_side_header_box">
      <h2 class="td_side_header_heading">
        {!! $header['side']['heading'] !!}
      </h2>
    </div>
    @endif

    @if(!empty($header['side']['contact']))
    <div class="td_side_header_box">
      <h3 class="td_side_header_title td_heading_color">
        {{ $header['side']['contact']['title'] ?? 'Contact Us' }}
      </h3>
      <ul class="td_side_header_contact_info td_mp_0">
        @if(!empty($header['side']['contact']['phone']))
        <li>
          <i class="fa-solid fa-phone"></i>
          <a href="{{ $header['side']['contact']['phone_link'] ?? '#' }}">
            {{ $header['side']['contact']['phone'] }}
          </a>
        </li>
        @endif
        @if(!empty($header['side']['contact']['email']))
        <li>
          <i class="fa-solid fa-envelope"></i>
          <a href="mailto:{{ $header['side']['contact']['email'] }}">
            {{ $header['side']['contact']['email'] }}
          </a>
        </li>
        @endif
        @if(!empty($header['side']['contact']['address']))
        <li>
          <i class="fa-solid fa-location-dot"></i>
          {!! $header['side']['contact']['address'] !!}
        </li>
        @endif
      </ul>
    </div>
    @endif

    @if(!empty($header['side']['subscribe']))
    <div class="td_side_header_box">
      <h3 class="td_side_header_title td_heading_color">
        {{ $header['side']['subscribe']['title'] ?? 'Subscribe' }}
      </h3>
      <form action="{{ $header['side']['subscribe']['action'] ?? '#' }}" class="td_newsletter_form">
        <input
          type="email"
          class="td_newsletter_input"
          placeholder="{{ $header['side']['subscribe']['placeholder'] ?? 'Email address' }}"
        >
        <button type="submit" class="td_btn td_style_1 td_radius_30 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $header['side']['subscribe']['button'] ?? 'Subscribe' }}</span>
          </span>
        </button>
      </form>
    </div>
    @endif

    @if(!empty($header['side']['social']['links']))
    <div class="td_side_header_box">
      <h3 class="td_side_header_title td_heading_color">
        {{ $header['side']['social']['title'] ?? 'Follow Us' }}
      </h3>
      <div class="td_social_btns td_style_1 td_heading_color">
        @foreach($header['side']['social']['links'] as $social)
          <a href="{{ $social['url'] ?? '#' }}" class="td_center">
            <i class="{{ $social['icon'] ?? '' }}"></i>
          </a>
        @endforeach
      </div>
    </div>
    @endif

  </div>
</div>
