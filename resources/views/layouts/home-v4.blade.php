<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @php
      $seoGlobal = $seo['global'] ?? [];
      $pageTitle = $page_title ?? ($page_meta['title'] ?? 'Home');
      $titleSuffix = $seoGlobal['title_suffix'] ?? '';
      $fullTitle = $titleSuffix ? "{$pageTitle} {$titleSuffix}" : $pageTitle;
  @endphp
  <title>{{ $fullTitle }}</title>

  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

  {{-- SEO META TAGS --}}
  @include('partials.global-asset.global-seo')

   {{-- GLOBAL STYLES (fonts, colors, etc.) --}}
    @include('partials.global-style')

    {{-- THEME CSS (if exists) --}}
    @if(isset($theme['css']) && file_exists(public_path('assets/css/themes/' . $theme['css'])))
        <link rel="stylesheet" href="{{ asset('assets/css/themes/' . $theme['css']) }}">
    @endif

</head>

<body class="td_theme_2 theme-{{ $theme['slug'] ?? 'default' }}">

  {{-- Dynamic Header based on theme --}}
  @php
      $headerVersion = $theme['header_version'] ?? 'header-v4';
      $headerPartial = 'partials.headers.' . $headerVersion;
  @endphp
  @include($headerPartial)

  @yield('content')

  {{-- Dynamic Footer based on theme --}}
  @php
      $footerVersion = $theme['footer_version'] ?? 'footer-v4';
      $footerPartial = 'partials.footers.' . $footerVersion;
  @endphp
  @include($footerPartial)


</body>
</html>
