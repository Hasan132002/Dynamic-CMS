{{-- Blog V1 Section (Home V1 Style) --}}
@php
    $subtitle = $data['subtitle'] ?? '';
    $title = $data['title'] ?? '';
    $posts = $data['posts'] ?? [];
@endphp

<section>
    <div class="td_height_112 td_height_lg_75"></div>
    <div class="container">
        @if($subtitle || $title)
            <div class="td_section_heading td_style_1 text-center wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                @if($subtitle)
                    <p class="td_section_subtitle_up td_fs_18 td_semibold td_spacing_1 td_mb_10 text-uppercase td_accent_color">
                        {{ $subtitle }}
                    </p>
                @endif
                @if($title)
                    <h2 class="td_section_title td_fs_48 mb-0">
                        {!! $title !!}
                    </h2>
                @endif
            </div>
        @endif

        <div class="td_height_50 td_height_lg_50"></div>

        @if(!empty($posts))
            <div class="row td_gap_y_30">
                @foreach($posts as $index => $post)
                    @php
                        $postImage = $post['image'] ?? '';
                        $postUrl = $post['url'] ?? '#';
                        $postMeta = $post['meta'] ?? [];
                        $postTitle = $post['title'] ?? '';
                        $postExcerpt = $post['excerpt'] ?? '';
                        $postButton = $post['button'] ?? 'Read More';
                    @endphp
                    <div class="col-lg-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.{{ $index + 2 }}s">
                        <div class="td_post td_style_1">
                            <a href="{{ $postUrl }}" class="td_post_thumb d-block">
                                @if($postImage)
                                    <img src="{{ asset($postImage) }}" alt="{{ $postTitle }}">
                                @endif
                                <i class="fa-solid fa-link"></i>
                            </a>

                            <div class="td_post_info">
                                @if(!empty($postMeta))
                                    <div class="td_post_meta td_fs_14 td_medium td_mb_20">
                                        @if($postMeta['date'] ?? false)
                                            <span>
                                                @if($postMeta['date_icon'] ?? false)
                                                    <img src="{{ asset($postMeta['date_icon']) }}" alt="">
                                                @else
                                                    <i class="fas fa-calendar-alt"></i>
                                                @endif
                                                {{ $postMeta['date'] }}
                                            </span>
                                        @endif
                                        @if($postMeta['author'] ?? false)
                                            <span>
                                                @if($postMeta['author_icon'] ?? false)
                                                    <img src="{{ asset($postMeta['author_icon']) }}" alt="">
                                                @else
                                                    <i class="fas fa-user"></i>
                                                @endif
                                                {{ $postMeta['author'] }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                @if($postTitle)
                                    <h2 class="td_post_title td_fs_24 td_medium td_mb_16">
                                        <a href="{{ $postUrl }}">{{ $postTitle }}</a>
                                    </h2>
                                @endif

                                @if($postExcerpt)
                                    <p class="td_post_subtitle td_mb_24 td_heading_color td_opacity_7">
                                        {{ $postExcerpt }}
                                    </p>
                                @endif

                                <a href="{{ $postUrl }}" class="td_btn td_style_1 td_type_3 td_radius_30 td_medium">
                                    <span class="td_btn_in td_accent_color">
                                        <span>{{ $postButton }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">No blog posts added yet.</p>
            </div>
        @endif
    </div>
    <div class="td_height_120 td_height_lg_80"></div>
</section>
