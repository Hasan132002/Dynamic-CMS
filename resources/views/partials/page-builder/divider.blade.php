{{-- Divider Section --}}
@php
    $style = $data['style'] ?? 'solid';
    $color = $data['color'] ?? '#e0e0e0';
    $width = $data['width'] ?? '100';
    $thickness = $data['thickness'] ?? '1';
@endphp

<div class="td_divider" style="padding: 20px 0;">
    <div class="container">
        <hr style="
            border: none;
            border-top: {{ $thickness }}px {{ $style }} {{ $color }};
            width: {{ $width }}%;
            margin: 0 auto;
        ">
    </div>
</div>
