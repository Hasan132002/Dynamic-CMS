<section class="td_page_heading td_center td_bg_filed td_heading_bg td_hobble" data-src="{{ asset('assets/img/others/page_heading_bg.jpg') }}">
  <div class="td_page_heading_in">
    <div class="container">
      <div class="td_page_heading_content text-center">
        <span class="td_fs_16 td_white_color td_accent_bg td_radius_5 d-inline-block td_medium" style="padding:6px 16px; margin-bottom:16px;">
          {{ $course['category'] }}
        </span>
        <h1 class="td_page_title td_white_color td_fs_48 td_mb_10">{{ $course['title'] }}</h1>
        <div class="td_page_heading_meta td_fs_16 td_white_color td_opacity_8">
          <span><i class="fa-solid fa-users"></i> {{ $course['seats'] }} Seats</span>
          <span class="td_seperator">|</span>
          <span><i class="fa-regular fa-calendar"></i> {{ $course['semesters'] }} Semesters</span>
          <span class="td_seperator">|</span>
          <span><i class="fa-solid fa-star td_accent_color"></i> {{ $course['rating'] }} ({{ $course['reviews'] }} Reviews)</span>
        </div>
      </div>
    </div>
  </div>

  <div class="td_page_heading_shape_1 td_accent_bg position-absolute">
    <img src="{{ asset('assets/img/others/page_heading_shape_3.svg') }}" alt="">
  </div>
  <div class="td_page_heading_shape_2 position-absolute">
    <img src="{{ asset('assets/img/others/page_heading_shape_4.svg') }}" alt="">
  </div>
  <div class="td_page_heading_shape_3 position-absolute">
    <img src="{{ asset('assets/img/others/page_heading_shape_5.svg') }}" alt="">
  </div>
</section>
