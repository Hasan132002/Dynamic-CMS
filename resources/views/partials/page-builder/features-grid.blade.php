{{-- Features Grid Section --}}
@php
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];
@endphp

<div class="td_features">
    <div class="container">
        @if($subtitle || $title)
            <div class="td_section_heading td_style_1 text-center td_mb_40">
                @if($subtitle)
                    <p class="td_section_subtitle td_fs_18 td_semibold td_spacing_1 td_mb_10 td_accent_color text-uppercase">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($title)
                    <h2 class="td_section_title td_fs_48 td_mb_15">
                        {!! $title !!}
                    </h2>
                @endif
            </div>
        @endif

        @if(!empty($items))
            <div class="row">
                @foreach($items as $index => $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="td_feature_box td_style_1 wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
                            <div class="td_feature_icon td_center">
                                <i class="{{ $item['icon'] ?? 'fas fa-star' }} td_accent_color" style="font-size: 36px;"></i>
                            </div>
                            <h3 class="td_feature_title td_fs_24 td_semibold td_mb_10">
                                {{ $item['title'] ?? '' }}
                            </h3>
                            <p class="td_feature_text td_mb_0">
                                {{ $item['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
