@php($video = isset($video['data']) && is_array($video['data']) ? $video['data'] : $video)

<section>
  <div class="td_video_block td_style_1 td_accent_bg td_bg_filed td_center text-center"
       data-src="{{ asset($video['background']) }}">
    <div class="container">

      <a href="{{ $video['video_url'] }}"
         class="td_player_btn_wrap_2 td_video_open wow zoomIn"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
        <span class="td_player_btn td_center">
          <span></span>
        </span>
      </a>

      <div class="td_height_70 td_height_lg_50"></div>

      <h2 class="td_fs_48 td_white_color mb-0 wow fadeInUp"
          data-wow-duration="1s"
          data-wow-delay="0.2s">
        {!! $video['heading'] !!}
      </h2>

    </div>
  </div>

  <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
    <div class="td_contact_box td_style_1 td_accent_bg td_radius_10">

      <div class="td_contact_box_left">
        <p class="td_fs_18 td_light td_white_color td_mb_4">
          {{ $video['contact']['left']['label'] }}
        </p>
        <h3 class="td_fs_36 mb-0 td_white_color">
          <a href="{{ $video['contact']['left']['link'] }}">
            {{ $video['contact']['left']['text'] }}
          </a>
        </h3>
      </div>

      <div class="td_contact_box_or td_fs_24 td_medium td_white_bg td_white_bg td_center rounded-circle td_accent_color">
        {{ $video['contact']['middle_text'] }}
      </div>

      <div class="td_contact_box_right">
        <p class="td_fs_18 td_light td_white_color td_mb_4">
          {{ $video['contact']['right']['label'] }}
        </p>
        <h3 class="td_fs_36 mb-0 td_white_color">
          <a href="{{ $video['contact']['right']['link'] }}">
            {{ $video['contact']['right']['text'] }}
          </a>
        </h3>
      </div>

    </div>
  </div>
</section>
