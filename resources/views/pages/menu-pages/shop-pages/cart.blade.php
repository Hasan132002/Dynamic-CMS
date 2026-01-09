<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Cart</title>

  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/odometer.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
   {{-- GLOBAL STYLES (fonts, colors, etc.) --}}
    @include('partials.global-style')
</head>

<body>

{{-- DYNAMIC HEADER --}}
@php
    $headerVersion = $theme['header_version'] ?? 'header-v3';
    $headerPartial = 'partials.headers.' . $headerVersion;
@endphp
@include($headerPartial)

{{-- PRELOADER --}}
<div class="td_preloader">
  <div class="td_preloader_in">
    <span></span>
    <span></span>
  </div>
</div>

{{-- SECTIONS --}}
@include('partials.pages.shop-pages.cart.hero')
@include('partials.pages.shop-pages.cart.cart-sec')


{{-- DYNAMIC FOOTER --}}
@php
    $footerVersion = $theme['footer_version'] ?? 'footer-v1';
    $footerPartial = 'partials.footers.' . $footerVersion;
@endphp
@include($footerPartial)

<div class="td_scrollup">
  <i class="fa-solid fa-arrow-up"></i>
</div>

<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slick.min.js') }}"></script>
<script src="{{ asset('assets/js/odometer.js') }}"></script>
<script src="{{ asset('assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
