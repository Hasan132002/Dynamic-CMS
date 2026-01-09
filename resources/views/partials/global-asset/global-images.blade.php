@php
    if (!isset($global_images) || empty($global_images)) {
        $global_images = json_decode(
            file_get_contents(
                storage_path('app/content/global-json/global-images.json')
            ),
            true
        ) ?? [];
    }
@endphp


<style>
</style>
