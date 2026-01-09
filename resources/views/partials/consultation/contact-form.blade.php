<!-- Contact Form Section -->
<section class="td_contact_section td_accent_bg position-relative">
  <div class="td_height_80 td_height_lg_60"></div>
  <div class="container position-relative td_z_2">
    <div class="row align-items-center td_gap_y_40">
      <div class="col-lg-5 wow fadeInLeft" data-wow-duration="1s">
        <div class="td_cta_content">
          <h2 class="td_fs_32 td_white_color td_mb_10" style="text-transform: uppercase;">
            HAVE ANY QUESTIONS?
          </h2>
          <h3 class="td_fs_48 td_bold td_white_color td_mb_20" style="text-transform: uppercase;">
            GET IN TOUCH WITH US
          </h3>
          <p class="td_fs_16 td_white_color td_opacity_9 mb-0" style="line-height: {{ $fonts['line_heights']['prose'] ?? '1.7' }};">
            Our dedicated team is ready to assist you with any inquiries about our programs, admissions process, or consultation services.
          </p>
        </div>
      </div>
      <div class="col-lg-7 wow fadeInRight" data-wow-duration="1s">
        <div class="td_contact_form_box" style="background: {{ $colors['base']['white'] ?? '#fff' }}; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px {{ $colors['components']['shadow_medium'] ?? 'rgba(0,0,0,0.1)' }};">
          <h3 class="td_fs_22 td_semibold td_heading_color td_mb_25">Send Us A Message</h3>
          <form action="{{ $page['form']['action'] ?? '#' }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 td_mb_20">
                <input type="text" name="name" placeholder="Full Name" class="td_form_input" style="width: 100%; padding: 14px 18px; border: 1px solid {{ $colors['components']['border_light'] ?? '#e5e5e5' }}; border-radius: 8px; font-size: 15px;">
              </div>
              <div class="col-md-6 td_mb_20">
                <input type="email" name="email" placeholder="Email Address" class="td_form_input" style="width: 100%; padding: 14px 18px; border: 1px solid {{ $colors['components']['border_light'] ?? '#e5e5e5' }}; border-radius: 8px; font-size: 15px;">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 td_mb_20">
                <input type="tel" name="phone" placeholder="Phone Number" class="td_form_input" style="width: 100%; padding: 14px 18px; border: 1px solid {{ $colors['components']['border_light'] ?? '#e5e5e5' }}; border-radius: 8px; font-size: 15px;">
              </div>
              <div class="col-md-6 td_mb_20">
                <select name="service" class="td_form_input td_form_select" style="width: 100%; padding: 14px 18px; border: 1px solid {{ $colors['components']['border_light'] ?? '#e5e5e5' }}; border-radius: 8px; font-size: 15px; background: {{ $colors['base']['white'] ?? '#fff' }};">
                  <option value="">Select Service</option>
                  <option value="academic">Academic Guidance</option>
                  <option value="career">Career Counseling</option>
                  <option value="international">International Support</option>
                  <option value="financial">Financial Aid</option>
                </select>
              </div>
            </div>
            <div class="td_mb_25">
              <textarea name="message" rows="4" placeholder="Your Message" class="td_form_input td_form_textarea" style="width: 100%; padding: 14px 18px; border: 1px solid {{ $colors['components']['border_light'] ?? '#e5e5e5' }}; border-radius: 8px; font-size: 15px; resize: vertical;"></textarea>
            </div>
            <button type="submit" class="td_btn td_style_1 td_radius_10 td_medium">
              <span class="td_btn_in td_accent_bg td_white_color" style="padding: 16px 35px; font-weight: {{ $fonts['weights']['semibold'] ?? 600 }};">
                Send Message <i class="fa-solid fa-arrow-right" style="margin-left: 10px;"></i>
              </span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_80 td_height_lg_60"></div>
</section>
