@php($brands = isset($brands['data']) && is_array($brands['data']) ? $brands['data'] : $brands)

<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
    <div class="td_slider td_style_1 td_slider_gap_24">
      <div class="td_slider_container"
           data-autoplay="0"
           data-loop="1"
           data-speed="800"
           data-center="0"
           data-variable-width="0"
           data-slides-per-view="responsive"
           data-xs-slides="2"
           data-sm-slides="3"
           data-md-slides="4"
           data-lg-slides="5"
           data-add-slides="6">
        <div class="td_slider_wrapper">

          @foreach($brands['items'] as $item)
            <div class="td_slide">
              <div class="td_brand td_style_1">
                <img src="{{ asset($item['image']) }}" alt="">
              </div>
            </div>
          @endforeach

        </div>
      </div>

      <!-- <div class="td_height_50 td_height_lg_40"></div>
      <div class="td_pagination td_style_1"></div> -->
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
