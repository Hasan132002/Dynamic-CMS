{{-- FAQ Accordion Section - Proper Template Styling --}}
@php
    $subtitle = $data['subtitle'] ?? 'FAQ';
    $title = $data['title'] ?? 'Frequently Asked Questions';
    $image = $data['image'] ?? '';
    $items = $data['items'] ?? [];
@endphp

<div class="td_height_112 td_height_lg_75"></div>

<div class="container">
    <div class="row align-items-center td_gap_y_40">
        {{-- FAQ Content --}}
        <div class="col-xl-{{ $image ? '6' : '12' }} wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
            <div class="td_section_heading td_style_1">
                @if($subtitle)
                    <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
                        {{ $subtitle }}
                    </p>
                @endif
                @if($title)
                    <h2 class="td_section_title td_fs_48 mb-0">{!! $title !!}</h2>
                @endif
            </div>

            <div class="td_height_50 td_height_lg_50"></div>

            @if(!empty($items))
                <div class="td_accordians td_style_1 td_type_1">
                    @foreach($items as $index => $item)
                        <div class="td_accordian {{ $index === 0 ? 'active' : '' }}">
                            <div class="td_accordian_head">
                                <h2 class="td_accordian_title td_fs_20 td_medium">
                                    {{ $item['question'] ?? '' }}
                                </h2>
                                <span class="td_accordian_toggle">
                                    <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.41 0.589966L6 5.16997L10.59 0.589966L12 1.99997L6 7.99997L0 1.99997L1.41 0.589966Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="td_accordian_body" style="{{ $index === 0 ? '' : 'display: none;' }}">
                                <p>{!! nl2br(e($item['answer'] ?? '')) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @if($image)
            {{-- FAQ Image --}}
            <div class="col-xl-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.4s">
                <div class="td_faq_image">
                    <img src="{{ asset($image) }}" alt="FAQ" class="w-100 td_radius_10">
                </div>
            </div>
        @endif
    </div>
</div>

<div class="td_height_112 td_height_lg_75"></div>

<style>
.td_accordians.td_style_1.td_type_1 .td_accordian {
    border: 1px solid var(--border-color, #e0e0e0);
    border-radius: 10px;
    margin-bottom: 15px;
    overflow: hidden;
    background: var(--white-color, #fff);
}
.td_accordians.td_style_1.td_type_1 .td_accordian_head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.td_accordians.td_style_1.td_type_1 .td_accordian.active .td_accordian_head {
    background: var(--accent-color);
    color: var(--white-color, #fff);
}
.td_accordians.td_style_1.td_type_1 .td_accordian_title {
    margin: 0;
    transition: color 0.3s ease;
}
.td_accordians.td_style_1.td_type_1 .td_accordian.active .td_accordian_title {
    color: var(--white-color, #fff);
}
.td_accordians.td_style_1.td_type_1 .td_accordian_toggle {
    transition: transform 0.3s ease;
}
.td_accordians.td_style_1.td_type_1 .td_accordian.active .td_accordian_toggle {
    transform: rotate(180deg);
    color: var(--white-color, #fff);
}
.td_accordians.td_style_1.td_type_1 .td_accordian_body {
    padding: 0 25px 20px;
    line-height: 1.8;
}
.td_accordians.td_style_1.td_type_1 .td_accordian_body p {
    margin: 0;
    padding-top: 15px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.td_accordians.td_style_1 .td_accordian_head').forEach(function(head) {
        head.addEventListener('click', function() {
            const accordian = this.parentElement;
            const body = accordian.querySelector('.td_accordian_body');
            const parent = accordian.parentElement;

            // Close all other accordions in the same group
            parent.querySelectorAll('.td_accordian').forEach(function(item) {
                if (item !== accordian) {
                    item.classList.remove('active');
                    item.querySelector('.td_accordian_body').style.display = 'none';
                }
            });

            // Toggle current accordion
            if (accordian.classList.contains('active')) {
                accordian.classList.remove('active');
                body.style.display = 'none';
            } else {
                accordian.classList.add('active');
                body.style.display = 'block';
            }
        });
    });
});
</script>
