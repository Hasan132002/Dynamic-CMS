<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Online Education')</title>

  <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

   {{-- GLOBAL STYLES (fonts, colors, etc.) --}}
    @include('partials.global-style')

</head>

<body class="td_theme_2">

  @include('partials.headers.header-v7')

  @yield('content')

  @include('partials.footers.footer-v7')


</body>
</html>
