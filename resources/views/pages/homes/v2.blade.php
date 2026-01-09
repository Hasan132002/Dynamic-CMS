<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeDox">
    <!-- Favicon Icon -->
    <link rel="icon" href="assets/img/favicon.png">
    <!-- Site Title -->
    <title> Online Education Platform</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
     {{-- GLOBAL STYLES (fonts, colors, etc.) --}}
    @include('partials.global-style')
  </head>
  <body class="td_theme_2">
        @include('partials.headers.header-v2')

    <!-- Start Preloader -->
    <div class="td_preloader">
      <div class="td_preloader_in">
        <span></span>
        <span></span>
      </div>
    </div>
    <!-- End Preloader -->
    <!-- Start Header Section -->

{{-- Check section visibility before rendering --}}
@sectionVisible($hero ?? [])
    @include('partials.sections.home-v2.hero')
@endif

@sectionVisible($categories ?? [])
    @include('partials.sections.home-v2.categories')
@endif

@sectionVisible($rate ?? [])
    @include('partials.sections.home-v2.rate')
@endif

@sectionVisible($about ?? [])
    @include('partials.sections.home-v2.about')
@endif

@sectionVisible($courses ?? [])
    @include('partials.sections.home-v2.courses')
@endif

@sectionVisible($cta_brands ?? [])
    @include('partials.sections.home-v2.white-space')
    @include('partials.sections.home-v2.brand')
@endif

@sectionVisible($testimonial ?? [])
    @include('partials.sections.home-v2.testimonial')
@endif

@sectionVisible($event_schedule ?? [])
    @include('partials.sections.home-v2.event-schedule')
@endif

@sectionVisible($team ?? [])
    @include('partials.sections.home-v2.team')
@endif

@sectionVisible($why_choose_us ?? [])
    @include('partials.sections.home-v2.why-choose-us')
@endif

@sectionVisible($blog ?? [])
    @include('partials.sections.home-v2.blog')
@endif
    @include('partials.footers.footer-v2')

    <div class="td_scrollup">
      <i class="fa-solid fa-arrow-up"></i>
    </div>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.slick.min.js"></script>
    <script src="assets/js/odometer.js"></script>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
