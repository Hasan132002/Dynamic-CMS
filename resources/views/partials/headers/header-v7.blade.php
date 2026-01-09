<header class="td_site_header td_style_1 td_type_4 td_sticky_header td_medium td_heading_color">
  <div class="td_main_header">
    <div class="container-fluid">
      <div class="td_main_header_in">

        {{-- LEFT --}}
        <div class="td_main_header_left">
          <a class="td_site_branding" href="{{ $logos['header']['link'] ?? url('/') }}">
            <img src="{{ asset(!empty($logos['header']['v7']) ? $logos['header']['v7'] : ($logos['header']['default'] ?? '')) }}" alt="Logo">
          </a>

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
        </div>

        {{-- RIGHT --}}
        <div class="td_main_header_right">
          {{-- CTA BUTTON --}}
          @if(!empty($header['cta_button']))
          <div class="td_hero_toolbox_wrap">
            <a
              href="{{ $header['cta_button']['url'] ?? '/students-registrations' }}"
              class="td_btn td_style_1 td_radius_30 td_medium"
            >
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
