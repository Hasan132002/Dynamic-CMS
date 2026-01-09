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

    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
    <!-- Site Title -->
    <title>{{ $fullTitle }}</title>

    {{-- SEO META TAGS --}}
    @include('partials.global-asset.global-seo')

    @include('partials.global-style')

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
     {{-- GLOBAL STYLES (fonts, colors, etc.) --}}

    {{-- THEME CSS --}}
    @if(isset($theme['css']) && file_exists(public_path('assets/css/themes/' . $theme['css'])))
        <link rel="stylesheet" href="{{ asset('assets/css/themes/' . $theme['css']) }}">
    @endif
  </head>
  <body class="td_theme_2 theme-{{ $theme['slug'] ?? 'default' }}">
    {{-- DYNAMIC HEADER --}}
    @php
        $headerVersion = $theme['header_version'] ?? 'header-v1';
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

{{-- Check section visibility before rendering --}}
@sectionVisible($hero ?? [])
    @include('partials.sections.home-v1.hero')
@endif

@sectionVisible($about ?? [])
    @include('partials.sections.home-v1.about')
@endif

@sectionVisible($courses ?? [])
    @include('partials.sections.home-v1.courses')
@endif

@sectionVisible($features ?? [])
    @include('partials.sections.home-v1.features')
@endif

@sectionVisible($campus ?? [])
    @include('partials.sections.home-v1.campus')
@endif

@sectionVisible($department ?? [])
    @include('partials.sections.home-v1.department')
@endif

@sectionVisible($video ?? [])
    @include('partials.sections.home-v1.video')
@endif

@sectionVisible($event ?? [])
    @include('partials.sections.home-v1.event')
@endif

@sectionVisible($testimonial ?? [])
    @include('partials.sections.home-v1.testimonial')
@endif

@sectionVisible($blog ?? [])
    @include('partials.sections.home-v1.blog')
@endif


{{-- DYNAMIC FOOTER --}}
@php
    $footerVersion = $theme['footer_version'] ?? 'footer-v1';
    $footerPartial = 'partials.footers.' . $footerVersion;
@endphp
@include($footerPartial)

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
