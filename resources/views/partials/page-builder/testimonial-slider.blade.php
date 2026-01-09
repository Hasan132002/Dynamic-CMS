{{-- Testimonial Slider Section - Proper Template Styling --}}
@php
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? 'What Our Students Say';
    $sideImage = $data['side_image'] ?? '';
    $items = $data['items'] ?? [];
    $darkBg = $data['dark_bg'] ?? true;
@endphp

<section class="{{ $darkBg ? 'td_heading_bg td_hobble' : '' }}">
    <div class="td_height_112 td_height_lg_75"></div>

    <div class="container">
        <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
            @if($title)
                <h2 class="td_section_title td_fs_48 mb-0 {{ $darkBg ? 'td_white_color' : '' }}">
                    {!! $title !!}
                </h2>
            @endif
            @if($subtitle)
                <p class="td_section_subtitle td_fs_18 mb-0 {{ $darkBg ? 'td_white_color td_opacity_7' : '' }}">
                    {{ $subtitle }}
                </p>
            @endif
        </div>

        <div class="td_height_50 td_height_lg_50"></div>

        <div class="row align-items-center td_gap_y_40">
            @if($sideImage)
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                    <div class="td_testimonial_img_wrap">
                        <img src="{{ asset($sideImage) }}" alt="" class="td_testimonial_img w-100 td_radius_10">
                    </div>
                </div>
            @endif

            <div class="col-lg-{{ $sideImage ? '6' : '12' }} wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                @if(!empty($items))
                    <div class="td_slider td_style_1">
                        <div class="td_slider_container" data-autoplay="1" data-loop="1" data-speed="800" data-slides-per-view="1">
                            <div class="td_slider_wrapper">
                                @foreach($items as $item)
                                    <div class="td_slide">
                                        <div class="td_testimonial td_style_1 td_white_bg td_radius_5" style="padding: 30px;">
                                            <span class="td_quote_icon td_accent_color td_mb_20" style="display: block;">
                                                <svg width="50" height="36" viewBox="0 0 65 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2" d="M13.9286 26.6H1V1H26.8571V27.362L17.956 45H6.26764L14.8213 28.0505L15.5534 26.6H13.9286ZM51.0714 26.6H38.1429V1H64V27.362L55.0988 45H43.4105L51.9642 28.0505L52.6962 26.6H51.0714Z" fill="currentColor" stroke="currentColor" stroke-width="2"/>
                                                </svg>
                                            </span>

                                            <div class="td_testimonial_meta td_mb_24 d-flex align-items-center">
                                                @if(!empty($item['avatar']))
                                                    <img src="{{ asset($item['avatar']) }}" alt="{{ $item['name'] ?? '' }}"
                                                         style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 15px;">
                                                @endif
                                                <div class="td_testimonial_meta_right">
                                                    @if(!empty($item['name']))
                                                        <h3 class="td_fs_24 td_semibold td_mb_2">{{ $item['name'] }}</h3>
                                                    @endif
                                                    @if(!empty($item['designation']))
                                                        <p class="td_fs_14 mb-0 td_heading_color td_opacity_7">{{ $item['designation'] }}</p>
                                                    @endif
                                                </div>
                                            </div>

                                            @if(!empty($item['text']))
                                                <blockquote class="td_testimonial_text td_fs_20 td_medium td_heading_color td_mb_24 td_opacity_9" style="font-style: normal;">
                                                    {{ $item['text'] }}
                                                </blockquote>
                                            @endif

                                            @if(!empty($item['rating']))
                                                <div class="td_rating" data-rating="{{ $item['rating'] }}">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $item['rating'])
                                                            <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                                                        @else
                                                            <i class="fa-regular fa-star" style="color: #ffc107;"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Slider Navigation --}}
                        <div class="td_slider_nav td_mt_30">
                            <button class="td_slider_prev td_center">
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none">
                                    <path d="M0.469669 5.46967C0.176777 5.76256 0.176777 6.23744 0.469669 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.469669 5.46967ZM18 5.25L1 5.25V6.75L18 6.75V5.25Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <button class="td_slider_next td_center">
                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none">
                                    <path d="M17.5303 6.53033C17.8232 6.23744 17.8232 5.76256 17.5303 5.46967L12.7574 0.696699C12.4645 0.403806 11.9896 0.403806 11.6967 0.696699C11.4038 0.989593 11.4038 1.46447 11.6967 1.75736L15.9393 6L11.6967 10.2426C11.4038 10.5355 11.4038 11.0104 11.6967 11.3033C11.9896 11.5962 12.4645 11.5962 12.7574 11.3033L17.5303 6.53033ZM0 6.75H17V5.25H0V6.75Z" fill="currentColor"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="td_height_120 td_height_lg_80"></div>
</section>

<style>
.td_slider_nav {
    display: flex;
    gap: 10px;
    justify-content: center;
}
.td_slider_prev,
.td_slider_next {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 1px solid var(--border-color, #ddd);
    background: var(--white-color, #fff);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.td_slider_prev:hover,
.td_slider_next:hover {
    background: var(--accent-color);
    border-color: var(--accent-color);
    color: var(--white-color, #fff);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize testimonial slider
    const sliderContainers = document.querySelectorAll('.td_slider_container');
    sliderContainers.forEach(function(container) {
        const wrapper = container.querySelector('.td_slider_wrapper');
        const slides = wrapper.querySelectorAll('.td_slide');
        const parent = container.closest('.td_slider');
        const prevBtn = parent?.querySelector('.td_slider_prev');
        const nextBtn = parent?.querySelector('.td_slider_next');

        if (slides.length <= 1) return;

        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? 'block' : 'none';
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        // Initial display
        showSlide(0);

        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        // Auto-play
        const autoplay = container.dataset.autoplay === '1';
        if (autoplay) {
            setInterval(nextSlide, 5000);
        }
    });
});
</script>
