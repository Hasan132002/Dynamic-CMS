# Section Visibility System - Complete Guide

## Overview
The Content Manager now supports showing/hiding page sections dynamically without editing code. This system uses JSON-based configuration with visibility flags.

---

## How It Works

### 1. **Backend Structure**

#### JSON Format
Each page's JSON file (e.g., `storage/app/content/home-v2.json`) has sections that can be toggled:

```json
{
  "hero": {
    "visible": true,
    "data": {
      "title": "Welcome",
      "subtitle": "Learn anything"
    }
  },
  "testimonial": {
    "visible": false,
    "data": {
      "heading": "What Students Say"
    }
  }
}
```

**Key Points:**
- `visible`: `true` = section shows, `false` = section hidden
- `data`: Contains actual section content
- If `visible` key missing, defaults to `true`

---

### 2. **Frontend Implementation**

#### Blade Directive Usage
All page views now use `@sectionVisible` directive:

```php
{{-- Home V2 Example --}}
@sectionVisible($hero ?? [])
    @include('partials.sections.home-v2.hero')
@endif

@sectionVisible($testimonial ?? [])
    @include('partials.sections.home-v2.testimonial')
@endif
```

**What happens:**
1. Checks if section has `visible: false`
2. If false, skips rendering the section
3. If true or missing, renders normally

---

### 3. **Updated Files**

#### Controllers
- **BasePageController.php**: Added helper methods
  - `isSectionVisible()` - Check visibility
  - `getSectionData()` - Unwrap section data

#### Providers
- **AppServiceProvider.php**: Registered Blade directives
  - `@sectionVisible` - Conditional rendering
  - `@sectionData` - Data extraction helper

#### Views (All Updated)
**Home Pages:**
- `resources/views/pages/homes/v1.blade.php` ✅
- `resources/views/pages/homes/v2.blade.php` ✅
- `resources/views/pages/homes/v3.blade.php` ✅
- `resources/views/pages/homes/v4.blade.php` ✅
- `resources/views/pages/homes/v5.blade.php` ✅
- `resources/views/pages/homes/v6.blade.php` ✅
- `resources/views/pages/homes/v7.blade.php` ✅
- `resources/views/pages/homes/v8.blade.php` ✅

**Other Pages:**
- `resources/views/pages/about.blade.php` ✅
- `resources/views/pages/contact.blade.php` ✅
- `resources/views/pages/admissions.blade.php` ✅
- `resources/views/pages/consultation.blade.php` ✅
- `resources/views/pages/credit-transfer.blade.php` ✅
- `resources/views/pages/department.blade.php` ✅
- `resources/views/pages/financial-aid.blade.php` ✅
- `resources/views/pages/scholarships.blade.php` ✅

**Blog Pages:**
- `resources/views/pages/blogs/blogs.blade.php` ✅
- `resources/views/pages/blogs/blog-with-sidebar.blade.php` ✅
- `resources/views/pages/blogs/blog-details.blade.php` ✅

**Course Pages:**
- `resources/views/pages/courses/courses-grid-view.blade.php` ✅
- `resources/views/pages/courses/courses-list-view.blade.php` ✅
- `resources/views/pages/courses/courses-grid-with-sidebar.blade.php` ✅
- `resources/views/pages/courses/course-details.blade.php` ✅

---

## Usage

### For Admin Users

#### 1. Access Content Manager
```
http://127.0.0.1:8000/admin/content-manager
```

#### 2. Find Your Page
- Use search bar to find page by name
- Use filter chips (Home, Courses, About, Blog, Contact)

#### 3. Toggle Section Visibility
- Click on any page card
- Sections expand showing images
- Use toggle switch to hide/show
- Changes save automatically via AJAX

#### 4. View Frontend
- Visit the page URL
- Hidden sections won't appear
- No code changes needed!

---

### For Developers

#### Adding New Pages with Visibility Support

**Step 1: Update Controller**
Make sure your controller extends `BasePageController` and uses `renderPage()`:

```php
class MyPageController extends BasePageController
{
    public function index()
    {
        return $this->renderPage(
            'pages.my-page',
            'content/my-page.json'
        );
    }
}
```

**Step 2: Update Blade View**
Wrap all section includes with visibility checks:

```php
@sectionVisible($hero ?? [])
    @include('partials.sections.my-page.hero')
@endif

@sectionVisible($features ?? [])
    @include('partials.sections.my-page.features')
@endif
```

