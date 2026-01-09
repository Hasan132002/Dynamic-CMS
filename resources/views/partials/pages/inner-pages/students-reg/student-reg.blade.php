<section>
      <div class="td_height_120 td_height_lg_80"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <div class="td_form_card td_style_1 td_radius_10 td_gray_bg_5">
              <div class="td_form_card_in">

                <h2 class="td_fs_36 td_mb_20 text-uppercase td_mb_16">
                  {{ $form['title'] }}
                </h2>

                <h3 class="td_fs_24 td_medium td_opacity_9 td_mb_32">
                  {{ $form['subtitle'] }}
                </h3>

                <p class="td_fs_18 td_heading_color td_opacity_7 td_mb_40">
                  {{ $form['description'] }}
                </p>

                <h3 class="td_fs_32 td_medium td_mb_30">
                  {{ $form['section_title'] }}
                </h3>

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['first_name'] }}
                </label>
                <input type="text" class="td_form_field td_mb_30 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['last_name'] }}
                </label>
                <input type="text" class="td_form_field td_mb_30 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['user_name'] }}
                </label>
                <input type="text" class="td_form_field td_mb_30 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['course_name'] }}
                </label>
                <input type="text" class="td_form_field td_mb_30 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['email'] }}
                </label>
                <input type="text" class="td_form_field td_mb_30 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['password'] }}
                </label>
                <input type="password" class="td_form_field td_mb_30 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_12">
                  {{ $form['labels']['confirm_password'] }}
                </label>
                <input type="password" class="td_form_field td_mb_30 td_medium td_white_bg">

                <button type="submit" class="td_btn td_style_1 td_radius_10 td_medium w-100 td_fs_20">
                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ $form['button_text'] }}</span>
                    @include('svg.pages.student-reg.arrow')
                  </span>             
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="td_height_120 td_height_lg_80"></div>
    </section>
