<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeDox">

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

  <!-- Site Title -->
  <title>Online Education Platform</title>

  <!-- CSS -->
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
  @include('partials.headers.header-v3')

  {{-- PRELOADER --}}
  <div class="td_preloader">
    <div class="td_preloader_in">
      <span></span>
      <span></span>
    </div>
  </div>

  {{-- HOME V3 SECTIONS - with visibility checks --}}

  @sectionVisible($hero ?? [])
    @include('partials.sections.home-v3.hero')
  @endif

  @sectionVisible($rate ?? [])
    @include('partials.sections.home-v3.rate')
  @endif

  @sectionVisible($about ?? [])
    @include('partials.sections.home-v3.about')
  @endif

  @sectionVisible($category ?? [])
    @include('partials.sections.home-v3.category')
  @endif

  @sectionVisible($courses ?? [])
    @include('partials.sections.home-v3.courses')
  @endif

  @sectionVisible($certificate ?? [])
    @include('partials.sections.home-v3.certificate')
  @endif

  @sectionVisible($testimonial ?? [])
    @include('partials.sections.home-v3.testimonial')
  @endif

  @sectionVisible($feature ?? [])
    @include('partials.sections.home-v3.feature')
  @endif

  @sectionVisible($funfact ?? [])
    @include('partials.sections.home-v3.funfact')
  @endif

  @sectionVisible($pricing ?? [])
    @include('partials.sections.home-v3.pricing')
  @endif

  @sectionVisible($expert_instructor ?? [])
    @include('partials.sections.home-v3.expert-instructor')
  @endif

  @sectionVisible($instructor ?? [])
    @include('partials.sections.home-v3.Instructor')
  @endif

  @sectionVisible($app ?? [])
    @include('partials.sections.home-v3.app')
  @endif

  @sectionVisible($blog ?? [])
    @include('partials.sections.home-v3.blog')
  @endif

  {{-- FOOTER --}}
  @include('partials.footers.footer-v3')

  {{-- SCROLL TO TOP --}}
  <div class="td_scrollup">
    <i class="fa-solid fa-arrow-up"></i>
  </div>

  {{-- JS --}}
  <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery.slick.min.js') }}"></script>
  <script src="{{ asset('assets/js/odometer.js') }}"></script>
  <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/js/wow.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