**Step 3: JSON Structure**
Your JSON file should follow this pattern:

```json
{
  "page_title": "My Page",
  "hero": {
    "heading": "Welcome"
  },
  "features": {
    "title": "Our Features"
  }
}
```

**Note:** First time, sections won't have `visible` key. Content Manager will add it when toggled.

---

## API Reference

### Blade Directives

#### @sectionVisible
**Purpose:** Check if section should be rendered

**Usage:**
```php
@sectionVisible($section ?? [])
    {{-- Your content --}}
@endif
```

**Parameters:**
- `$section`: Array containing section data
- Uses `?? []` to provide empty array fallback

**Returns:** Boolean
- `true`: Section renders
- `false`: Section skipped

---

#### @sectionData
**Purpose:** Extract section data (unwrap if needed)

**Usage:**
```php
@sectionData($section)
{{-- Now $__sectionData contains unwrapped data --}}
<h1>{{ $__sectionData['heading'] }}</h1>
```

---

### Controller Methods

#### isSectionVisible()
```php
protected function isSectionVisible(array $section): bool
```
**Returns:** `true` if section should display

---

#### getSectionData()
```php
protected function getSectionData(array $section): array
```
**Returns:** Section data without visibility wrapper

---

## JSON Structure Examples

### Before First Toggle (Clean)
```json
{
  "hero": {
    "title": "Welcome",
    "subtitle": "Learn Anything"
  }
}
```

### After Hiding Section
```json
{
  "hero": {
    "visible": false,
    "data": {
      "title": "Welcome",
      "subtitle": "Learn Anything"
    }
  }
}
```

### After Showing Again
```json
{
  "hero": {
    "visible": true,
    "data": {
      "title": "Welcome",
      "subtitle": "Learn Anything"
    }
  }
}
```

---

## Testing

### Test Section Visibility

1. **Hide a Section:**
   - Go to `/admin/content-manager`
   - Find "Home V2"
   - Toggle "Testimonial" to OFF
   - Visit `/home-v2`
   - Testimonial section should not appear

2. **Show Section Again:**
   - Go back to Content Manager
   - Toggle "Testimonial" to ON
   - Refresh `/home-v2`
   - Testimonial section appears

3. **Verify JSON:**
   ```bash
   cat storage/app/content/home-v2.json | grep -A3 "testimonial"
   ```
   Should show:
   ```json
   "testimonial": {
     "visible": false,
     ...
   }
   ```

---

## Common Issues & Solutions

### Issue 1: "No Pages Found"
**Problem:** Content Manager shows empty state

**Solution:**
- Check `storage/app/content/` has JSON files
- Verify JSON files are valid (use JSON validator)
- Check file permissions

---

### Issue 2: Sections Still Showing After Hide
**Problem:** Hidden sections still appear on frontend

**Solution:**
- Clear view cache: `php artisan view:clear`
- Check if view file has `@sectionVisible` wrapper
- Verify JSON has `"visible": false`

---

### Issue 3: Toggle Not Saving
**Problem:** Toggle switch doesn't persist changes

**Solution:**
- Check browser console for AJAX errors
- Verify CSRF token is valid
- Check file permissions on JSON files
- Ensure Storage facade has write access

---

## File Locations

### Backend
```
app/
├── Http/Controllers/
│   ├── BasePageController.php
│   └── Admin/ContentManagerController.php
├── Providers/
│   └── AppServiceProvider.php
```

### Frontend
```
resources/views/
├── pages/
│   ├── homes/ (v1-v8)
│   ├── blogs/
│   ├── courses/
│   └── *.blade.php
└── admin/
    └── content-manager.blade.php
```

### Content
```
storage/app/content/
├── home-v1.json
├── home-v2.json
├── about.json
├── contact.json
└── ...
```

---

## Best Practices

1. **Always use `?? []` fallback** in @sectionVisible
2. **Don't modify JSON structure** manually
3. **Use Content Manager** for toggling
4. **Clear cache** after major changes
5. **Test on multiple pages** before production
6. **Backup JSON files** before bulk changes

---

## Support

For issues or questions:
- Check this guide first
- Review `storage/logs/laravel.log`
- Test in browser console
- Verify file permissions

---

**Last Updated:** 2026-01-08
**Version:** 1.0
