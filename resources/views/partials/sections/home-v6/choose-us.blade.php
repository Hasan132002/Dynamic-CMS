@php($choose = isset($choose['data']) && is_array($choose['data']) ? $choose['data'] : $choose)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_40">

      <div class="col-xl-6 wow fadeIn"
           data-wow-duration="1s"
           data-wow-delay="0.2s">
        <div class="td_pr_50">
          <img src="{{ asset($choose['image']) }}" alt="">
        </div>
      </div>

      <div class="col-xl-6 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="td_section_heading td_style_1 td_mb_30">
          <p class="td_section_subtitle_up td_fs_18 td_medium
                    td_spacing_1 td_mb_10 td_accent_color">
            {{ $choose['subtitle'] }}
          </p>
          <h2 class="td_section_title td_fs_48 mb-0">
            {{ $choose['title'] }}
          </h2>
        </div>

        <div class="td_tabs td_style_1 td_mb_40">

          <div class="td_mb_40">
            <ul class="td_tab_links td_style_4 td_mp_0
                       td_semibold td_accent_color">
              @foreach($choose['tabs'] as $index => $tab)
                <li class="{{ $index === 0 ? 'active' : '' }}">
                  <a href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
                </li>
              @endforeach
            </ul>
          </div>

          <div class="td_tab_body">
            @foreach($choose['tabs'] as $index => $tab)
              <div class="td_tab {{ $index === 0 ? 'active' : '' }}"
                   id="{{ $tab['id'] }}">
                <p class="td_fs_18 mb-0 td_heading_color">
                  {!! $tab['content'] !!}
                </p>
              </div>
            @endforeach
          </div>

        </div>

        <a href="{{ $choose['button']['url'] }}"
           class="td_btn td_style_1 td_medium td_with_shadow_2">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $choose['button']['label'] }}</span>
          </span>
        </a>

      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
