@php($contact = isset($contact['data']) && is_array($contact['data']) ? $contact['data'] : $contact)

<section class="td_bg_filed td_heading_bg"
         data-src="{{ asset($contact['background']) }}">

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row align-items-center td_gap_y_30">

      <div class="col-lg-7 wow fadeIn"
           data-wow-duration="1s"
           data-wow-delay="0.2s">

        <div class="td_bg_img_number_box text-center">
          <p class="td_bg_img_number_box_number td_bold td_mb_21"
             data-src="{{ asset($contact['counter']['bg']) }}">
            {{ $contact['counter']['number'] }}
          </p>
          <h3 class="td_bg_img_number_box_title mb-0
                     td_fs_30 td_white_color">
            {{ $contact['counter']['label'] }}
          </h3>
        </div>

      </div>

      <div class="col-lg-5 wow fadeInRight"
           data-wow-duration="1s"
           data-wow-delay="0.3s">

        <div class="td_contact_box td_style_2
                    td_accent_bg td_radius_10">

          <h3 class="td_white_color td_fs_20
                     td_semibold td_mb_35">
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
                    class="td_btn td_style_1
                           td_radius_10 td_medium w-100">
              <span class="td_btn_in td_accent_color td_white_bg">
                <span>{{ $contact['form']['button'] }}</span>
                @include('svg.home-v6.contact.button-arrow')
              </span>
            </button>

          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
