{{-- GLOBAL SEO META TAGS --}}
@php
    $seoGlobal = $seo['global'] ?? [];
    $seoRobots = $seo['robots'] ?? [];
    $seoVerification = $seo['verification'] ?? [];
    $seoAnalytics = $seo['analytics'] ?? [];

    // Page-specific or global meta
    $pageTitle = $page_title ?? ($page_meta['title'] ?? 'Home');
    $titleSuffix = $seoGlobal['title_suffix'] ?? '';
    $fullTitle = $titleSuffix ? "{$pageTitle} {$titleSuffix}" : $pageTitle;

    $metaDescription = $page_meta['description'] ?? ($seoGlobal['meta_description'] ?? '');
    $metaKeywords = $page_meta['keywords'] ?? ($seoGlobal['meta_keywords'] ?? '');
    $ogImage = $page_meta['og_image'] ?? ($seoGlobal['og_image'] ?? '');

    // Robots
    $robotsIndex = ($seoRobots['index'] ?? true) ? 'index' : 'noindex';
    $robotsFollow = ($seoRobots['follow'] ?? true) ? 'follow' : 'nofollow';
@endphp

{{-- Basic Meta Tags --}}
@if($metaDescription)
<meta name="description" content="{{ $metaDescription }}">
@endif

@if($metaKeywords)
<meta name="keywords" content="{{ $metaKeywords }}">
@endif

{{-- Robots --}}
<meta name="robots" content="{{ $robotsIndex }}, {{ $robotsFollow }}">

{{-- Open Graph Tags --}}
<meta property="og:title" content="{{ $fullTitle }}">
@if($metaDescription)
<meta property="og:description" content="{{ $metaDescription }}">
@endif
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
@if($ogImage)
<meta property="og:image" content="{{ $ogImage }}">
@endif

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $fullTitle }}">
@if($metaDescription)
<meta name="twitter:description" content="{{ $metaDescription }}">
@endif
@if($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}">
@endif

{{-- Site Verification --}}
@if(!empty($seoVerification['google']))
<meta name="google-site-verification" content="{{ $seoVerification['google'] }}">
@endif

@if(!empty($seoVerification['bing']))
<meta name="msvalidate.01" content="{{ $seoVerification['bing'] }}">
@endif

{{-- Google Analytics --}}
@if(!empty($seoAnalytics['google_analytics']))
@php
    $gaId = $seoAnalytics['google_analytics'];
    $isGA4 = str_starts_with($gaId, 'G-');
@endphp
@if($isGA4)
<!-- Google Analytics 4 -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $gaId }}');
</script>
@else
<!-- Universal Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ $gaId }}');
</script>
@endif
@endif

{{-- Facebook Pixel --}}
@if(!empty($seoAnalytics['facebook_pixel']))
<!-- Facebook Pixel -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{{ $seoAnalytics['facebook_pixel'] }}');
    fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ $seoAnalytics['facebook_pixel'] }}&ev=PageView&noscript=1"/>
</noscript>
@endif
