<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="EduCVE">

    @php
        $seoGlobal = $seo['global'] ?? [];
        $pageTitle = $page_title ?? ($page['title'] ?? 'Page');
        $titleSuffix = $seoGlobal['title_suffix'] ?? '';
        $fullTitle = $titleSuffix ? "{$pageTitle} | {$titleSuffix}" : $pageTitle;
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

    <style>
        /* Custom Page Builder Styles */
        .pb-section {
            position: relative;
        }

        .pb-section[data-bg-color] {
            background-color: var(--section-bg-color);
        }

        .pb-section[data-text-color] {
            color: var(--section-text-color);
        }
    </style>
</head>

<body class="td_theme_2 theme-{{ $theme['slug'] ?? 'default' }}">

    {{-- DYNAMIC HEADER based on theme --}}
    @php
        $headerVersion = $theme['header_version'] ?? 'header-v1';
        $headerPartial = 'partials.headers.' . $headerVersion;
    @endphp
    @includeIf($headerPartial)

    {{-- PRELOADER --}}
    <div class="td_preloader">
        <div class="td_preloader_in">
            <span></span>
            <span></span>
        </div>
    </div>

    {{-- PAGE CONTENT --}}
    <main class="custom-page-content">
        @if(count($sections) > 0)
            @foreach($sections as $section)
                @if($section['visible'] ?? true)
                    @php
                        $sectionType = $section['type'] ?? 'unknown';
                        $sectionData = $section['data'] ?? [];
                        $sectionStyles = $section['styles'] ?? [];

                        // Build inline styles
                        $inlineStyles = [];
                        if (!empty($sectionStyles['background_color'])) {
                            $inlineStyles[] = '--section-bg-color: ' . $sectionStyles['background_color'];
                            $inlineStyles[] = 'background-color: ' . $sectionStyles['background_color'];
                        }
                        if (!empty($sectionStyles['text_color'])) {
                            $inlineStyles[] = '--section-text-color: ' . $sectionStyles['text_color'];
                            $inlineStyles[] = 'color: ' . $sectionStyles['text_color'];
                        }
                        if (!empty($sectionStyles['padding_top'])) {
                            $inlineStyles[] = 'padding-top: ' . $sectionStyles['padding_top'] . 'px';
                        }
                        if (!empty($sectionStyles['padding_bottom'])) {
                            $inlineStyles[] = 'padding-bottom: ' . $sectionStyles['padding_bottom'] . 'px';
                        }

                        $styleAttr = !empty($inlineStyles) ? 'style="' . implode('; ', $inlineStyles) . '"' : '';
                    @endphp

                    <section class="pb-section pb-{{ $sectionType }}" {!! $styleAttr !!} data-section-id="{{ $section['id'] }}">
                        @includeIf('partials.page-builder.' . $sectionType, ['data' => $sectionData, 'styles' => $sectionStyles])
                    </section>
                @endif
            @endforeach
        @else
            <div class="container py-5">
                <div class="text-center">
                    <h2>{{ $page['title'] ?? 'Page' }}</h2>
                    <p class="text-muted">This page has no content sections yet.</p>
                </div>
            </div>
        @endif
    </main>

    {{-- DYNAMIC FOOTER based on theme --}}
    @php
        $footerVersion = $theme['footer_version'] ?? 'footer-v1';
        $footerPartial = 'partials.footers.' . $footerVersion;
    @endphp
    @includeIf($footerPartial)

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
