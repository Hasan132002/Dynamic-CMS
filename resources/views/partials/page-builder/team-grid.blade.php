{{-- Team Grid Section --}}
@php
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? '';
    $members = $data['members'] ?? [];
@endphp

<div class="td_team td_style_1">
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

        @if(!empty($members))
            <div class="row">
                @foreach($members as $index => $member)
                    <div class="col-lg-3 col-md-6 td_mb_30">
                        <div class="td_team_card text-center wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
                            @if(!empty($member['image']))
                                <div class="td_team_thumb td_mb_20">
                                    <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] ?? '' }}"
                                         class="img-fluid rounded" style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                            @endif

                            @if(!empty($member['name']))
                                <h4 class="td_team_name td_fs_20 td_semibold td_mb_5">
                                    {{ $member['name'] }}
                                </h4>
                            @endif

                            @if(!empty($member['designation']))
                                <p class="td_team_designation td_fs_14 td_accent_color td_mb_10">
                                    {{ $member['designation'] }}
                                </p>
                            @endif

                            @if(!empty($member['bio']))
                                <p class="td_team_bio td_fs_14 text-muted td_mb_15">
                                    {{ Str::limit($member['bio'], 100) }}
                                </p>
                            @endif

                            @if(!empty($member['socials']))
                                <div class="td_team_socials">
                                    @foreach($member['socials'] as $social)
                                        <a href="{{ $social['url'] ?? '#' }}" target="_blank" class="td_social_link">
                                            <i class="{{ $social['icon'] ?? 'fab fa-globe' }}"></i>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .td_team_card {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .td_team_card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    .td_team_thumb img {
        border-radius: 50%;
        margin: 0 auto;
        display: block;
    }

    .td_team_socials {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .td_social_link {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f0f0f0;
        border-radius: 50%;
        color: #555;
        transition: all 0.3s ease;
    }

    .td_social_link:hover {
        background: var(--accent-color, #667eea);
        color: #fff;
    }
</style>
