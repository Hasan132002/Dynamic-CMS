{{-- GLOBAL COLORS (CMS driven) --}}
<style>
html:root {
  /* Base Colors */
  --white-color: {{ $colors['base']['white'] ?? '#ffffff' }};
  --black-color: {{ $colors['base']['black'] ?? '#000000' }};
  --heading-color: {{ $colors['base']['heading'] ?? '#00001b' }};
  --body-color: {{ $colors['base']['body'] ?? '#555555' }};
  --accent-color: {{ $colors['base']['accent'] ?? '#890c25' }};
  --gray-color: {{ $colors['base']['gray'] ?? '#f4f3ef' }};
  --gray-light-color: {{ $colors['base']['gray_light'] ?? '#f8f9fa' }};
  --gray-bg-color: {{ $colors['base']['gray_bg'] ?? '#f8f9fc' }};
  --gray-hover-color: {{ $colors['base']['gray_hover'] ?? '#e0e0e0' }};
  --gray-row-hover: {{ $colors['base']['gray_row_hover'] ?? '#fafafa' }};
  --gray-table-header: {{ $colors['base']['gray_table_header'] ?? '#f9f9f9' }};
  --border-color: {{ $colors['base']['border'] ?? '#d9d9d9' }};
  --border-light-color: {{ $colors['base']['border_light'] ?? '#dfdfdf' }};
  --border-medium-color: {{ $colors['base']['border_medium'] ?? '#d0d0d0' }};
  --border-soft-color: {{ $colors['base']['border_soft'] ?? '#e5e5e5' }};
  --border-section-color: {{ $colors['base']['border_section'] ?? '#e8eaef' }};
  --border-card-color: {{ $colors['base']['border_card'] ?? '#e0e4ea' }};
  --border-row-color: {{ $colors['base']['border_row'] ?? '#f0f0f0' }};
  --border-row-light: {{ $colors['base']['border_row_light'] ?? '#eee' }};

  /* Component Colors */
  --card-bg: {{ $colors['components']['card_bg'] ?? '#ffffff' }};
  --card-border: {{ $colors['components']['card_border'] ?? '#dfdfdf' }};
  --section-bg-light: {{ $colors['components']['section_bg_light'] ?? '#f8f9fa' }};
  --overlay-dark: {{ $colors['components']['overlay_dark'] ?? 'rgba(0,0,0,0.5)' }};
  --overlay-light: {{ $colors['components']['overlay_light'] ?? 'rgba(255,255,255,0.1)' }};
  --overlay-white-soft: {{ $colors['components']['overlay_white_soft'] ?? 'rgba(255,255,255,0.2)' }};
  --shadow-light: {{ $colors['components']['shadow_light'] ?? 'rgba(0,0,0,0.04)' }};
  --shadow-medium: {{ $colors['components']['shadow_medium'] ?? 'rgba(0,0,0,0.1)' }};
  --shadow-heavy: {{ $colors['components']['shadow_heavy'] ?? 'rgba(0,0,0,0.15)' }};
  --hover-shadow: {{ $colors['components']['hover_shadow'] ?? '0 5px 15px rgba(0,0,0,0.08)' }};
  --hover-shadow-lg: {{ $colors['components']['hover_shadow_lg'] ?? '0 10px 30px rgba(0,0,0,0.1)' }};
  --shadow-card: {{ $colors['components']['shadow_card'] ?? '0 4px 24px rgba(0,0,0,0.06)' }};
  --shadow-card-lg: {{ $colors['components']['shadow_card_lg'] ?? '0 6px 28px rgba(0,0,0,0.08)' }};
  --section-bg-gradient: {{ $colors['components']['section_bg_gradient'] ?? 'linear-gradient(180deg, #fafbfc 0%, #f5f6f8 100%)' }};
  --section-bg-gradient-alt: {{ $colors['components']['section_bg_gradient_alt'] ?? 'linear-gradient(180deg, #f8f9fb 0%, #f1f3f6 100%)' }};
  --sidebar-inactive-bg: {{ $colors['components']['sidebar_inactive_bg'] ?? '#f5f5f5' }};

  /* Text Opacity */
  --text-opacity-5: {{ $colors['text']['opacity_5'] ?? '0.5' }};
  --text-opacity-6: {{ $colors['text']['opacity_6'] ?? '0.6' }};
  --text-opacity-7: {{ $colors['text']['opacity_7'] ?? '0.7' }};
  --text-opacity-75: {{ $colors['text']['opacity_75'] ?? '0.75' }};
  --text-opacity-8: {{ $colors['text']['opacity_8'] ?? '0.8' }};
  --text-opacity-85: {{ $colors['text']['opacity_85'] ?? '0.85' }};
  --text-opacity-9: {{ $colors['text']['opacity_9'] ?? '0.9' }};
  --text-opacity-95: {{ $colors['text']['opacity_95'] ?? '0.95' }};

  /* Spacing */
  --section-py: {{ $colors['spacing']['section_py'] ?? '100px' }};
  --section-py-lg: {{ $colors['spacing']['section_py_lg'] ?? '70px' }};
  --card-padding: {{ $colors['spacing']['card_padding'] ?? '30px' }};
  --card-padding-sm: {{ $colors['spacing']['card_padding_sm'] ?? '25px' }};
  --gap-sm: {{ $colors['spacing']['gap_sm'] ?? '12px' }};
  --gap-md: {{ $colors['spacing']['gap_md'] ?? '15px' }};
  --gap-lg: {{ $colors['spacing']['gap_lg'] ?? '30px' }};

  /* Border Radius */
  --radius-sm: {{ $colors['border_radius']['sm'] ?? '4px' }};
  --radius-md: {{ $colors['border_radius']['md'] ?? '8px' }};
  --radius-lg: {{ $colors['border_radius']['lg'] ?? '10px' }};
  --radius-xl: {{ $colors['border_radius']['xl'] ?? '12px' }};
  --radius-2xl: {{ $colors['border_radius']['2xl'] ?? '16px' }};
  --radius-full: {{ $colors['border_radius']['full'] ?? '50%' }};

  /* Transitions */
  --transition-default: {{ $colors['transitions']['default'] ?? 'all 0.3s ease' }};
  --transition-fast: {{ $colors['transitions']['fast'] ?? 'all 0.2s ease' }};
  --transition-slow: {{ $colors['transitions']['slow'] ?? 'all 0.4s ease' }};

  /* Hover Effects */
  --hover-translate-y: {{ $colors['hover']['translate_y'] ?? 'translateY(-3px)' }};
  --hover-translate-y-lg: {{ $colors['hover']['translate_y_lg'] ?? 'translateY(-5px)' }};
  --hover-scale: {{ $colors['hover']['scale'] ?? 'scale(1.05)' }};
  --hover-scale-sm: {{ $colors['hover']['scale_sm'] ?? 'scale(1.1)' }};
}

@foreach(($colors['themes'] ?? []) as $themeClass => $theme)
html.{{ $themeClass }} {
  @isset($theme['accent'])
    --accent-color: {{ $theme['accent'] }};
  @endisset
}
@endforeach
</style>
