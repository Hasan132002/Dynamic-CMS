<header class="td_site_header td_style_1 td_type_2 td_sticky_header td_medium td_heading_color">

  {{-- TOP HEADER --}}
  @if(!empty($header['contact']))
  <div class="td_top_header td_heading_bg td_white_color">
    <div class="container">
      <div class="td_top_header_in">
        <ul class="td_header_contact_list td_mp_0 td_normal">
          @if(!empty($header['contact']['phone']))
          <li>
            <img src="{{ asset($header['contact']['phone']['icon'] ?? '') }}">
            {{ $header['contact']['phone']['label'] ?? 'Call' }}:
            <a href="tel:{{ $header['contact']['phone']['value'] ?? '' }}">
              {{ $header['contact']['phone']['value'] ?? '' }}
            </a>
          </li>
          @endif
          @if(!empty($header['contact']['email']))
          <li>
            <img src="{{ asset($header['contact']['email']['icon'] ?? '') }}">
            {{ $header['contact']['email']['label'] ?? 'Email' }}:
            <a href="mailto:{{ $header['contact']['email']['value'] ?? '' }}">
              {{ $header['contact']['email']['value'] ?? '' }}
            </a>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  @endif

  {{-- MAIN HEADER --}}
  <div class="td_main_header">
    <div class="container">
      <div class="td_main_header_in">

        {{-- LEFT --}}
        <div class="td_main_header_left">
          <a class="td_site_branding" href="{{ url('/home') }}">
            <img src="{{ asset(!empty($logos['header']['v3']) ? $logos['header']['v3'] : ($logos['header']['default'] ?? '')) }}" alt="Logo">
          </a>

          {{-- CATEGORY DROPDOWN --}}
          @if(!empty($header['category']))
          <div class="td_header_category_wrap position-relative">
            <button class="td_header_dropdown_btn td_medium td_heading_color">
              <img src="{{ asset($header['category']['icon'] ?? '') }}" alt="">
              <span>{{ $header['category']['label'] ?? '' }}</span>
              <span class="td_header_dropdown_btn_tobble_icon td_center">
                 @include('svg.home-v8.header.dropdown-arrow')
              </span>
            </button>

            <ul class="td_header_dropdown_list td_mp_0">
              @foreach($header['category']['items'] ?? [] as $cat)
                <li>
                  <a href="{{ $cat['url'] ?? '#' }}">{{ $cat['label'] ?? '' }}</a>
                </li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>

        {{-- RIGHT --}}
        <div class="td_main_header_right">

          {{-- NAV --}}
          <nav class="td_nav">
            <div class="td_nav_list_wrap">
              <div class="td_nav_list_wrap_in">
                <ul class="td_nav_list">

                  @foreach($header['menu'] ?? [] as $item)

                    {{-- MEGA MENU --}}
                    @if(!empty($item['mega']))
                      <li class="menu-item-has-children td_mega_menu">
                        <a href="#">{{ $item['label'] ?? '' }}</a>
                        <ul class="td_mega_wrapper">
                          @foreach($item['columns'] ?? [] as $column)
                            <li class="menu-item-has-children">
                              <h4>{{ $column['title'] ?? '' }}</h4>
                              <ul>
                                @foreach($column['links'] ?? [] as $link)
                                  <li>
                                    <a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a>
                                  </li>
                                @endforeach
                              </ul>
                            </li>
                          @endforeach
                        </ul>
                      </li>

                    {{-- DROPDOWN --}}
                    @elseif(!empty($item['children']))
                      <li class="menu-item-has-children">
                        <a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a>
                        <ul>
                          @foreach($item['children'] as $child)
                            <li>
                              <a href="{{ $child['url'] ?? '#' }}">{{ $child['label'] ?? '' }}</a>
                            </li>
                          @endforeach
                        </ul>
                      </li>

                    {{-- NORMAL --}}
                    @else
                      <li>
                        <a href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a>
                      </li>
                    @endif

                  @endforeach

                </ul>
              </div>
            </div>
          </nav>

          {{-- CTA BUTTON --}}
          @if(!empty($header['cta_button']))
          <div class="td_hero_toolbox_wrap">
            <a href="{{ $header['cta_button']['url'] ?? '/students-registrations' }}"
               class="td_btn td_style_1 td_radius_30 td_medium">
              <span class="td_btn_in td_white_color td_accent_bg">
                <span>{{ $header['cta_button']['label'] ?? 'Apply Now' }}</span>
              </span>
            </a>
          </div>
          @endif

        </div>

      </div>
    </div>
  </div>

</header>
