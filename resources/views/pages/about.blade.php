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
    <title>About</title>
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
  <body>

     @include('partials.headers.header-v3')

    <!-- Start Preloader -->
    <div class="td_preloader">
      <div class="td_preloader_in">
        <span></span>
        <span></span>
      </div>
    </div>
    <!-- End Preloader -->

{{-- Check section visibility before rendering --}}
@sectionVisible($hero ?? [])
    @include('partials.about-section.hero')
@endif

@sectionVisible($about ?? [])
    @include('partials.about-section.about')
@endif

@sectionVisible($campus ?? [])
    @include('partials.about-section.campus')
@endif

@sectionVisible($department ?? [])
    @include('partials.about-section.department')
@endif

@sectionVisible($video ?? [])
    @include('partials.about-section.video')
@endif

@sectionVisible($blog ?? [])
    @include('partials.about-section.blog')
@endif
@include('partials.footers.footer-v1')



    <!-- Start Scroll Up Button -->
    <div class="td_scrollup">
      <i class="fa-solid fa-arrow-up"></i>
    </div>
    <!-- End Scroll Up Button -->
    <!-- Script -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/jquery.slick.min.js"></script>
    <script src="assets/js/odometer.js"></script>
    <script src="assets/js/gsap.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
