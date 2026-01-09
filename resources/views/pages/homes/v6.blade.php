<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
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

  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
  <title>{{ $fullTitle }}</title>

  {{-- SEO META TAGS --}}
  @include('partials.global-asset.global-seo')

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
      $headerVersion = $theme['header_version'] ?? 'header-v6';
      $headerPartial = 'partials.headers.' . $headerVersion;
  @endphp
  @include($headerPartial)

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

  {{-- DYNAMIC FOOTER --}}
  @php
      $footerVersion = $theme['footer_version'] ?? 'footer-v6';
      $footerPartial = 'partials.footers.' . $footerVersion;
  @endphp
  @include($footerPartial)

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
