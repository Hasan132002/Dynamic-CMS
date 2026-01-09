# Theme Development Guide

## Table of Contents

1. [Overview](#overview)
2. [Theme Package Structure](#theme-package-structure)
3. [Required Files](#required-files)
4. [Section Development](#section-development)
5. [Field Types Reference](#field-types-reference)
6. [CSS Variables](#css-variables)
7. [Sample Pages](#sample-pages)
8. [Best Practices](#best-practices)
9. [Validation Checklist](#validation-checklist)

---

## Overview

This guide explains how to create themes compatible with our Page Builder CMS system. Themes are packaged as ZIP files containing blade templates, assets, and configuration files.

### System Architecture

- **Laravel 10** with **PHP 8.2+**
- **Bootstrap 5** for base styling
- **Blade Templates** for sections
- **JSON Configuration** for section definitions
- **File-based Storage** for custom pages

---

## Theme Package Structure

```
theme-name/
├── theme.json                 # REQUIRED - Theme metadata
├── preview.jpg                # REQUIRED - 1200x800 preview image
├── assets/
│   ├── css/
│   │   └── theme.css         # Theme-specific styles
│   ├── js/
│   │   └── theme.js          # Theme-specific scripts
│   └── images/               # Theme images (hero backgrounds, icons, etc.)
├── sections/                  # REQUIRED - Blade partial files
│   ├── hero.blade.php
│   ├── about.blade.php
│   ├── services.blade.php
│   ├── portfolio.blade.php
│   ├── testimonials.blade.php
│   ├── team.blade.php
│   ├── pricing.blade.php
│   ├── faq.blade.php
│   ├── contact.blade.php
│   └── cta.blade.php
├── layouts/                   # Optional - Full page layouts
│   └── home.blade.php
├── sample-data/              # Demo content for import
│   ├── pages/
│   │   ├── home.json
│   │   ├── about.json
│   │   └── contact.json
│   └── settings.json
└── config/
    ├── sections.json         # REQUIRED - Section field definitions
    └── colors.json           # Optional - Color presets
```

---

## Required Files

### 1. theme.json (Mandatory)

The main configuration file that identifies your theme.

```json
{
    "name": "Starter Theme",
    "slug": "starter-starter",
    "version": "1.0.0",
    "author": "Developer Name",
    "author_url": "https://developer-site.com",
    "description": "A modern starter theme for ecommerce and startup sites",
    "category": "Business",
    "tags": ["ecommerce", "startup", "modern", "responsive"],
    "preview": "preview.jpg",
    "compatible_version": "1.0.0",
    "requires_php": "8.1",
    "sections": [
        "hero",
        "about",
        "services",
        "portfolio",
        "testimonials",
        "team",
        "pricing",
        "faq",
        "contact",
        "cta"
    ],
    "color_presets": {
        "primary": "#1a73e8",
        "secondary": "#34a853",
        "accent": "#fbbc05",
        "dark": "#1a1a1a",
        "light": "#f8f9fa"
    },
    "font_presets": {
        "heading": "Poppins",
        "body": "Open Sans"
    }
}
```

#### Field Descriptions:

| Field | Required | Description |
|-------|----------|-------------|
| `name` | Yes | Display name of theme |
| `slug` | Yes | URL-safe identifier (lowercase, hyphens only) |
| `version` | Yes | Semantic version (1.0.0) |
| `author` | Yes | Developer/company name |
| `description` | No | Brief theme description |
| `category` | No | Theme category (Business, Education, Portfolio, etc.) |
| `tags` | No | Searchable tags array |
| `sections` | No | List of included section types |
| `color_presets` | No | Default color scheme |

### 2. preview.jpg (Mandatory)

- **Dimensions**: 1200 x 800 pixels (3:2 aspect ratio)
- **Format**: JPG or PNG
- **File size**: Under 500KB recommended
- **Content**: Full screenshot of theme homepage

### 3. config/sections.json (Mandatory)

Defines the editable fields for each section.

```json
{
    "hero": {
        "name": "Hero Banner",
        "description": "Main hero section with call-to-action",
        "partial": "hero",
        "preview": "assets/images/previews/hero.jpg",
        "category": "Hero",
        "fields": [
            {
                "name": "title",
                "label": "Main Title",
                "type": "richtext",
                "default": "Welcome to <span>Our Company</span>",
                "help": "HTML tags like <span> and <br> are allowed"
            },
            {
                "name": "subtitle",
                "label": "Subtitle",
                "type": "text",
                "default": "We help businesses grow"
            },
            {
                "name": "background",
                "label": "Background Image",
                "type": "image",
                "default": "assets/images/hero-bg.jpg"
            },
            {
                "name": "overlay_opacity",
                "label": "Overlay Opacity",
                "type": "number",
                "default": 50,
                "min": 0,
                "max": 100
            },
            {
                "name": "buttons",
                "label": "Call-to-Action Buttons",
                "type": "repeater",
                "max": 2,
                "fields": [
                    {
                        "name": "text",
                        "label": "Button Text",
                        "type": "text"
                    },
                    {
                        "name": "link",
                        "label": "Button Link",
                        "type": "text"
                    },
                    {
                        "name": "style",
                        "label": "Button Style",
                        "type": "select",
                        "options": {
                            "primary": "Primary",
                            "secondary": "Secondary",
                            "outline": "Outline"
                        }
                    }
                ]
            }
        ],
        "styles": {
            "supports": ["background_color", "text_color", "padding"]
        }
    },
    "about": {
        "name": "About Section",
        "description": "Company information with image",
        "partial": "about",
        "fields": [
            {
                "name": "subtitle",
                "label": "Subtitle",
                "type": "text",
                "default": "About Us"
            },
            {
                "name": "title",
                "label": "Title",
                "type": "richtext",
                "default": "Who We Are"
            },
            {
                "name": "description",
                "label": "Description",
                "type": "textarea",
                "default": "Add your company description here..."
            },
            {
                "name": "image",
                "label": "Image",
                "type": "image"
            },
            {
                "name": "features",
                "label": "Features",
                "type": "repeater",
                "fields": [
                    {"name": "icon", "label": "Icon Class", "type": "text"},
                    {"name": "title", "label": "Title", "type": "text"},
                    {"name": "text", "label": "Description", "type": "text"}
                ]
            },
            {
                "name": "button",
                "label": "Button",
                "type": "button"
            }
        ]
    }
}
```

---

## Section Development

### Basic Section Template

```blade
{{-- sections/hero.blade.php --}}
@php
    // Extract data with defaults
    $title = $data['title'] ?? 'Welcome';
    $subtitle = $data['subtitle'] ?? '';
    $background = $data['background'] ?? '';
    $overlayOpacity = $data['overlay_opacity'] ?? 50;
    $buttons = $data['buttons'] ?? [];

    // Get styles
    $bgColor = $styles['background_color'] ?? '';
    $textColor = $styles['text_color'] ?? '';
    $paddingTop = $styles['padding_top'] ?? '100';
    $paddingBottom = $styles['padding_bottom'] ?? '100';
@endphp

<section class="hero-section"
    style="
        @if($background) background-image: url('{{ asset($background) }}'); @endif
        @if($bgColor) background-color: {{ $bgColor }}; @endif
        @if($textColor) color: {{ $textColor }}; @endif
        padding-top: {{ $paddingTop }}px;
        padding-bottom: {{ $paddingBottom }}px;
    ">

    @if($background)
        <div class="hero-overlay" style="opacity: {{ $overlayOpacity / 100 }}"></div>
    @endif

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                @if($subtitle)
                    <p class="hero-subtitle wow fadeInUp" data-wow-delay="0.1s">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($title)
                    <h1 class="hero-title wow fadeInUp" data-wow-delay="0.2s">
                        {!! $title !!}
                    </h1>
                @endif

                @if(!empty($buttons))
                    <div class="hero-buttons wow fadeInUp" data-wow-delay="0.3s">
                        @foreach($buttons as $button)
                            <a href="{{ $button['link'] ?? '#' }}"
                               class="btn btn-{{ $button['style'] ?? 'primary' }} btn-lg">
                                {{ $button['text'] ?? 'Learn More' }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    position: relative;
    min-height: 600px;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #000;
}

.hero-title {
    font-size: 56px;
    font-weight: 700;
    margin-bottom: 20px;
    color: inherit;
}

.hero-title span {
    color: var(--accent-color, #667eea);
}

.hero-subtitle {
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 15px;
    opacity: 0.9;
}

.hero-buttons {
    margin-top: 30px;
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 36px;
    }

    .hero-section {
        min-height: 500px;
    }
}
</style>
```

### Section with Repeater Fields

```blade
{{-- sections/services.blade.php --}}
@php
    $subtitle = $data['subtitle'] ?? 'Our Services';
    $title = $data['title'] ?? 'What We Do';
    $items = $data['items'] ?? [];
@endphp

<section class="services-section">
    <div class="container">
        <div class="section-heading text-center wow fadeInUp">
            @if($subtitle)
                <span class="section-subtitle">{{ $subtitle }}</span>
            @endif
            @if($title)
                <h2 class="section-title">{!! $title !!}</h2>
            @endif
        </div>

        @if(!empty($items))
            <div class="row mt-5">
                @foreach($items as $index => $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="service-card wow fadeInUp"
                             data-wow-delay="{{ 0.1 + ($index * 0.1) }}s">
                            @if(!empty($item['icon']))
                                <div class="service-icon">
                                    <i class="{{ $item['icon'] }}"></i>
                                </div>
                            @endif

                            @if(!empty($item['title']))
                                <h3 class="service-title">{{ $item['title'] }}</h3>
                            @endif

                            @if(!empty($item['description']))
                                <p class="service-description">{{ $item['description'] }}</p>
                            @endif

                            @if(!empty($item['link']))
                                <a href="{{ $item['link'] }}" class="service-link">
                                    Learn More <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p class="text-muted">No services added yet. Edit this section to add services.</p>
            </div>
        @endif
    </div>
</section>
```

---

## Field Types Reference

| Type | Description | Additional Options |
|------|-------------|-------------------|
| `text` | Single line text input | `placeholder`, `maxlength` |
| `textarea` | Multi-line text | `rows`, `placeholder` |
| `richtext` | Text with basic HTML | Supports `<span>`, `<br>`, `<strong>` |
| `wysiwyg` | Full rich text editor | Full HTML support |
| `image` | Image selector (Media Library) | `default` |
| `gallery` | Multiple images | Returns array of {src, alt, caption} |
| `color` | Color picker | `default` |
| `number` | Numeric input | `min`, `max`, `step` |
| `select` | Dropdown selection | `options` (key-value object) |
| `toggle` | Boolean switch | `default` (true/false) |
| `button` | Button with text/link | Returns {text, link} |
| `repeater` | Repeatable field group | `fields`, `max`, `min` |

### Field Definition Example

```json
{
    "name": "field_name",
    "label": "Display Label",
    "type": "text",
    "default": "Default value",
    "placeholder": "Enter value...",
    "help": "Helper text shown below field",
    "required": false
}
```

---

## CSS Variables

Use these CSS custom properties for consistent styling:

```css
:root {
    /* Colors - These are set dynamically based on theme settings */
    --primary-color: #1a73e8;
    --secondary-color: #34a853;
    --accent-color: #fbbc05;
    --heading-color: #1a1a1a;
    --text-color: #333333;
    --white-color: #ffffff;
    --border-color: #e0e0e0;
    --bg-light: #f8f9fa;
    --bg-dark: #1a1a1a;

    /* Typography */
    --font-heading: 'Poppins', sans-serif;
    --font-body: 'Open Sans', sans-serif;

    /* Spacing */
    --section-padding: 100px;
    --section-padding-mobile: 60px;
}

/* Usage in your CSS */
.my-element {
    color: var(--primary-color);
    font-family: var(--font-heading);
    padding: var(--section-padding) 0;
}
```

---

## Sample Pages

Create demo pages in `sample-data/pages/` that users can import.

### home.json Example

```json
{
    "title": "Home",
    "slug": "home",
    "template": "full-width",
    "status": "published",
    "meta": {
        "title": "Home - starter Theme Demo",
        "description": "Welcome to our beautiful starter starter website"
    },
    "sections": [
        {
            "type": "hero",
            "visible": true,
            "data": {
                "title": "Build Your <span>Dream startup</span> Online",
                "subtitle": "Premium starter Solutions",
                "background": "assets/images/hero-bg.jpg",
                "overlay_opacity": 60,
                "buttons": [
                    {
                        "text": "Get Started",
                        "link": "#contact",
                        "style": "primary"
                    },
                    {
                        "text": "View Portfolio",
                        "link": "#portfolio",
                        "style": "outline"
                    }
                ]
            },
            "styles": {
                "padding_top": "120",
                "padding_bottom": "120"
            }
        },
        {
            "type": "about",
            "visible": true,
            "data": {
                "subtitle": "About Us",
                "title": "We Create Amazing <span>Experiences</span>",
                "description": "Lorem ipsum dolor sit amet...",
                "image": "assets/images/about.jpg",
                "button": {
                    "text": "Learn More",
                    "link": "/about"
                }
            }
        },
        {
            "type": "services",
            "visible": true,
            "data": {
                "subtitle": "Our Services",
                "title": "What We Offer",
                "items": [
                    {
                        "icon": "fas fa-paint-brush",
                        "title": "Web Design",
                        "description": "Beautiful, responsive designs"
                    },
                    {
                        "icon": "fas fa-code",
                        "title": "Development",
                        "description": "Clean, efficient code"
                    },
                    {
                        "icon": "fas fa-rocket",
                        "title": "Marketing",
                        "description": "Growth strategies"
                    }
                ]
            }
        }
    ]
}
```

---

## Best Practices

### 1. Responsive Design

```css
/* Mobile-first approach */
.section-title {
    font-size: 32px;
}

@media (min-width: 768px) {
    .section-title {
        font-size: 42px;
    }
}

@media (min-width: 992px) {
    .section-title {
        font-size: 48px;
    }
}
```

### 2. Unique Class Names

Prefix all classes with your theme slug to avoid conflicts:

```css
/* Good */
.starter-hero-section { }
.starter-service-card { }

/* Avoid */
.hero { }
.card { }
```

### 3. Accessible HTML

```blade
{{-- Use semantic HTML --}}
<section aria-labelledby="services-heading">
    <h2 id="services-heading">{{ $title }}</h2>

    {{-- Add alt text for images --}}
    <img src="{{ $image }}" alt="{{ $imageAlt ?? 'Descriptive text' }}">

    {{-- Use buttons for actions --}}
    <button type="button" class="btn">Click Me</button>

    {{-- Use links for navigation --}}
    <a href="/about">Learn More</a>
</section>
```

### 4. Performance Optimization

- Optimize all images before including
- Use lazy loading for below-fold images
- Minimize CSS/JS files
- Use system fonts or limit custom font weights

```blade
{{-- Lazy load images --}}
<img src="{{ asset($image) }}" loading="lazy" alt="">
```

### 5. Animation Guidelines

```blade
{{-- Use WOW.js animations sparingly --}}
<div class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
    Content here
</div>
```

---

## Validation Checklist

Before submitting your theme:

- [ ] `theme.json` has all required fields
- [ ] `preview.jpg` is 1200x800 and under 500KB
- [ ] All sections defined in `config/sections.json` have blade files
- [ ] All blade files are error-free (test with empty data)
- [ ] Responsive on mobile, tablet, and desktop
- [ ] Works in Chrome, Firefox, Safari, Edge
- [ ] No console errors
- [ ] All images are optimized
- [ ] CSS classes are prefixed with theme slug
- [ ] Accessibility tested (color contrast, alt text, semantic HTML)
- [ ] Sample pages import correctly
- [ ] ZIP file is under 50MB

---

## Testing Your Theme

1. Create ZIP file of your theme folder
2. Go to Admin > Theme Import
3. Upload your ZIP file
4. Check for any validation errors
5. Test all sections in Page Builder
6. Import sample pages and verify appearance
7. Test on mobile devices

---

## Support

For questions or issues during theme development:

- Review existing themes for reference
- Check the Page Builder section library for field type examples
- Contact the development team for assistance

---

**Document Version**: 1.0.0
**Last Updated**: January 2026
