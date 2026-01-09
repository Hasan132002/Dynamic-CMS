<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ThemeImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeImportController extends Controller
{
    protected $themeService;

    public function __construct(ThemeImportService $themeService)
    {
        $this->themeService = $themeService;
    }

    /**
     * Show theme marketplace/import page
     */
    public function index()
    {
        $installedThemes = $this->themeService->getInstalledThemes();

        return view('admin.theme-import', [
            'installedThemes' => $installedThemes,
        ]);
    }

    /**
     * Upload and import theme from ZIP
     */
    public function import(Request $request)
    {
        $request->validate([
            'theme_zip' => 'required|file|mimes:zip|max:51200', // 50MB max
        ]);

        $file = $request->file('theme_zip');
        $tempPath = $file->store('temp', 'local');
        $fullPath = storage_path('app/' . $tempPath);

        $result = $this->themeService->importFromZip($fullPath);

        // Clean up temp file
        File::delete($fullPath);

        if ($result['success']) {
            return redirect()
                ->route('admin.theme-import')
                ->with('success', $result['message']);
        }

        return redirect()
            ->route('admin.theme-import')
            ->with('error', implode(', ', $result['errors']));
    }

    /**
     * Delete an installed theme
     */
    public function destroy($slug)
    {
        $this->themeService->deleteTheme($slug);

        return redirect()
            ->route('admin.theme-import')
            ->with('success', "Theme '{$slug}' deleted successfully!");
    }

    /**
     * Preview theme details
     */
    public function show($slug)
    {
        $theme = $this->themeService->getThemeInfo($slug);

        if (!$theme) {
            return redirect()
                ->route('admin.theme-import')
                ->with('error', 'Theme not found');
        }

        return view('admin.theme-import-details', [
            'theme' => $theme,
        ]);
    }

    /**
     * Import sample pages from theme
     */
    public function importSamplePages($slug)
    {
        $imported = $this->themeService->importSamplePages($slug);

        if (count($imported) > 0) {
            return redirect()
                ->route('admin.theme-import')
                ->with('success', count($imported) . ' sample page(s) imported successfully!');
        }

        return redirect()
            ->route('admin.theme-import')
            ->with('info', 'No sample pages found in this theme.');
    }

    /**
     * Get theme sections (API)
     */
    public function getSections($slug)
    {
        $theme = $this->themeService->getThemeInfo($slug);

        if (!$theme || empty($theme['sections_config'])) {
            return response()->json(['success' => false, 'message' => 'No sections found']);
        }

        return response()->json([
            'success' => true,
            'sections' => $theme['sections_config']
        ]);
    }

    /**
     * Download developer documentation
     */
    public function downloadDocs()
    {
        $docsPath = resource_path('docs/theme-development-guide.md');

        if (!File::exists($docsPath)) {
            // Generate docs if not exists
            $this->generateDeveloperDocs();
        }

        return response()->download($docsPath, 'theme-development-guide.md');
    }

    /**
     * Generate developer documentation
     */
    protected function generateDeveloperDocs()
    {
        $docs = $this->getDeveloperDocsContent();

        $docsDir = resource_path('docs');
        if (!File::isDirectory($docsDir)) {
            File::makeDirectory($docsDir, 0755, true);
        }

        File::put($docsDir . '/theme-development-guide.md', $docs);
    }

    /**
     * Get developer documentation content
     */
    protected function getDeveloperDocsContent(): string
    {
        return <<<'MARKDOWN'
# Theme Development Guide

## Overview

This guide explains how to create themes compatible with our Page Builder system.

## Theme Package Structure

```
theme-name/
├── theme.json                 # Required - Theme metadata
├── preview.jpg                # Required - 1200x800 preview image
├── assets/
│   ├── css/
│   │   └── theme.css         # Theme-specific styles
│   ├── js/
│   │   └── theme.js          # Theme-specific scripts
│   └── images/               # Theme images
├── sections/                  # Blade partial files
│   ├── hero.blade.php
│   ├── about.blade.php
│   └── ...
├── sample-data/              # Demo content
│   ├── pages/
│   │   ├── home.json
│   │   └── about.json
│   └── settings.json
└── config/
    ├── sections.json         # Section definitions
    └── colors.json           # Color presets
```

## Required Files

### 1. theme.json

```json
{
    "name": "Theme Name",
    "slug": "theme-slug",
    "version": "1.0.0",
    "author": "Developer Name",
    "author_url": "https://developer-site.com",
    "description": "Theme description",
    "category": "Business",
    "tags": ["business", "modern"],
    "preview": "preview.jpg",
    "compatible_version": "1.0.0",
    "sections": ["hero", "about", "services"],
    "color_presets": {
        "primary": "#1a73e8",
        "secondary": "#34a853"
    }
}
```

### 2. preview.jpg

- Dimensions: 1200x800 pixels
- Format: JPG or PNG
- Shows theme preview/screenshot

## Section Development

### Section Definition (config/sections.json)

```json
{
    "hero": {
        "name": "Hero Banner",
        "description": "Main hero section",
        "partial": "hero",
        "preview": "assets/images/previews/hero.jpg",
        "fields": [
            {
                "name": "title",
                "label": "Title",
                "type": "richtext",
                "default": "Welcome"
            },
            {
                "name": "background",
                "label": "Background Image",
                "type": "image",
                "default": "assets/images/hero-bg.jpg"
            }
        ]
    }
}
```

### Field Types

| Type | Description | Options |
|------|-------------|---------|
| `text` | Single line text | - |
| `textarea` | Multi-line text | - |
| `richtext` | Text with HTML support | - |
| `wysiwyg` | Rich text editor | - |
| `image` | Image selector | - |
| `gallery` | Multiple images | - |
| `color` | Color picker | - |
| `number` | Numeric input | `min`, `max` |
| `select` | Dropdown select | `options` |
| `toggle` | Boolean switch | - |
| `button` | Button with text/link | - |
| `repeater` | Repeatable fields | `fields` |

### Section Blade Template

```blade
{{-- sections/hero.blade.php --}}
@php
    $title = $data['title'] ?? 'Default Title';
    $background = $data['background'] ?? '';
    $buttons = $data['buttons'] ?? [];
@endphp

<section class="hero-section" style="background-image: url('{{ asset($background) }}')">
    <div class="container">
        <h1>{!! $title !!}</h1>

        @foreach($buttons as $button)
            <a href="{{ $button['link'] }}" class="btn btn-{{ $button['style'] ?? 'primary' }}">
                {{ $button['text'] }}
            </a>
        @endforeach
    </div>
</section>
```

## CSS Variables

Use these CSS variables for consistency:

```css
:root {
    --primary-color: #1a73e8;
    --secondary-color: #34a853;
    --accent-color: #fbbc05;
    --text-color: #333333;
    --heading-color: #1a1a1a;
    --white-color: #ffffff;
    --border-color: #e0e0e0;
}
```

## Sample Pages

Create sample page JSONs in `sample-data/pages/`:

```json
{
    "title": "Home Page",
    "slug": "home",
    "template": "full-width",
    "status": "published",
    "meta": {
        "title": "Home - My Site",
        "description": "Welcome to our site"
    },
    "sections": [
        {
            "type": "hero",
            "visible": true,
            "data": {
                "title": "Welcome to Our Site",
                "background": "assets/images/hero-bg.jpg"
            }
        }
    ]
}
```

## Best Practices

1. **Use CSS Variables** - Always use CSS variables for colors
2. **Mobile First** - Design for mobile, enhance for desktop
3. **Accessible** - Use proper ARIA labels and semantic HTML
4. **Performance** - Optimize images, minimize CSS/JS
5. **Unique Classes** - Prefix classes with theme name to avoid conflicts

## Testing

Before submitting:

1. Test all sections independently
2. Verify responsive behavior
3. Check cross-browser compatibility
4. Validate JSON files
5. Test import/export functionality

## Support

For questions or issues, contact the development team.
MARKDOWN;
    }
}
