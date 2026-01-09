{{-- Contact Form Section - Proper Template Styling --}}
@php
    $subtitle = $data['subtitle'] ?? 'Contact Us';
    $title = $data['title'] ?? 'Get In Touch';
    $description = $data['description'] ?? '';
    $email = $data['email'] ?? '';
    $phone = $data['phone'] ?? '';
    $address = $data['address'] ?? '';
    $formAction = $data['form_action'] ?? '#';
    $showMap = $data['show_map'] ?? false;
    $mapEmbed = $data['map_embed'] ?? '';
@endphp

<div class="td_height_112 td_height_lg_75"></div>

<div class="container">
    <div class="row td_gap_y_40">
        {{-- Contact Info Side --}}
        <div class="col-lg-5 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
            <div class="td_section_heading td_style_1 td_mb_30">
                @if($subtitle)
                    <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
                        {{ $subtitle }}
                    </p>
                @endif
                @if($title)
                    <h2 class="td_section_title td_fs_48 td_mb_15">{!! $title !!}</h2>
                @endif
                @if($description)
                    <p class="td_section_subtitle td_mb_0">{{ $description }}</p>
                @endif
            </div>

            <div class="td_iconbox_wrapper">
                @if($phone)
                    <div class="td_iconbox td_style_3 td_mb_30">
                        <div class="td_iconbox_icon td_center td_accent_bg td_white_color td_radius_5" style="width: 60px; height: 60px; flex-shrink: 0;">
                            <i class="fa-solid fa-phone td_fs_24"></i>
                        </div>
                        <div class="td_iconbox_right">
                            <h3 class="td_fs_14 td_semibold td_mb_5 td_heading_color td_opacity_7">Phone</h3>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" class="td_fs_20 td_medium td_heading_color">{{ $phone }}</a>
                        </div>
                    </div>
                @endif

                @if($email)
                    <div class="td_iconbox td_style_3 td_mb_30">
                        <div class="td_iconbox_icon td_center td_accent_bg td_white_color td_radius_5" style="width: 60px; height: 60px; flex-shrink: 0;">
                            <i class="fa-solid fa-envelope td_fs_24"></i>
                        </div>
                        <div class="td_iconbox_right">
                            <h3 class="td_fs_14 td_semibold td_mb_5 td_heading_color td_opacity_7">Email</h3>
                            <a href="mailto:{{ $email }}" class="td_fs_20 td_medium td_heading_color">{{ $email }}</a>
                        </div>
                    </div>
                @endif

                @if($address)
                    <div class="td_iconbox td_style_3">
                        <div class="td_iconbox_icon td_center td_accent_bg td_white_color td_radius_5" style="width: 60px; height: 60px; flex-shrink: 0;">
                            <i class="fa-solid fa-location-dot td_fs_24"></i>
                        </div>
                        <div class="td_iconbox_right">
                            <h3 class="td_fs_14 td_semibold td_mb_5 td_heading_color td_opacity_7">Address</h3>
                            <p class="td_fs_20 td_medium td_heading_color mb-0">{!! nl2br(e($address)) !!}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Contact Form Side --}}
        <div class="col-lg-7 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
            <div class="td_contact_form_box td_gray_bg_5 td_radius_10" style="padding: 40px;">
                <form action="{{ $formAction }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="td_form_field_wrap td_mb_25">
                                <label class="td_fs_14 td_semibold td_mb_10 td_heading_color">Full Name *</label>
                                <input type="text" name="name" class="td_form_field td_radius_5" placeholder="Your name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="td_form_field_wrap td_mb_25">
                                <label class="td_fs_14 td_semibold td_mb_10 td_heading_color">Email *</label>
                                <input type="email" name="email" class="td_form_field td_radius_5" placeholder="Your email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="td_form_field_wrap td_mb_25">
                                <label class="td_fs_14 td_semibold td_mb_10 td_heading_color">Phone</label>
                                <input type="tel" name="phone" class="td_form_field td_radius_5" placeholder="Your phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="td_form_field_wrap td_mb_25">
                                <label class="td_fs_14 td_semibold td_mb_10 td_heading_color">Subject</label>
                                <input type="text" name="subject" class="td_form_field td_radius_5" placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="td_form_field_wrap td_mb_25">
                                <label class="td_fs_14 td_semibold td_mb_10 td_heading_color">Message *</label>
                                <textarea name="message" class="td_form_field td_radius_5" rows="5" placeholder="Your message" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="td_btn td_style_1 td_radius_10 td_medium">
                                <span class="td_btn_in td_white_color td_accent_bg">
                                    <span>Send Message</span>
                                    <svg width="19" height="12" viewBox="0 0 19 12" fill="none">
                                        <path d="M18.5303 6.53033C18.8232 6.23744 18.8232 5.76256 18.5303 5.46967L13.7574 0.696699C13.4645 0.403806 12.9896 0.403806 12.6967 0.696699C12.4038 0.989593 12.4038 1.46447 12.6967 1.75736L16.9393 6L12.6967 10.2426C12.4038 10.5355 12.4038 11.0104 12.6967 11.3033C12.9896 11.5962 13.4645 11.5962 13.7574 11.3033L18.5303 6.53033ZM0 6.75H18V5.25H0V6.75Z" fill="currentColor"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if($showMap && $mapEmbed)
    <div class="td_height_80 td_height_lg_60"></div>
    <div class="td_map">
        {!! $mapEmbed !!}
    </div>
@else
    <div class="td_height_112 td_height_lg_75"></div>
@endif

<style>
.td_iconbox.td_style_3 {
    display: flex;
    align-items: flex-start;
    gap: 20px;
}
.td_form_field {
    width: 100%;
    padding: 14px 20px;
    border: 1px solid var(--border-color, #e0e0e0);
    background: var(--white-color, #fff);
    font-size: 15px;
    transition: all 0.3s ease;
}
.td_form_field:focus {
    border-color: var(--accent-color);
    outline: none;
}
textarea.td_form_field {
    resize: vertical;
    min-height: 130px;
}
</style>
