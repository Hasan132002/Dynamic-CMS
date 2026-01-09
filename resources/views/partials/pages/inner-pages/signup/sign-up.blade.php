<section>
      <div class="td_height_120 td_height_lg_80"></div>
      <div class="container">
        <div class="row td_gap_y_40">
          <div class="col-lg-6">
            <div class="td_form_card td_style_1 td_radius_10 td_gray_bg_5">
              <div class="td_form_card_in">

                <h2 class="td_fs_36 td_mb_20">{{ $form['title'] }}</h2>
                <hr>
                <div class="td_height_30 td_height_lg_30"></div>

                <input
                  type="text"
                  class="td_form_field td_mb_30 td_medium td_white_bg"
                  placeholder="{{ $form['placeholders']['full_name'] }}"
                >

                <input
                  type="text"
                  class="td_form_field td_mb_30 td_medium td_white_bg"
                  placeholder="{{ $form['placeholders']['phone'] }}"
                >

                <input
                  type="text"
                  class="td_form_field td_mb_30 td_medium td_white_bg"
                  placeholder="{{ $form['placeholders']['email'] }}"
                >

                <input
                  type="password"
                  class="td_form_field td_mb_30 td_medium td_white_bg"
                  placeholder="{{ $form['placeholders']['password'] }}"
                >

                <div class="td_form_card_bottom td_mb_25">
                  <button type="submit" class="td_btn td_style_1 td_radius_10 td_medium">
                    <span class="td_btn_in td_white_color td_accent_bg">
                      <span>{{ $form['button_text'] }}</span>
                    </span>
                  </button>

                  <p class="td_fs_20 mb-0 td_medium td_heading_color">
                    {{ $form['social_text'] }}
                  </p>

                  <div class="td_form_social td_fs_20">
                    <a href="#" class="td_center">
                      <i class="fa-brands fa-apple"></i>
                    </a>
                    <a href="#" class="td_center">
                      <i class="fa-brands fa-google"></i>
                    </a>
                    <a href="#" class="td_center">
                      <i class="fa-brands fa-facebook-f"></i>
                    </a>
                  </div>
                </div>

                <p class="td_form_card_text td_fs_20 td_medium td_heading_color mb-0">
                  {{ $form['footer_text'] }}
                  <a href="{{ $form['footer_link_url'] }}">{{ $form['footer_link_text'] }}</a>
                </p>

              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="td_sign_thumb">
              <img
                src="{{ asset($form['image']) }}"
                alt=""
                class="w-100 td_radius_10"
              >
            </div>
          </div>
        </div>
      </div>
      <div class="td_height_120 td_height_lg_80"></div>
    </section>
