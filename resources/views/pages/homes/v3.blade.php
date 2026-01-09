<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="ThemeDox">

  @php
      $seoGlobal = $seo['global'] ?? [];
      $pageTitle = $page_title ?? ($page_meta['title'] ?? 'Home');
      $titleSuffix = $seoGlobal['title_suffix'] ?? '';
      $fullTitle = $titleSuffix ? "{$pageTitle} {$titleSuffix}" : $pageTitle;
  @endphp

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

  <!-- Site Title -->
  <title>{{ $fullTitle }}</title>

  {{-- SEO META TAGS --}}
  @include('partials.global-asset.global-seo')

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

    {{-- THEME CSS --}}
    @if(isset($theme['css']) && file_exists(public_path('assets/css/themes/' . $theme['css'])))
        <link rel="stylesheet" href="{{ asset('assets/css/themes/' . $theme['css']) }}">
    @endif
</head>

<body class="td_theme_2 theme-{{ $theme['slug'] ?? 'default' }}">

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

  {{-- DYNAMIC FOOTER --}}
  @php
      $footerVersion = $theme['footer_version'] ?? 'footer-v3';
      $footerPartial = 'partials.footers.' . $footerVersion;
  @endphp
  @include($footerPartial)

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
