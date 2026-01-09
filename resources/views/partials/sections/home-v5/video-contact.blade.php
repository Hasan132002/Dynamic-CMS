@php($contact = isset($contact['data']) && is_array($contact['data']) ? $contact['data'] : $contact)

<section>

  <div class="td_video_block td_style_2 td_center td_bg_filed"
       data-src="{{ asset($contact['video']['bg']) }}">
    <a href="{{ $contact['video']['url'] }}"
       class="td_video_open wow zoomIn"
       data-wow-duration="1s"
       data-wow-delay="0.3s">
      <span class="td_player_btn td_center">
        <span></span>
      </span>
    </a>
  </div>

  <div class="td_contact td_style_1">
    <div class="container">
      <div class="td_contact_in td_white_bg td_radius_10 td_hobble">

        <div class="td_height_100 td_height_lg_50"></div>

        <div class="row align-items-center td_gap_y_30">

          <div class="col-lg-7 wow fadeInUp"
               data-wow-duration="1s"
               data-wow-delay="0.3s">
            <div class="td_section_heading td_style_1">
              <p class="td_section_subtitle_up_2 td_fs_18 td_semibold
                        td_spacing_1 td_mb_10 text-uppercase
                        td_heading_color td_opacity_6">
                {{ $contact['subtitle'] }}
              </p>
              <h2 class="td_section_title td_fs_48 td_mb_20">
                {{ $contact['title'] }}
              </h2>
              <p class="td_section_subtitle td_fs_18 mb-0">
                {{ $contact['description'] }}
              </p>
            </div>
          </div>

          <div class="col-lg-5 wow fadeInRight"
               data-wow-duration="1s"
               data-wow-delay="0.35s">

            <div class="td_contact_box td_style_2 td_accent_bg td_radius_10">
              <h3 class="td_white_color td_fs_20 td_semibold td_mb_35">
                {{ $contact['form']['heading'] }}
              </h3>

              <form action="{{ $contact['form']['action'] }}">
                @foreach($contact['form']['fields'] as $field)
                  <div class="td_form_field_3 td_mb_30">
                    <input type="{{ $field['type'] }}"
                           class="td_white_color"
                           placeholder="{{ $field['placeholder'] }}"
                           required>
                    <label class="td_fs_20 td_semibold
                                  td_accent_bg td_white_color">
                      {{ $field['label'] }}
                    </label>
                  </div>
                @endforeach

                <button type="submit"
                        class="td_btn td_style_1 td_radius_10
                               td_medium w-100">
                  <span class="td_btn_in td_accent_color td_white_bg">
                    <span>{{ $contact['form']['button'] }}</span>
                    @include('svg.home-v5.contact.button-arrow')
                  </span>
                </button>
              </form>

            </div>
          </div>

        </div>

        <div class="td_height_100 td_height_lg_50"></div>

        @foreach($contact['shapes'] as $shape)
          <div class="{{ $shape['class'] }} position-absolute {{ $shape['hover'] }}">
            <img src="{{ asset($shape['image']) }}" alt="">
          </div>
        @endforeach

      </div>
    </div>
  </div>

</section>
