@php
    if (!isset($logos) || empty($logos)) {
        $logos = json_decode(
            file_get_contents(
                storage_path('app/content/global-json/global-logos.json')
            ),
            true
        ) ?? [];
    }
@endphp


<style>
  /* HEADER LOGO */
/* .td_site_branding {
  display: flex;
  align-items: center;
}

.td_site_branding img {
  max-width: 180px;     
  max-height: 60px;     
  width: 160px;
  height: auto;
  object-fit: contain;
}
.td_footer_logo {
  display: flex;
  align-items: center;
}

.td_footer_logo img , .td_footer_text_widget img {
  max-width: 200px;
  max-height: 80px;
  width: 200px !important;
  height: auto;
  object-fit: contain;
} */
</style>
