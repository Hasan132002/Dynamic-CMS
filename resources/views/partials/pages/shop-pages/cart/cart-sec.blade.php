<section>
  <div class="td_height_120 td_height_lg_80"></div>

  <div class="container">
    <div class="td_table_1">
      <div class="table-responsive">
        <table>
          <thead>
            <tr class="td_accent_bg">
              @foreach($cart['table_headers'] as $header)
                <th class="td_white_color td_bold">{{ $header }}</th>
              @endforeach
            </tr>
          </thead>

          <tbody>
            @foreach($cart['items'] as $item)
              <tr>
                <td>
                  <div class="td_table_meta">
                    <img src="{{ asset($item['image']) }}" alt="">
                    <span class="td_fs_18 td_semibold td_heading_color">{{ $item['title'] }}</span>
                  </div>
                </td>
                <td>{{ $item['unit_price'] }}</td>
                <td>
                  <div class="td_quantity">
                    <button class="td_quantity_btn" type="button">
                      <i class="fa-solid fa-minus"></i>
                    </button>
                    <span class="td_quantity_number">{{ $item['quantity'] }}</span>
                    <button class="td_quantity_btn" type="button">
                      <i class="fa-solid fa-plus"></i>
                    </button>
                  </div>
                </td>
                <td>{{ $item['subtotal'] }}</td>
                <td>
                  <button class="td_table_close_btn">
                    <i class="fa-solid fa-xmark"></i>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>

    <div class="td_height_60 td_height_lg_40"></div>

    <div class="row td_gap_y_30 td_row_gap_30">
      <div class="col-xl-4 td_gap_y_50">

        <form action="#" class="td_cupon td_mb_50">
          <input type="text" placeholder="{{ $cart['coupon']['placeholder'] }}" class="td_cupon_input">
          <button type="submit" class="td_cupon_btn">{{ $cart['coupon']['button'] }}</button>
        </form>

        <h3 class="td_fs_16">{{ $cart['shipping_form']['title'] }}</h3>

        <form action="#">
          @foreach($cart['shipping_form']['fields'] as $field)
            <input type="text" class="td_form_field_2 {{ $field['class'] }}" placeholder="{{ $field['placeholder'] }}">
          @endforeach

          <button class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $cart['shipping_form']['button'] }}</span>
            </span>
          </button>
        </form>

      </div>

      <div class="col-xl-4">
        <div class="td_total_card">
          <h3 class="td_fs_16 td_mb_2">{{ $cart['totals']['title'] }}</h3>

          <div class="td_mb_14">
            <ul class="td_total_card_list td_mp_0 td_heading_color">
              <li>
                <span>{{ $cart['totals']['subtotal_label'] }}</span>
                <span class="td_bold">{{ $cart['totals']['subtotal'] }}</span>
              </li>

              <li>
                <span>{{ $cart['totals']['shipping_label'] }}</span>
                <div>
                  @foreach($cart['totals']['shipping_options'] as $option)
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="shipping" {{ $option['checked'] ? 'checked' : '' }}>
                      <label class="form-check-label">
                        {!! $option['label'] !!}
                      </label>
                    </div>
                  @endforeach

                  <div class="td_fs_18">
                    {{ $cart['totals']['shipping_to_label'] }}
                    <span class="td_bold">{{ $cart['totals']['shipping_to'] }}</span>
                  </div>
                </div>
              </li>

              <li>
                <span>{{ $cart['totals']['total_label'] }}</span>
                <span class="td_bold td_fs_20">{{ $cart['totals']['total'] }}</span>
              </li>
            </ul>
          </div>

          <button class="td_btn td_style_1 td_radius_10 td_medium w-100">
            <span class="td_btn_in td_white_color td_accent_bg">
              <span>{{ $cart['totals']['checkout_button'] }}</span>
            </span>
          </button>

        </div>
      </div>

      <div class="col-xl-4">
        <div class="td_btns_group">

          <a href="{{ $cart['buttons']['continue']['link'] }}" class="td_btn td_style_1 td_type_3 td_radius_10 td_medium">
            <span class="td_btn_in td_accent_color">
              <span>{{ $cart['buttons']['continue']['text'] }}</span>
              @include('svg.pages.cart.arrow-right')
            </span>
          </a>

          <button class="td_btn td_style_1 td_radius_10 td_medium">
            <span class="td_btn_in td_white_color td_accent_bg">
              @include('svg.pages.cart.update-cart')
              <span>{{ $cart['buttons']['update'] }}</span>
            </span>
          </button>

        </div>
      </div>
    </div>
  </div>

  <div class="td_height_120 td_height_lg_80"></div>
</section>
