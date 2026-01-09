<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="row td_row_reverse_lg td_gap_y_40">
      <div class="col-xl-7 col-lg-8">

        <h3 class="td_mb_20 td_fs_24 td_semibold">{{ $checkoutForm['contact']['title'] }}</h3>
        <p class="td_fs_14 td_mb_20">{{ $checkoutForm['contact']['description'] }}</p>
        <input type="text" class="td_form_field_2 td_mb_27" placeholder="{{ $checkoutForm['contact']['email_placeholder'] }}">

        <h3 class="td_fs_18 td_mb_12">{{ $checkoutForm['billing']['title'] }}</h3>
        <p class="td_fs_14 td_mb_20">{{ $checkoutForm['billing']['description'] }}</p>

        <div class="row td_mb_10 td_row_gap_16">
          @foreach($checkoutForm['billing']['fields'] as $field)
            <div class="{{ $field['col'] }}">
              <input type="text" class="td_form_field_2 td_mb_16" placeholder="{{ $field['placeholder'] }}">
            </div>
          @endforeach
        </div>

        <h3 class="td_fs_18 td_mb_14">{{ $checkoutForm['payment']['title'] }}</h3>

        <div class="td_mb_40">
          <ul class="td_payment_list td_mp_0">
            @foreach($checkoutForm['payment']['methods'] as $method)
              <li>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="payment" {{ $method['checked'] ? 'checked' : '' }}>
                  <label class="form-check-label">{{ $method['label'] }}</label>
                </div>
                @if(!empty($method['description']))
                  <p class="mb-0">{{ $method['description'] }}</p>
                @endif
              </li>
            @endforeach
          </ul>
        </div>

        <div class="td_custom_checkbox_2 td_mb_20 td_heading_color">
          <input type="checkbox">
          <span>{{ $checkoutForm['order_note'] }}</span>
        </div>

        <p class="td_heading_color td_opacity_8 td_mb_20">
          {{ $checkoutForm['agreement'] }}
        </p>

        <hr class="td_mb_25">

        <div class="row align-items-center td_row_reverse_lg td_gap_y_20">
          <div class="col-lg-6 text-center-lg">
            <a href="{{ $checkoutForm['return']['link'] }}" class="td_text_btn_2 td_heading_color">
              @include('svg.pages.checkout.back-arrow')
              {{ $checkoutForm['return']['text'] }}
            </a>
          </div>

          <div class="col-lg-6">
            <button class="td_btn td_style_1 td_radius_30 td_medium w-100">
              <span class="td_btn_in td_white_color td_accent_bg">
                <span>{{ $checkoutForm['place_order'] }}</span>
              </span>
            </button>
          </div>
        </div>

      </div>

      <div class="col-lg-4 offset-xl-1">
        <div class="td_order_summary_card">
          <p class="mb-0">{{ $checkoutSummary['title'] }}</p>

          <div class="td_order_summary_card_info td_fs_14">
            <div class="td_order_summary_card_thumb">
              <img src="{{ asset($checkoutSummary['item']['image']) }}" alt="">
              <span>{{ $checkoutSummary['item']['qty'] }}</span>
            </div>
            <div>
              <p class="td_mb_5">{!! $checkoutSummary['item']['title_price'] !!}</p>
              <p class="mb-0">{{ $checkoutSummary['item']['description'] }}</p>
            </div>
          </div>

          <ul class="td_order_summary_card_list td_mp_0">
            <li class="td_heading_color">{{ $checkoutSummary['coupon'] }}</li>
            <li>
              <span>{{ $checkoutSummary['subtotal_label'] }}</span>
              <span class="td_bold">{{ $checkoutSummary['subtotal'] }}</span>
            </li>
            <li class="td_fs_18 td_bold td_heading_color">
              <span>{{ $checkoutSummary['total_label'] }}</span>
              <span>{{ $checkoutSummary['total'] }}</span>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
