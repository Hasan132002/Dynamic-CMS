{{-- Spacer Section --}}
@php
    $height = $data['height'] ?? '60';
    $heightMobile = $data['height_mobile'] ?? '30';
    $uniqueId = 'spacer_' . uniqid();
@endphp

<div class="td_spacer" id="{{ $uniqueId }}"></div>

<style>
    #{{ $uniqueId }} {
        height: {{ $height }}px;
    }

    @media (max-width: 768px) {
        #{{ $uniqueId }} {
            height: {{ $heightMobile }}px;
        }
    }
</style>
