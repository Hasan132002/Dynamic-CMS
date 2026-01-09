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
                  {{ $form['credentials_title'] }}
                </h3>

                <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['email'] }}</label>
                <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_10">
                  {{ $form['labels']['password'] }}
                </label>
                <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">

                <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['confirm_password'] }}</label>
                <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">

                <div class="td_height_50 td_height_lg_40"></div>

                <h3 class="td_fs_32 td_medium td_mb_30">
                  {{ $form['profile_title'] }}
                </h3>

                <div class="row">
                  <div class="col-lg-6">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['first_name'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-6">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['last_name'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-6">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['gender'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['gender'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['dob'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['nationality'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['nationality'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['country'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['country'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['post_code'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['postcode_zip'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['phone'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['begin_studies'] }}</label>
                    <input type="text" class="td_form_field td_mb_24 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['highest_degree'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['degree'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['mba_level'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['degree'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['bba_level'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['degree'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12">
                    <label class="td_medium td_heading_color td_mb_10">{{ $form['labels']['intermediate_level'] }}</label>
                    <select class="td_form_field td_mb_24 td_medium td_white_bg">
                      @foreach ($form['selects']['degree'] as $option)
                        <option>{{ $option }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12">
                    <input type="file" class="td_form_field td_mb_40 td_medium td_white_bg">
                  </div>

                  <div class="col-lg-12">
                    <label class="td_fs_18 td_heading_color td_mb_16 td_semibold">
                      {{ $form['labels']['agreements'] }}
                    </label>
                    <div class="td_custom_checkbox td_mb_40">
                      <input type="checkbox" id="remember">
                      <label for="remember">{{ $form['agreement_text'] }}</label>
                    </div>
                  </div>

                  <div class="td_form_card_btn_group_1">
                    <button type="submit" class="td_btn td_style_1 td_radius_10 td_medium td_fs_18">
                      <span class="td_btn_in td_white_color td_accent_bg">
                        <span>{{ $form['buttons']['submit'] }}</span>
                        @include('svg.pages.instructor-reg.arrow')
                      </span>
                    </button>

                    <button type="button" class="td_btn td_style_1 td_radius_10 td_medium td_fs_18">
                      <span class="td_btn_in td_heading_color td_white_bg">
                        <span>{{ $form['buttons']['cancel'] }}</span>
                      </span>
                    </button>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="td_height_120 td_height_lg_80"></div>
    </section>
