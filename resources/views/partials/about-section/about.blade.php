
<section>
  <div class="td_height_120 td_height_lg_80"></div>
  <div class="td_about td_style_1">
    <div class="container">
      <div class="row align-items-center td_gap_y_40">
        <div class="col-lg-6 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="td_about_thumb_wrap">
            <div class="td_about_year text-uppercase td_fs_64 td_bold">
              {{ $about['year'] }}
            </div>
            <div class="td_about_thumb_1">
              <img src="{{ asset($about['images']['image_1']) }}" alt="">
            </div>
            <div class="td_about_thumb_2">
              <img src="{{ asset($about['images']['image_2']) }}" alt="">
            </div>
            <a href="{{ $about['video_url'] }}" class="td_circle_text td_center td_video_open">
              @include('svg.about.about-section.play-icon')
              <img src="{{ asset($about['circle_text_image']) }}" alt="" class="">
            </a>
            <div class="td_circle_shape"></div>
          </div>
        </div>

        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
          <div class="td_section_heading td_style_1 td_mb_30">
            <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
              {{ $about['subtitle'] }}
            </p>
            <h2 class="td_section_title td_fs_48 mb-0">
              {{ $about['title'] }}
            </h2>
            <p class="td_section_subtitle td_fs_18 mb-0">
              {{ $about['description'] }}
            </p>
          </div>

          <div class="td_mb_40">
            <ul class="td_list td_style_5 td_mp_0">
              @foreach($about['programs'] as $program)
              <li>
                <h3 class="td_fs_24 td_mb_8">{{ $program['title'] }}</h3>
                <p class="td_fs_18 mb-0">{{ $program['text'] }}</p>
              </li>
              @endforeach
            </ul>
          </div>

          <a href="{{ $about['button']['url'] }}" class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $about['button']['label'] }}</span>
              @include('svg.about.about-section.arrow-icon')
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="td_height_120 td_height_lg_80"></div>
</section>
