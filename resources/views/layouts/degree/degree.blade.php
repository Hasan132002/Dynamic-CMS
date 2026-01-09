<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeDox">

    <!-- Site Title -->
    <title>@yield('title','Online Education Platform')</title>

    <!-- Favicon Icon -->
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
    {{-- THEME CSS --}}
    @if(isset($theme['css']) && file_exists(public_path('assets/css/themes/' . $theme['css'])))
        <link rel="stylesheet" href="{{ asset('assets/css/themes/' . $theme['css']) }}">
    @endif
  </head>
  <body class="theme-{{ $theme['slug'] ?? 'default' }}">

    {{-- DYNAMIC HEADER --}}
    @php
        $headerVersion = $theme['header_version'] ?? 'header-v3';
        $headerPartial = 'partials.headers.' . $headerVersion;
    @endphp
    @include($headerPartial)

    <!-- Start Preloader -->
    <div class="td_preloader">
      <div class="td_preloader_in">
        <span></span>
        <span></span>
      </div>
    </div>
    <!-- End Preloader -->

    @yield('content')

    {{-- DYNAMIC FOOTER --}}
    @php
        $footerVersion = $theme['footer_version'] ?? 'footer-v1';
        $footerPartial = 'partials.footers.' . $footerVersion;
    @endphp
    @include($footerPartial)

    <!-- Start Scroll Up Button -->
    <div class="td_scrollup">
      <i class="fa-solid fa-arrow-up"></i>
    </div>
    <!-- End Scroll Up Button -->

    <!-- Script -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/odometer.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>
