@php
    $fontsData = $fonts ?? [];
    $default = $fontsData['default'] ?? [];
    $themes = $fontsData['themes'] ?? [];
    $fallback = $fontsData['fallback'] ?? 'sans-serif';
    $weights = $fontsData['weights'] ?? [];
    $sizes = $fontsData['sizes'] ?? [];
    $lineHeights = $fontsData['line_heights'] ?? [];
@endphp

<style>
    :root {
        /* Font Families */
        --body-font: "{{ $default['primary'] ?? 'inherit' }}", {{ $fallback }};
        --heading-font: "{{ $default['secondary'] ?? 'inherit' }}", {{ $fallback }};

        /* Font Weights */
        --font-normal: {{ $weights['normal'] ?? 400 }};
        --font-medium: {{ $weights['medium'] ?? 500 }};
        --font-semibold: {{ $weights['semibold'] ?? 600 }};
        --font-bold: {{ $weights['bold'] ?? 700 }};

        /* Font Sizes */
        --text-xs: {{ $sizes['xs'] ?? '12px' }};
        --text-sm: {{ $sizes['sm'] ?? '13px' }};
        --text-base: {{ $sizes['base'] ?? '14px' }};
        --text-md: {{ $sizes['md'] ?? '15px' }};
        --text-lg: {{ $sizes['lg'] ?? '16px' }};
        --text-xl: {{ $sizes['xl'] ?? '18px' }};
        --text-2xl: {{ $sizes['2xl'] ?? '20px' }};
        --text-3xl: {{ $sizes['3xl'] ?? '24px' }};
        --text-4xl: {{ $sizes['4xl'] ?? '28px' }};
        --text-5xl: {{ $sizes['5xl'] ?? '32px' }};
        --text-6xl: {{ $sizes['6xl'] ?? '36px' }};
        --text-7xl: {{ $sizes['7xl'] ?? '40px' }};
        --text-8xl: {{ $sizes['8xl'] ?? '48px' }};
        --text-9xl: {{ $sizes['9xl'] ?? '64px' }};
        --text-display: {{ $sizes['display'] ?? '120px' }};

        /* Line Heights */
        --leading-tight: {{ $lineHeights['tight'] ?? 1 }};
        --leading-snug: {{ $lineHeights['snug'] ?? 1.2 }};
        --leading-normal: {{ $lineHeights['normal'] ?? 1.3 }};
        --leading-relaxed: {{ $lineHeights['relaxed'] ?? 1.4 }};
        --leading-loose: {{ $lineHeights['loose'] ?? 1.5 }};
        --leading-prose: {{ $lineHeights['prose'] ?? 1.7 }};
        --leading-spacious: {{ $lineHeights['spacious'] ?? 1.8 }};
        --leading-extra: {{ $lineHeights['extra'] ?? 1.9 }};
    }

    @foreach($themes as $themeClass => $themeFonts)
        html.{{ $themeClass }} {
            @isset($themeFonts['primary'])
                --body-font: "{{ $themeFonts['primary'] }}", {{ $fallback }};
            @endisset

            @isset($themeFonts['secondary'])
                --heading-font: "{{ $themeFonts['secondary'] }}", {{ $fallback }};
            @endisset
        }
    @endforeach
</style>
