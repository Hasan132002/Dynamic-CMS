{{-- Text Block Section --}}
@php
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
@endphp

<div class="td_text_block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if($title)
                    <h2 class="td_section_title td_fs_48 td_mb_30 text-center">
                        {!! $title !!}
                    </h2>
                @endif

                @if($content)
                    <div class="td_text_content">
                        {!! $content !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
