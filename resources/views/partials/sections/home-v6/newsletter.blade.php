@php($newsletter = isset($newsletter['data']) && is_array($newsletter['data']) ? $newsletter['data'] : $newsletter)

<section>
  <div class="td_newsletter td_style_1 td_type_2 position-relative td_hobble">

    <div class="td_height_116 td_height_lg_75"></div>

    <div class="container wow fadeInUp"
         data-wow-duration="1.1s"
         data-wow-delay="0.2s">

      <p class="text-center td_fs_20 td_white_color td_mb_10 td_opacity_7">
        {{ $newsletter['subtitle'] }}
      </p>

      <h2 class="td_fs_36 td_mb_40 text-center td_white_color">
        {!! $newsletter['title'] !!}
      </h2>

      <form action="{{ $newsletter['form']['action'] }}"
            class="td_newsletter_form">

        <input type="email"
               class="td_newsletter_input"
               placeholder="{{ $newsletter['form']['placeholder'] }}">

        <button type="submit"
                class="td_btn td_style_1 td_fs_20 td_semibold">
          <span class="td_btn_in td_white_color td_heading_bg">
            <span>{{ $newsletter['form']['button'] }}</span>
          </span>
        </button>

      </form>

    </div>

    <div class="td_newsletter_shape_1 position-absolute td_hover_layer_3"></div>
    <div class="td_newsletter_shape_2 position-absolute td_hover_layer_5"></div>
    <div class="td_newsletter_shape_3 position-absolute td_hover_layer_3"></div>

    <div class="td_newsletter_shape_4 position-absolute td_hover_layer_5">
      @include('svg.home-v6.newsletter.shape-4')
    </div>

    <div class="td_height_116 td_height_lg_75"></div>

  </div>
</section>
