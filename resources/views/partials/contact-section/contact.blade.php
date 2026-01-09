<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-xxl-10 offset-xxl-1">
        <div class="row align-items-center td_gap_y_40">
          <div class="col-lg-7">
            <img src="{{ asset($contactInfo['image']) }}" alt="" class="w-100">
          </div>

          <div class="col-xl-4 offset-xl-1 col-lg-5">
            <div class="td_contact_info">
              <div class="td_section_heading td_style_2 td_mb_20">
                <h2 class="td_contact_info_title td_fs_36 mb-0">
                  {{ $contactInfo['title'] }}
                </h2>
              </div>

              @foreach($globalContact['campuses'] ?? [] as $campus)
              <div class="td_mb_40">
                <h2 class="td_fs_24 td_semibold td_mb_20">
                  {{ $campus['name'] }}
                </h2>
                <p class="td_fs_18 td_heading_color td_medium td_mb_10">
                  {{ $campus['address'] }}
                </p>
                <p class="td_fs_18 td_heading_color td_medium td_mb_10 td_opacity_7">
                  <a href="tel:{{ preg_replace('/[^0-9+]/', '', $campus['phone']) }}">
                    {{ $campus['phone'] }}
                  </a>
                </p>
                <p class="td_fs_18 td_heading_color td_medium mb-0 td_opacity_7">
                  <a href="mailto:{{ $campus['email'] }}">
                    {{ $campus['email'] }}
                  </a>
                </p>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>

  <div class="td_map">
    <iframe
      id="map"
      src="{{ $globalContact['map_iframe'] ?? '' }}"
      allowfullscreen=""
    ></iframe>
  </div>
</section>
