<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeDox">

  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
  <title>Online Education Platform</title>

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

<body class="td_theme_2">

  {{-- HEADER --}}
  @include('partials.headers.header-v6')

  {{-- PRELOADER --}}
  <div class="td_preloader">
    <div class="td_preloader_in"><span></span><span></span></div>
  </div>

  {{-- HOME V6 SECTIONS --}}
  @sectionVisible($hero ?? [])
    @include('partials.sections.home-v6.hero')
@endif
  @sectionVisible($categories ?? [])
    @include('partials.sections.home-v6.categories')
@endif
  @sectionVisible($about ?? [])
    @include('partials.sections.home-v6.about')
@endif
  @sectionVisible($courses ?? [])
    @include('partials.sections.home-v6.courses')
@endif
  @sectionVisible($team ?? [])
    @include('partials.sections.home-v6.team')
@endif
  @sectionVisible($faq ?? [])
    @include('partials.sections.home-v6.faqs')
@endif
  @sectionVisible($choose ?? [])
    @include('partials.sections.home-v6.choose-us')
@endif
  @sectionVisible($contact ?? [])
    @include('partials.sections.home-v6.contact')
@endif
  @sectionVisible($blog ?? [])
    @include('partials.sections.home-v6.blog')
@endif
  @sectionVisible($newsletter ?? [])
    @include('partials.sections.home-v6.newsletter')
@endif

  {{-- FOOTER --}}
  @include('partials.footers.footer-v6')

  <div class="td_scrollup">
    <i class="fa-solid fa-arrow-up"></i>
  </div>

  <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.slick.min.js') }}"></cript>
  <script src="{{ asset('assets/js/odometer.js') }}"></script>
  <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
