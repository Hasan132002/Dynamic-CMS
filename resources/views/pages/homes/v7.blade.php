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
  @include('partials.headers.header-v7')

  {{-- PRELOADER --}}
  <div class="td_preloader">
    <div class="td_preloader_in">
      <span></span>
      <span></span>
    </div>
  </div>

  {{-- HOME V7 SECTIONS --}}

  @sectionVisible($hero ?? [])
    @include('partials.sections.home-v7.hero')
@endif
  @sectionVisible($about ?? [])
    @include('partials.sections.home-v7.about')
@endif
  @sectionVisible($features ?? [])
    @include('partials.sections.home-v7.feature')
@endif
  @sectionVisible($courses ?? [])
    @include('partials.sections.home-v7.courses')
@endif
  @sectionVisible($why ?? [])
    @include('partials.sections.home-v7.choose-us')
@endif
  @sectionVisible($instructor ?? [])
    @include('partials.sections.home-v7.Instructor')
@endif
  @sectionVisible($accordion ?? [])
    @include('partials.sections.home-v7.accordion')
@endif
  @sectionVisible($brands ?? [])
    @include('partials.sections.home-v7.brands')
@endif
  @sectionVisible($testimonial ?? [])
    @include('partials.sections.home-v7.testimonial')
@endif
  @sectionVisible($blog ?? [])
    @include('partials.sections.home-v7.blog')
@endif

  {{-- FOOTER --}}
  @include('partials.footers.footer-v7')

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
