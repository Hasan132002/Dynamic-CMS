<header class="td_site_header td_style_1 td_type_5 td_sticky_header td_medium td_heading_color">
  <div class="td_main_header">
    <div class="container-fluid">
      <div class="td_main_header_in">

        {{-- LEFT --}}
        <div class="td_main_header_left">

          <a class="td_site_branding" href="{{ $logos['header']['link'] ?? url('/') }}">
            <img src="{{ asset(!empty($logos['header']['v8']) ? $logos['header']['v8'] : ($logos['header']['default'] ?? '')) }}" alt="Logo">
          </a>

          {{-- CATEGORY DROPDOWN --}}
          @if(!empty($header['category']))
          <div class="position-relative td_header_category_wrap">
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

          {{-- NAV --}}
          <nav class="td_nav">
            <div class="td_nav_list_wrap">
              <div class="td_nav_list_wrap_in">
                <ul class="td_nav_list">

                  @foreach($header['menu'] ?? [] as $item)
                    <li class="menu-item-has-children td_mega_menu">
                        <a href="#">{{ $item['label'] ?? '' }}</a>

                      @if(!empty($item['children']))
                        <ul class="{{ $item['wrapper_class'] ?? '' }}">
                          @foreach($item['children'] as $child)
                            <li class="{{ $child['class'] ?? '' }}">
                              @if(!empty($child['heading']))
                                <h4>{{ $child['heading'] }}</h4>
                              @endif

                              @if(!empty($child['items']))
                                <ul>
                                  @foreach($child['items'] as $sub)
                                    <li>
                                      <a href="{{ $sub['url'] ?? '#' }}">{{ $sub['label'] ?? '' }}</a>
                                    </li>
                                  @endforeach
                                </ul>
                              @else
                                <a href="{{ $child['url'] ?? '#' }}">{{ $child['label'] ?? '' }}</a>
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
          <div class="td_hero_toolbox_wrap">
            <a
              href="{{ $header['cta_button']['url'] ?? '/students-registrations' }}"
              class="td_btn td_style_1 td_radius_10 td_medium"
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
