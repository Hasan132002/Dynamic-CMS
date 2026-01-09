@php($newsletter = isset($newsletter['data']) && is_array($newsletter['data']) ? $newsletter['data'] : $newsletter)

<section>
  <div class="td_newsletter td_style_1 td_type_1 td_center">

    <div class="container wow fadeInUp"
         data-wow-duration="1s"
         data-wow-delay="0.2s">

      <h2 class="td_fs_36 td_mb_20 text-center td_semibold">
        {!! $newsletter['title'] !!}
      </h2>

      <form action="{{ $newsletter['form']['action'] }}"
            class="td_newsletter_form">

        <input type="email"
               class="td_newsletter_input"
               placeholder="{{ $newsletter['form']['placeholder'] }}">

        <button type="submit"
                class="td_btn td_style_1 td_radius_30 td_medium">
          <span class="td_btn_in td_white_color td_accent_bg">
            <span>{{ $newsletter['form']['button'] }}</span>
          </span>
        </button>

      </form>
    </div>

    <div class="td_newsletter_img_1 position-absolute wow fadeInLeft"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <img src="{{ asset($newsletter['images'][0]) }}" alt="">
    </div>

    <div class="td_newsletter_img_2 position-absolute wow fadeInRight"
         data-wow-duration="1s"
         data-wow-delay="0.2s">
      <img src="{{ asset($newsletter['images'][1]) }}" alt="">
    </div>

  </div>
</section>
