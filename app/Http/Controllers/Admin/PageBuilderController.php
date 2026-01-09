<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageBuilderController extends Controller
{
    protected $pagesPath = 'content/custom-pages';
    protected $sectionsPath = 'content/section-library';

    /**
     * Display list of custom pages
     */
    public function index()
    {
        $pages = $this->getAllPages();
        $templates = $this->getAvailableTemplates();

        return view('admin.page-builder.index', [
            'pages' => $pages,
            'templates' => $templates
        ]);
    }

    /**
     * Show create page form
     */
    public function create()
    {
        $templates = $this->getAvailableTemplates();
        $sectionLibrary = $this->getSectionLibrary();

        return view('admin.page-builder.create', [
            'templates' => $templates,
            'sectionLibrary' => $sectionLibrary
        ]);
    }

    /**
     * Store new page
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|regex:/^[a-z0-9-]+$/',
            'template' => 'required|string',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Check if slug already exists
        $existingPages = $this->getAllPages();
        foreach ($existingPages as $page) {
            if ($page['slug'] === $validated['slug']) {
                return back()->withErrors(['slug' => 'This slug is already in use.'])->withInput();
            }
        }

        // Create page structure
        $pageData = [
            'id' => Str::uuid()->toString(),
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'template' => $validated['template'],
            'status' => $validated['status'],
            'meta' => [
                'title' => $validated['meta_title'] ?? $validated['title'],
                'description' => $validated['meta_description'] ?? '',
            ],
            'sections' => [],
            'created_at' => now()->toISOString(),
            'updated_at' => now()->toISOString(),
        ];

        // Save page
        $this->savePage($pageData);

        return redirect()->route('admin.page-builder.edit', $validated['slug'])
            ->with('success', 'Page created successfully. Now add sections to your page.');
    }

    /**
     * Edit page
     */
    public function edit($slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return redirect()->route('admin.page-builder.index')
                ->with('error', 'Page not found.');
        }

        $templates = $this->getAvailableTemplates();
        $sectionLibrary = $this->getSectionLibrary();

        return view('admin.page-builder.edit', [
            'page' => $page,
            'templates' => $templates,
            'sectionLibrary' => $sectionLibrary
        ]);
    }

    /**
     * Update page settings
     */
    public function update(Request $request, $slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|regex:/^[a-z0-9-]+$/',
            'template' => 'sometimes|string',
            'status' => 'sometimes|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Check slug uniqueness if changed
        if (isset($validated['slug']) && $validated['slug'] !== $slug) {
            $existingPages = $this->getAllPages();
            foreach ($existingPages as $p) {
                if ($p['slug'] === $validated['slug']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This slug is already in use.'
                    ], 422);
                }
            }
        }

        // Update page data
        $page['title'] = $validated['title'] ?? $page['title'];
        $page['template'] = $validated['template'] ?? $page['template'];
        $page['status'] = $validated['status'] ?? $page['status'];
        $page['meta']['title'] = $validated['meta_title'] ?? $page['meta']['title'] ?? $page['title'];
        $page['meta']['description'] = $validated['meta_description'] ?? $page['meta']['description'] ?? '';
        $page['updated_at'] = now()->toISOString();

        // Handle slug change
        $oldSlug = $slug;
        $newSlug = $validated['slug'] ?? $slug;

        if ($oldSlug !== $newSlug) {
            // Delete old file
            Storage::delete("{$this->pagesPath}/{$oldSlug}.json");
            $page['slug'] = $newSlug;
        }

        $this->savePage($page);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Page updated successfully',
                'redirect' => $oldSlug !== $newSlug ? route('admin.page-builder.edit', $newSlug) : null
            ]);
        }

        return redirect()->route('admin.page-builder.edit', $newSlug)
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Save page sections (AJAX)
     */
    public function saveSections(Request $request, $slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $sections = $request->input('sections', []);

        $page['sections'] = $sections;
        $page['updated_at'] = now()->toISOString();

        $this->savePage($page);

        return response()->json([
            'success' => true,
            'message' => 'Sections saved successfully'
        ]);
    }

    /**
     * Add section to page (AJAX)
     */
    public function addSection(Request $request, $slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $validated = $request->validate([
            'section_type' => 'required|string',
            'position' => 'nullable|integer',
        ]);

        // Get section template from library
        $sectionTemplate = $this->getSectionTemplate($validated['section_type']);

        if (!$sectionTemplate) {
            // Debug: Log what was requested
            \Log::error('Section template not found', [
                'requested_type' => $validated['section_type'],
                'available_types' => collect($this->getSectionLibrary())->flatMap(function($cat) {
                    return array_keys($cat['sections'] ?? []);
                })->toArray()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Section template not found: ' . $validated['section_type']
            ], 404);
        }

        // Create new section instance
        $newSection = [
            'id' => Str::uuid()->toString(),
            'type' => $validated['section_type'],
            'visible' => true,
            'data' => $sectionTemplate['default_data'] ?? [],
            'styles' => $sectionTemplate['default_styles'] ?? [
                'background_color' => '',
                'text_color' => '',
                'padding_top' => '60',
                'padding_bottom' => '60',
            ],
        ];

        // Add section at position or end
        $position = $validated['position'] ?? count($page['sections']);
        array_splice($page['sections'], $position, 0, [$newSection]);

        $page['updated_at'] = now()->toISOString();
        $this->savePage($page);

        return response()->json([
            'success' => true,
            'message' => 'Section added successfully',
            'section' => $newSection
        ]);
    }

    /**
     * Update section data (AJAX)
     */
    public function updateSection(Request $request, $slug, $sectionId)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $sectionIndex = null;
        foreach ($page['sections'] as $index => $section) {
            if ($section['id'] === $sectionId) {
                $sectionIndex = $index;
                break;
            }
        }

        if ($sectionIndex === null) {
            return response()->json(['success' => false, 'message' => 'Section not found'], 404);
        }

        // Update section data
        $data = $request->input('data', []);
        $styles = $request->input('styles', []);
        $visible = $request->input('visible');

        if (!empty($data)) {
            $page['sections'][$sectionIndex]['data'] = array_merge(
                $page['sections'][$sectionIndex]['data'] ?? [],
                $data
            );
        }

        if (!empty($styles)) {
            $page['sections'][$sectionIndex]['styles'] = array_merge(
                $page['sections'][$sectionIndex]['styles'] ?? [],
                $styles
            );
        }

        if ($visible !== null) {
            $page['sections'][$sectionIndex]['visible'] = (bool)$visible;
        }

        $page['updated_at'] = now()->toISOString();
        $this->savePage($page);

        return response()->json([
            'success' => true,
            'message' => 'Section updated successfully'
        ]);
    }

    /**
     * Delete section (AJAX)
     */
    public function deleteSection(Request $request, $slug, $sectionId)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $page['sections'] = array_values(array_filter($page['sections'], function($section) use ($sectionId) {
            return $section['id'] !== $sectionId;
        }));

        $page['updated_at'] = now()->toISOString();
        $this->savePage($page);

        return response()->json([
            'success' => true,
            'message' => 'Section deleted successfully'
        ]);
    }

    /**
     * Reorder sections (AJAX)
     */
    public function reorderSections(Request $request, $slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $order = $request->input('order', []);

        // Reorder sections based on ID array
        $reordered = [];
        foreach ($order as $sectionId) {
            foreach ($page['sections'] as $section) {
                if ($section['id'] === $sectionId) {
                    $reordered[] = $section;
                    break;
                }
            }
        }

        $page['sections'] = $reordered;
        $page['updated_at'] = now()->toISOString();
        $this->savePage($page);

        return response()->json([
            'success' => true,
            'message' => 'Sections reordered successfully'
        ]);
    }

    /**
     * Delete page
     */
    public function destroy($slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        Storage::delete("{$this->pagesPath}/{$slug}.json");

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Page deleted successfully'
            ]);
        }

        return redirect()->route('admin.page-builder.index')
            ->with('success', 'Page deleted successfully.');
    }

    /**
     * Duplicate page
     */
    public function duplicate($slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        // Create duplicate
        $newPage = $page;
        $newPage['id'] = Str::uuid()->toString();
        $newPage['title'] = $page['title'] . ' (Copy)';
        $newPage['slug'] = $this->generateUniqueSlug($page['slug'] . '-copy');
        $newPage['status'] = 'draft';
        $newPage['created_at'] = now()->toISOString();
        $newPage['updated_at'] = now()->toISOString();

        // Generate new IDs for sections
        foreach ($newPage['sections'] as &$section) {
            $section['id'] = Str::uuid()->toString();
        }

        $this->savePage($newPage);

        return response()->json([
            'success' => true,
            'message' => 'Page duplicated successfully',
            'redirect' => route('admin.page-builder.edit', $newPage['slug'])
        ]);
    }

    /**
     * Get section editor form (AJAX)
     */
    public function getSectionEditor(Request $request, $slug, $sectionId)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found'], 404);
        }

        $section = null;
        foreach ($page['sections'] as $s) {
            if ($s['id'] === $sectionId) {
                $section = $s;
                break;
            }
        }

        if (!$section) {
            return response()->json(['success' => false, 'message' => 'Section not found'], 404);
        }

        // Get section template for field definitions
        $template = $this->getSectionTemplate($section['type']);

        return response()->json([
            'success' => true,
            'section' => $section,
            'template' => $template,
            'html' => view('admin.page-builder.partials.section-editor', [
                'section' => $section,
                'template' => $template
            ])->render()
        ]);
    }

    // ===== HELPER METHODS =====

    /**
     * Get all custom pages
     */
    protected function getAllPages()
    {
        $pages = [];

        if (!Storage::exists($this->pagesPath)) {
            Storage::makeDirectory($this->pagesPath);
        }

        $files = Storage::files($this->pagesPath);

        foreach ($files as $file) {
            if (str_ends_with($file, '.json')) {
                $content = json_decode(Storage::get($file), true);
                if ($content) {
                    $pages[] = $content;
                }
            }
        }

        // Sort by updated_at desc
        usort($pages, function($a, $b) {
            return strtotime($b['updated_at'] ?? 0) - strtotime($a['updated_at'] ?? 0);
        });

        return $pages;
    }

    /**
     * Get page by slug
     */
    protected function getPageBySlug($slug)
    {
        $filePath = "{$this->pagesPath}/{$slug}.json";

        if (!Storage::exists($filePath)) {
            return null;
        }

        return json_decode(Storage::get($filePath), true);
    }

    /**
     * Save page to storage
     */
    protected function savePage($pageData)
    {
        $filePath = "{$this->pagesPath}/{$pageData['slug']}.json";
        Storage::put($filePath, json_encode($pageData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    /**
     * Get available templates
     */
    protected function getAvailableTemplates()
    {
        return [
            'default' => [
                'name' => 'Default Template',
                'description' => 'Clean layout with header and footer',
                'preview' => 'assets/img/admin/templates/default.png'
            ],
            'full-width' => [
                'name' => 'Full Width',
                'description' => 'Edge-to-edge sections with no container',
                'preview' => 'assets/img/admin/templates/full-width.png'
            ],
            'sidebar-left' => [
                'name' => 'Left Sidebar',
                'description' => 'Content with sidebar on left',
                'preview' => 'assets/img/admin/templates/sidebar-left.png'
            ],
            'sidebar-right' => [
                'name' => 'Right Sidebar',
                'description' => 'Content with sidebar on right',
                'preview' => 'assets/img/admin/templates/sidebar-right.png'
            ],
            'landing' => [
                'name' => 'Landing Page',
                'description' => 'Minimal header, focused on conversion',
                'preview' => 'assets/img/admin/templates/landing.png'
            ],
        ];
    }

    /**
     * Get section library with all available sections
     */
    protected function getSectionLibrary()
    {
        return [
            'hero' => [
                'category' => 'Hero Sections',
                'sections' => [
                    'hero-standard' => [
                        'name' => 'Hero Standard',
                        'description' => 'Full-width hero with title, subtitle, and CTA button',
                        'preview' => 'assets/img/admin/sections/hero-standard.png',
                        'default_data' => [
                            'background' => 'assets/img/home_1/hero_bg_1.jpg',
                            'subtitle' => 'Welcome to Our Site',
                            'title' => 'Your Amazing <span>Headline</span> Here',
                            'description' => 'Add your compelling description text that engages visitors.',
                            'primary_btn' => ['text' => 'Get Started', 'link' => '#'],
                            'secondary_btn' => ['text' => 'Learn More', 'link' => '#'],
                        ],
                        'fields' => [
                            ['name' => 'background', 'type' => 'image', 'label' => 'Background Image'],
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'richtext', 'label' => 'Title'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ['name' => 'primary_btn', 'type' => 'button', 'label' => 'Primary Button'],
                            ['name' => 'secondary_btn', 'type' => 'button', 'label' => 'Secondary Button'],
                        ]
                    ],
                    'hero-slider' => [
                        'name' => 'Hero Slider',
                        'description' => 'Sliding hero with multiple slides',
                        'preview' => 'assets/img/admin/sections/hero-slider.png',
                        'default_data' => [
                            'slides' => [
                                [
                                    'background' => 'assets/img/home_1/hero_bg_1.jpg',
                                    'title' => 'First Slide Title',
                                    'subtitle' => 'First slide description',
                                    'btn_text' => 'Learn More',
                                    'btn_link' => '#'
                                ]
                            ]
                        ],
                        'fields' => [
                            ['name' => 'slides', 'type' => 'repeater', 'label' => 'Slides', 'fields' => [
                                ['name' => 'background', 'type' => 'image', 'label' => 'Background'],
                                ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                                ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                                ['name' => 'btn_text', 'type' => 'text', 'label' => 'Button Text'],
                                ['name' => 'btn_link', 'type' => 'text', 'label' => 'Button Link'],
                            ]]
                        ]
                    ],
                ]
            ],
            'about' => [
                'category' => 'About Sections',
                'sections' => [
                    'about-standard' => [
                        'name' => 'About Standard',
                        'description' => 'Image with text content',
                        'preview' => 'assets/img/admin/sections/about-standard.png',
                        'default_data' => [
                            'image' => 'assets/img/home_1/about_img_1.jpg',
                            'subtitle' => 'About Us',
                            'title' => 'Who We Are',
                            'description' => 'Add your about content here. Tell visitors your story.',
                            'features' => [],
                            'btn_text' => 'Read More',
                            'btn_link' => '#'
                        ],
                        'fields' => [
                            ['name' => 'image', 'type' => 'image', 'label' => 'Image'],
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ['name' => 'btn_text', 'type' => 'text', 'label' => 'Button Text'],
                            ['name' => 'btn_link', 'type' => 'text', 'label' => 'Button Link'],
                        ]
                    ],
                ]
            ],
            'features' => [
                'category' => 'Features & Services',
                'sections' => [
                    'features-grid' => [
                        'name' => 'Features Grid',
                        'description' => 'Grid of feature cards with icons',
                        'preview' => 'assets/img/admin/sections/features-grid.png',
                        'default_data' => [
                            'subtitle' => 'Our Features',
                            'title' => 'What We Offer',
                            'items' => [
                                ['icon' => 'fas fa-star', 'title' => 'Feature 1', 'description' => 'Feature description'],
                                ['icon' => 'fas fa-heart', 'title' => 'Feature 2', 'description' => 'Feature description'],
                                ['icon' => 'fas fa-bolt', 'title' => 'Feature 3', 'description' => 'Feature description'],
                            ]
                        ],
                        'fields' => [
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'items', 'type' => 'repeater', 'label' => 'Features', 'fields' => [
                                ['name' => 'icon', 'type' => 'icon', 'label' => 'Icon'],
                                ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                                ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ]]
                        ]
                    ],
                ]
            ],
            'content' => [
                'category' => 'Content Sections',
                'sections' => [
                    'text-block' => [
                        'name' => 'Text Block',
                        'description' => 'Simple text content block',
                        'preview' => 'assets/img/admin/sections/text-block.png',
                        'default_data' => [
                            'title' => 'Section Title',
                            'content' => '<p>Add your content here. You can use HTML formatting.</p>'
                        ],
                        'fields' => [
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'content', 'type' => 'wysiwyg', 'label' => 'Content'],
                        ]
                    ],
                    'image-text' => [
                        'name' => 'Image with Text',
                        'description' => 'Image alongside text content',
                        'preview' => 'assets/img/admin/sections/image-text.png',
                        'default_data' => [
                            'image' => 'assets/img/home_1/about_img_1.jpg',
                            'image_position' => 'left',
                            'title' => 'Section Title',
                            'content' => '<p>Add your content here.</p>',
                            'btn_text' => '',
                            'btn_link' => ''
                        ],
                        'fields' => [
                            ['name' => 'image', 'type' => 'image', 'label' => 'Image'],
                            ['name' => 'image_position', 'type' => 'select', 'label' => 'Image Position', 'options' => ['left' => 'Left', 'right' => 'Right']],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'content', 'type' => 'wysiwyg', 'label' => 'Content'],
                            ['name' => 'btn_text', 'type' => 'text', 'label' => 'Button Text'],
                            ['name' => 'btn_link', 'type' => 'text', 'label' => 'Button Link'],
                        ]
                    ],
                ]
            ],
            'cta' => [
                'category' => 'Call to Action',
                'sections' => [
                    'cta-standard' => [
                        'name' => 'CTA Standard',
                        'description' => 'Call to action with background',
                        'preview' => 'assets/img/admin/sections/cta-standard.png',
                        'default_data' => [
                            'background' => '',
                            'background_color' => '#1a73e8',
                            'title' => 'Ready to Get Started?',
                            'description' => 'Join thousands of satisfied customers today.',
                            'btn_text' => 'Get Started',
                            'btn_link' => '#'
                        ],
                        'fields' => [
                            ['name' => 'background', 'type' => 'image', 'label' => 'Background Image'],
                            ['name' => 'background_color', 'type' => 'color', 'label' => 'Background Color'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ['name' => 'btn_text', 'type' => 'text', 'label' => 'Button Text'],
                            ['name' => 'btn_link', 'type' => 'text', 'label' => 'Button Link'],
                        ]
                    ],
                ]
            ],
            'testimonials' => [
                'category' => 'Testimonials',
                'sections' => [
                    'testimonial-slider' => [
                        'name' => 'Testimonial Slider',
                        'description' => 'Sliding testimonials with avatars',
                        'preview' => 'assets/img/admin/sections/testimonial-slider.png',
                        'default_data' => [
                            'subtitle' => 'Testimonials',
                            'title' => 'What Our Clients Say',
                            'items' => [
                                [
                                    'avatar' => 'assets/img/home_1/avatar_1.png',
                                    'name' => 'John Doe',
                                    'designation' => 'CEO, Company',
                                    'text' => 'Great service and amazing results!',
                                    'rating' => 5
                                ]
                            ]
                        ],
                        'fields' => [
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'items', 'type' => 'repeater', 'label' => 'Testimonials', 'fields' => [
                                ['name' => 'avatar', 'type' => 'image', 'label' => 'Avatar'],
                                ['name' => 'name', 'type' => 'text', 'label' => 'Name'],
                                ['name' => 'designation', 'type' => 'text', 'label' => 'Designation'],
                                ['name' => 'text', 'type' => 'textarea', 'label' => 'Testimonial Text'],
                                ['name' => 'rating', 'type' => 'number', 'label' => 'Rating (1-5)'],
                            ]]
                        ]
                    ],
                ]
            ],
            'contact' => [
                'category' => 'Contact',
                'sections' => [
                    'contact-form' => [
                        'name' => 'Contact Form',
                        'description' => 'Contact form with info',
                        'preview' => 'assets/img/admin/sections/contact-form.png',
                        'default_data' => [
                            'title' => 'Get In Touch',
                            'subtitle' => 'Contact Us',
                            'description' => 'Have questions? We\'d love to hear from you.',
                            'email' => 'info@example.com',
                            'phone' => '+1 234 567 890',
                            'address' => '123 Street, City, Country',
                            'form_action' => '#',
                            'show_map' => false,
                            'map_embed' => ''
                        ],
                        'fields' => [
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'description', 'type' => 'textarea', 'label' => 'Description'],
                            ['name' => 'email', 'type' => 'text', 'label' => 'Email'],
                            ['name' => 'phone', 'type' => 'text', 'label' => 'Phone'],
                            ['name' => 'address', 'type' => 'textarea', 'label' => 'Address'],
                            ['name' => 'form_action', 'type' => 'text', 'label' => 'Form Action URL'],
                            ['name' => 'show_map', 'type' => 'toggle', 'label' => 'Show Map'],
                            ['name' => 'map_embed', 'type' => 'textarea', 'label' => 'Map Embed Code'],
                        ]
                    ],
                ]
            ],
            'gallery' => [
                'category' => 'Gallery',
                'sections' => [
                    'gallery-grid' => [
                        'name' => 'Image Gallery',
                        'description' => 'Grid of images with lightbox',
                        'preview' => 'assets/img/admin/sections/gallery-grid.png',
                        'default_data' => [
                            'title' => 'Our Gallery',
                            'subtitle' => 'Gallery',
                            'columns' => 3,
                            'images' => []
                        ],
                        'fields' => [
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'columns', 'type' => 'select', 'label' => 'Columns', 'options' => ['2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns']],
                            ['name' => 'images', 'type' => 'gallery', 'label' => 'Images'],
                        ]
                    ],
                ]
            ],
            'team' => [
                'category' => 'Team',
                'sections' => [
                    'team-grid' => [
                        'name' => 'Team Grid',
                        'description' => 'Grid of team members',
                        'preview' => 'assets/img/admin/sections/team-grid.png',
                        'default_data' => [
                            'subtitle' => 'Our Team',
                            'title' => 'Meet Our Experts',
                            'members' => [
                                [
                                    'image' => 'assets/img/home_1/avatar_1.png',
                                    'name' => 'John Doe',
                                    'designation' => 'CEO',
                                    'bio' => 'Brief bio here',
                                    'socials' => []
                                ]
                            ]
                        ],
                        'fields' => [
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'members', 'type' => 'repeater', 'label' => 'Team Members', 'fields' => [
                                ['name' => 'image', 'type' => 'image', 'label' => 'Photo'],
                                ['name' => 'name', 'type' => 'text', 'label' => 'Name'],
                                ['name' => 'designation', 'type' => 'text', 'label' => 'Designation'],
                                ['name' => 'bio', 'type' => 'textarea', 'label' => 'Bio'],
                            ]]
                        ]
                    ],
                ]
            ],
            'faq' => [
                'category' => 'FAQ',
                'sections' => [
                    'faq-accordion' => [
                        'name' => 'FAQ Accordion',
                        'description' => 'Expandable FAQ items',
                        'preview' => 'assets/img/admin/sections/faq-accordion.png',
                        'default_data' => [
                            'subtitle' => 'FAQ',
                            'title' => 'Frequently Asked Questions',
                            'items' => [
                                ['question' => 'Sample Question?', 'answer' => 'Sample answer here.']
                            ]
                        ],
                        'fields' => [
                            ['name' => 'subtitle', 'type' => 'text', 'label' => 'Subtitle'],
                            ['name' => 'title', 'type' => 'text', 'label' => 'Title'],
                            ['name' => 'items', 'type' => 'repeater', 'label' => 'FAQ Items', 'fields' => [
                                ['name' => 'question', 'type' => 'text', 'label' => 'Question'],
                                ['name' => 'answer', 'type' => 'textarea', 'label' => 'Answer'],
                            ]]
                        ]
                    ],
                ]
            ],
            'spacer' => [
                'category' => 'Layout',
                'sections' => [
                    'spacer' => [
                        'name' => 'Spacer',
                        'description' => 'Add vertical space between sections',
                        'preview' => 'assets/img/admin/sections/spacer.png',
                        'default_data' => [
                            'height' => '60',
                            'height_mobile' => '30'
                        ],
                        'fields' => [
                            ['name' => 'height', 'type' => 'number', 'label' => 'Height (px)'],
                            ['name' => 'height_mobile', 'type' => 'number', 'label' => 'Mobile Height (px)'],
                        ]
                    ],
                    'divider' => [
                        'name' => 'Divider',
                        'description' => 'Horizontal line divider',
                        'preview' => 'assets/img/admin/sections/divider.png',
                        'default_data' => [
                            'style' => 'solid',
                            'color' => '#e0e0e0',
                            'width' => '100',
                            'thickness' => '1'
                        ],
                        'fields' => [
                            ['name' => 'style', 'type' => 'select', 'label' => 'Style', 'options' => ['solid' => 'Solid', 'dashed' => 'Dashed', 'dotted' => 'Dotted']],
                            ['name' => 'color', 'type' => 'color', 'label' => 'Color'],
                            ['name' => 'width', 'type' => 'number', 'label' => 'Width (%)'],
                            ['name' => 'thickness', 'type' => 'number', 'label' => 'Thickness (px)'],
                        ]
                    ],
                ]
            ],
            // ===== HOME V1 STYLED SECTIONS =====
            'home-v1' => [
                'category' => 'Home V1 Styled',
                'sections' => [
                    'about-v1' => [
                        'name' => 'About Section (V1)',
                        'description' => 'Styled about with images, video popup, and programs list',
                        'preview' => 'assets/img/admin/sections/about-v1.png',
                        'partial' => 'sections.home-v1.about',
                        'default_data' => [
                            'est' => 'Est 1990',
                            'images' => ['assets/img/home_1/about_img_1.jpg', 'assets/img/home_1/about_img_2.jpg'],
                            'video_url' => 'https://www.youtube.com/watch?v=rFMO1pqofCY',
                            'subtitle' => 'About Us',
                            'title' => 'Empowering Education for a Brighter Future',
                            'description' => 'At our institution, we are committed to fostering academic excellence.',
                            'programs' => [
                                ['title' => 'Academic Programs', 'text' => 'Diverse courses tailored to meet modern needs.'],
                                ['title' => 'Expert Faculty', 'text' => 'Learn from industry experts.']
                            ],
                            'button' => ['label' => 'Learn More', 'url' => '#']
                        ],
                    ],
                    'blog-v1' => [
                        'name' => 'Blog Section (V1)',
                        'description' => 'Blog posts grid with styled cards',
                        'partial' => 'sections.home-v1.blog',
                    ],
                    'campus-v1' => [
                        'name' => 'Campus Life (V1)',
                        'description' => 'Campus life cards with accent background',
                        'partial' => 'sections.home-v1.campus',
                    ],
                    'video-v1' => [
                        'name' => 'Video Block (V1)',
                        'description' => 'Video block with contact box',
                        'partial' => 'sections.home-v1.video',
                    ],
                    'hero-v1' => [
                        'name' => 'Hero (V1)',
                        'description' => 'Hero section with buttons',
                        'partial' => 'sections.home-v1.hero',
                    ],
                    'testimonial-v1' => [
                        'name' => 'Testimonial (V1)',
                        'description' => 'Testimonial slider with image',
                        'partial' => 'sections.home-v1.testimonial',
                    ],
                    'features-v1' => [
                        'name' => 'Features (V1)',
                        'description' => 'Features with icons',
                        'partial' => 'sections.home-v1.features',
                    ],
                    'courses-v1' => [
                        'name' => 'Courses (V1)',
                        'description' => 'Courses grid cards',
                        'partial' => 'sections.home-v1.courses',
                    ],
                    'event-v1' => [
                        'name' => 'Event (V1)',
                        'description' => 'Events section',
                        'partial' => 'sections.home-v1.event',
                    ],
                    'department-v1' => [
                        'name' => 'Department (V1)',
                        'description' => 'Department showcase',
                        'partial' => 'sections.home-v1.department',
                    ],
                ]
            ],
            // ===== HOME V2 STYLED SECTIONS =====
            'home-v2' => [
                'category' => 'Home V2 Styled',
                'sections' => [
                    'hero-v2' => [
                        'name' => 'Hero (V2)',
                        'description' => 'Hero with search and stats',
                        'partial' => 'sections.home-v2.hero',
                    ],
                    'about-v2' => [
                        'name' => 'About (V2)',
                        'description' => 'About section V2 style',
                        'partial' => 'sections.home-v2.about',
                    ],
                    'categories-v2' => [
                        'name' => 'Categories (V2)',
                        'description' => 'Course categories grid',
                        'partial' => 'sections.home-v2.categories',
                    ],
                    'courses-v2' => [
                        'name' => 'Courses (V2)',
                        'description' => 'Courses with tabs',
                        'partial' => 'sections.home-v2.courses',
                    ],
                    'blog-v2' => [
                        'name' => 'Blog (V2)',
                        'description' => 'Blog section V2 style',
                        'partial' => 'sections.home-v2.blog',
                    ],
                    'testimonial-v2' => [
                        'name' => 'Testimonial (V2)',
                        'description' => 'Testimonials V2 style',
                        'partial' => 'sections.home-v2.testimonial',
                    ],
                    'team-v2' => [
                        'name' => 'Team (V2)',
                        'description' => 'Team members V2',
                        'partial' => 'sections.home-v2.team',
                    ],
                    'why-choose-us-v2' => [
                        'name' => 'Why Choose Us (V2)',
                        'description' => 'Why choose us section',
                        'partial' => 'sections.home-v2.why-choose-us',
                    ],
                    'brand-v2' => [
                        'name' => 'Brand Logos (V2)',
                        'description' => 'Brand/partner logos',
                        'partial' => 'sections.home-v2.brand',
                    ],
                    'event-schedule-v2' => [
                        'name' => 'Event Schedule (V2)',
                        'description' => 'Event schedule with tabs',
                        'partial' => 'sections.home-v2.event-schedule',
                    ],
                ]
            ],
            // ===== HOME V3 STYLED SECTIONS =====
            'home-v3' => [
                'category' => 'Home V3 Styled',
                'sections' => [
                    'hero-v3' => [
                        'name' => 'Hero (V3)',
                        'description' => 'Hero with image slider',
                        'partial' => 'sections.home-v3.hero',
                    ],
                    'about-v3' => [
                        'name' => 'About (V3)',
                        'description' => 'About with counters',
                        'partial' => 'sections.home-v3.about',
                    ],
                    'category-v3' => [
                        'name' => 'Categories (V3)',
                        'description' => 'Category cards',
                        'partial' => 'sections.home-v3.category',
                    ],
                    'courses-v3' => [
                        'name' => 'Courses (V3)',
                        'description' => 'Courses slider',
                        'partial' => 'sections.home-v3.courses',
                    ],
                    'feature-v3' => [
                        'name' => 'Features (V3)',
                        'description' => 'Feature boxes',
                        'partial' => 'sections.home-v3.feature',
                    ],
                    'testimonial-v3' => [
                        'name' => 'Testimonial (V3)',
                        'description' => 'Testimonials V3',
                        'partial' => 'sections.home-v3.testimonial',
                    ],
                    'instructor-v3' => [
                        'name' => 'Instructors (V3)',
                        'description' => 'Instructor profiles',
                        'partial' => 'sections.home-v3.Instructor',
                    ],
                    'blog-v3' => [
                        'name' => 'Blog (V3)',
                        'description' => 'Blog posts V3',
                        'partial' => 'sections.home-v3.blog',
                    ],
                    'funfact-v3' => [
                        'name' => 'Fun Facts (V3)',
                        'description' => 'Counter stats',
                        'partial' => 'sections.home-v3.funfact',
                    ],
                    'pricing-v3' => [
                        'name' => 'Pricing (V3)',
                        'description' => 'Pricing tables',
                        'partial' => 'sections.home-v3.pricing',
                    ],
                    'certificate-v3' => [
                        'name' => 'Certificate (V3)',
                        'description' => 'Certificate showcase',
                        'partial' => 'sections.home-v3.certificate',
                    ],
                    'app-v3' => [
                        'name' => 'App Download (V3)',
                        'description' => 'Mobile app promo',
                        'partial' => 'sections.home-v3.app',
                    ],
                ]
            ],
            // ===== HOME V4 STYLED SECTIONS =====
            'home-v4' => [
                'category' => 'Home V4 Styled',
                'sections' => [
                    'hero-v4' => [
                        'name' => 'Hero (V4)',
                        'description' => 'Hero with form',
                        'partial' => 'sections.home-v4.hero',
                    ],
                    'about-v4' => [
                        'name' => 'About (V4)',
                        'description' => 'About section V4',
                        'partial' => 'sections.home-v4.about',
                    ],
                    'courses-v4' => [
                        'name' => 'Courses (V4)',
                        'description' => 'Courses grid V4',
                        'partial' => 'sections.home-v4.courses',
                    ],
                    'faqs-v4' => [
                        'name' => 'FAQ (V4)',
                        'description' => 'FAQ accordion with image',
                        'partial' => 'sections.home-v4.faqs',
                    ],
                    'testimonial-v4' => [
                        'name' => 'Testimonial (V4)',
                        'description' => 'Testimonials V4',
                        'partial' => 'sections.home-v4.testimonial',
                    ],
                    'team-v4' => [
                        'name' => 'Team (V4)',
                        'description' => 'Team grid V4',
                        'partial' => 'sections.home-v4.team',
                    ],
                    'blog-v4' => [
                        'name' => 'Blog (V4)',
                        'description' => 'Blog posts V4',
                        'partial' => 'sections.home-v4.blog',
                    ],
                    'funfact-v4' => [
                        'name' => 'Fun Facts (V4)',
                        'description' => 'Counter stats V4',
                        'partial' => 'sections.home-v4.funfact',
                    ],
                    'cta-v4' => [
                        'name' => 'CTA (V4)',
                        'description' => 'Call to action V4',
                        'partial' => 'sections.home-v4.cta',
                    ],
                    'newsletter-v4' => [
                        'name' => 'Newsletter (V4)',
                        'description' => 'Newsletter signup',
                        'partial' => 'sections.home-v4.newsletter',
                    ],
                ]
            ],
            // ===== HOME V5 STYLED SECTIONS =====
            'home-v5' => [
                'category' => 'Home V5 Styled',
                'sections' => [
                    'hero-v5' => [
                        'name' => 'Hero (V5)',
                        'description' => 'Hero with video',
                        'partial' => 'sections.home-v5.hero',
                    ],
                    'about-v5' => [
                        'name' => 'About (V5)',
                        'description' => 'About section V5',
                        'partial' => 'sections.home-v5.about',
                    ],
                    'categories-v5' => [
                        'name' => 'Categories (V5)',
                        'description' => 'Category icons',
                        'partial' => 'sections.home-v5.categories',
                    ],
                    'courses-v5' => [
                        'name' => 'Courses (V5)',
                        'description' => 'Courses V5',
                        'partial' => 'sections.home-v5.courses',
                    ],
                    'faq-v5' => [
                        'name' => 'FAQ (V5)',
                        'description' => 'FAQ accordion V5',
                        'partial' => 'sections.home-v5.faq',
                    ],
                    'testimonial-v5' => [
                        'name' => 'Testimonial (V5)',
                        'description' => 'Testimonials V5',
                        'partial' => 'sections.home-v5.testimonial',
                    ],
                    'advisor-v5' => [
                        'name' => 'Advisors (V5)',
                        'description' => 'Advisor profiles',
                        'partial' => 'sections.home-v5.advisor',
                    ],
                    'blog-v5' => [
                        'name' => 'Blog (V5)',
                        'description' => 'Blog posts V5',
                        'partial' => 'sections.home-v5.blog',
                    ],
                    'pricing-v5' => [
                        'name' => 'Pricing (V5)',
                        'description' => 'Pricing tables V5',
                        'partial' => 'sections.home-v5.pricing',
                    ],
                    'cta-v5' => [
                        'name' => 'CTA (V5)',
                        'description' => 'Call to action V5',
                        'partial' => 'sections.home-v5.cta',
                    ],
                    'video-contact-v5' => [
                        'name' => 'Video Contact (V5)',
                        'description' => 'Video with contact form',
                        'partial' => 'sections.home-v5.video-contact',
                    ],
                ]
            ],
            // ===== HOME V6 STYLED SECTIONS =====
            'home-v6' => [
                'category' => 'Home V6 Styled',
                'sections' => [
                    'hero-v6' => [
                        'name' => 'Hero (V6)',
                        'description' => 'Hero slider V6',
                        'partial' => 'sections.home-v6.hero',
                    ],
                    'about-v6' => [
                        'name' => 'About (V6)',
                        'description' => 'About section V6',
                        'partial' => 'sections.home-v6.about',
                    ],
                    'categories-v6' => [
                        'name' => 'Categories (V6)',
                        'description' => 'Category cards V6',
                        'partial' => 'sections.home-v6.categories',
                    ],
                    'courses-v6' => [
                        'name' => 'Courses (V6)',
                        'description' => 'Courses V6',
                        'partial' => 'sections.home-v6.courses',
                    ],
                    'choose-us-v6' => [
                        'name' => 'Why Choose Us (V6)',
                        'description' => 'Why choose us V6',
                        'partial' => 'sections.home-v6.choose-us',
                    ],
                    'team-v6' => [
                        'name' => 'Team (V6)',
                        'description' => 'Team grid V6',
                        'partial' => 'sections.home-v6.team',
                    ],
                    'faqs-v6' => [
                        'name' => 'FAQ (V6)',
                        'description' => 'FAQ accordion V6',
                        'partial' => 'sections.home-v6.faqs',
                    ],
                    'blog-v6' => [
                        'name' => 'Blog (V6)',
                        'description' => 'Blog posts V6',
                        'partial' => 'sections.home-v6.blog',
                    ],
                    'contact-v6' => [
                        'name' => 'Contact (V6)',
                        'description' => 'Contact form with counter',
                        'partial' => 'sections.home-v6.contact',
                    ],
                    'newsletter-v6' => [
                        'name' => 'Newsletter (V6)',
                        'description' => 'Newsletter signup V6',
                        'partial' => 'sections.home-v6.newsletter',
                    ],
                ]
            ],
            // ===== HOME V7 STYLED SECTIONS =====
            'home-v7' => [
                'category' => 'Home V7 Styled',
                'sections' => [
                    'hero-v7' => [
                        'name' => 'Hero (V7)',
                        'description' => 'Hero V7 style',
                        'partial' => 'sections.home-v7.hero',
                    ],
                    'about-v7' => [
                        'name' => 'About (V7)',
                        'description' => 'About section V7',
                        'partial' => 'sections.home-v7.about',
                    ],
                    'feature-v7' => [
                        'name' => 'Features (V7)',
                        'description' => 'Feature boxes V7',
                        'partial' => 'sections.home-v7.feature',
                    ],
                    'courses-v7' => [
                        'name' => 'Courses (V7)',
                        'description' => 'Courses V7',
                        'partial' => 'sections.home-v7.courses',
                    ],
                    'choose-us-v7' => [
                        'name' => 'Why Choose Us (V7)',
                        'description' => 'Why choose us V7',
                        'partial' => 'sections.home-v7.choose-us',
                    ],
                    'instructor-v7' => [
                        'name' => 'Instructors (V7)',
                        'description' => 'Instructor profiles V7',
                        'partial' => 'sections.home-v7.Instructor',
                    ],
                    'testimonial-v7' => [
                        'name' => 'Testimonial (V7)',
                        'description' => 'Testimonials V7',
                        'partial' => 'sections.home-v7.testimonial',
                    ],
                    'accordion-v7' => [
                        'name' => 'Accordion (V7)',
                        'description' => 'Accordion FAQ V7',
                        'partial' => 'sections.home-v7.accordion',
                    ],
                    'blog-v7' => [
                        'name' => 'Blog (V7)',
                        'description' => 'Blog posts V7',
                        'partial' => 'sections.home-v7.blog',
                    ],
                    'brands-v7' => [
                        'name' => 'Brands (V7)',
                        'description' => 'Brand logos V7',
                        'partial' => 'sections.home-v7.brands',
                    ],
                ]
            ],
            // ===== HOME V8 STYLED SECTIONS =====
            'home-v8' => [
                'category' => 'Home V8 Styled',
                'sections' => [
                    'hero-v8' => [
                        'name' => 'Hero (V8)',
                        'description' => 'Hero V8 style',
                        'partial' => 'sections.home-v8.hero',
                    ],
                    'about-v8' => [
                        'name' => 'About (V8)',
                        'description' => 'About section V8',
                        'partial' => 'sections.home-v8.about',
                    ],
                    'category-v8' => [
                        'name' => 'Categories (V8)',
                        'description' => 'Category cards V8',
                        'partial' => 'sections.home-v8.category',
                    ],
                    'courses-v8' => [
                        'name' => 'Courses (V8)',
                        'description' => 'Courses V8',
                        'partial' => 'sections.home-v8.courses',
                    ],
                    'team-v8' => [
                        'name' => 'Team (V8)',
                        'description' => 'Team grid V8',
                        'partial' => 'sections.home-v8.team',
                    ],
                    'testimonial-v8' => [
                        'name' => 'Testimonial (V8)',
                        'description' => 'Testimonials V8',
                        'partial' => 'sections.home-v8.testimonial',
                    ],
                    'blog-v8' => [
                        'name' => 'Blog (V8)',
                        'description' => 'Blog posts V8',
                        'partial' => 'sections.home-v8.blog',
                    ],
                    'cta-v8' => [
                        'name' => 'CTA (V8)',
                        'description' => 'Call to action V8',
                        'partial' => 'sections.home-v8.cta',
                    ],
                    'instagram-v8' => [
                        'name' => 'Instagram (V8)',
                        'description' => 'Instagram feed',
                        'partial' => 'sections.home-v8.instagram',
                    ],
                ]
            ],
            // ===== ABOUT PAGE SECTIONS =====
            'about-page' => [
                'category' => 'About Page',
                'sections' => [
                    'about-hero' => [
                        'name' => 'About Hero',
                        'description' => 'About page hero section',
                        'partial' => 'about-section.hero',
                    ],
                    'about-main' => [
                        'name' => 'About Content',
                        'description' => 'Main about content',
                        'partial' => 'about-section.about',
                    ],
                    'about-campus' => [
                        'name' => 'Campus Section',
                        'description' => 'Campus showcase',
                        'partial' => 'about-section.campus',
                    ],
                    'about-department' => [
                        'name' => 'Department Section',
                        'description' => 'Department showcase',
                        'partial' => 'about-section.department',
                    ],
                    'about-video' => [
                        'name' => 'Video Section',
                        'description' => 'Video block',
                        'partial' => 'about-section.video',
                    ],
                    'about-blog' => [
                        'name' => 'Blog Section',
                        'description' => 'Blog posts on about page',
                        'partial' => 'about-section.blog',
                    ],
                ]
            ],
            // ===== CONTACT PAGE SECTIONS =====
            'contact-page' => [
                'category' => 'Contact Page',
                'sections' => [
                    'contact-hero' => [
                        'name' => 'Contact Hero',
                        'description' => 'Contact page hero',
                        'partial' => 'contact-section.hero',
                    ],
                    'contact-main' => [
                        'name' => 'Contact Info & Map',
                        'description' => 'Contact information with map',
                        'partial' => 'contact-section.contact',
                    ],
                ]
            ],
        ];
    }

    /**
     * Get section template by type
     */
    protected function getSectionTemplate($type)
    {
        $library = $this->getSectionLibrary();

        foreach ($library as $category) {
            if (isset($category['sections'][$type])) {
                return $category['sections'][$type];
            }
        }

        return null;
    }

    /**
     * Generate unique slug
     */
    protected function generateUniqueSlug($baseSlug)
    {
        $slug = $baseSlug;
        $counter = 1;
        $existingPages = $this->getAllPages();

        while (true) {
            $exists = false;
            foreach ($existingPages as $page) {
                if ($page['slug'] === $slug) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                break;
            }

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
