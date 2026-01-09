<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Services\ThemeService;

class CustomPageController extends BasePageController
{
    protected ThemeService $themeService;
    protected $pagesPath = 'content/custom-pages';

    public function __construct()
    {
        $this->themeService = new ThemeService();
    }

    /**
     * Show custom page by slug
     */
    public function show($slug)
    {
        $page = $this->getPageBySlug($slug);

        if (!$page) {
            abort(404);
        }

        // Check if page is published
        if (($page['status'] ?? 'draft') !== 'published') {
            abort(404);
        }

        // Load global data
        $globals = $this->loadGlobals();
        $theme = $this->themeService->getActiveTheme();

        // Prepare sections for rendering
        $sections = $page['sections'] ?? [];

        // Extract global contact for header/footer
        $globalContact = $globals['text']['contact'] ?? [];

        return view('pages.custom-page', [
            'page' => $page,
            'sections' => $sections,
            'page_title' => $page['meta']['title'] ?? $page['title'],
            'page_meta' => [
                'title' => $page['meta']['title'] ?? $page['title'],
                'description' => $page['meta']['description'] ?? '',
            ],
            'template' => $page['template'] ?? 'default',
            'theme' => $theme,
            'seo' => $globals['seo'] ?? [],
            'header' => $this->buildHeader($globals),
            'footer' => $this->buildFooter($globals),
            // Additional required data for headers/footers
            'fonts' => $globals['fonts'] ?? [],
            'colors' => $globals['colors'] ?? [],
            'logos' => $globals['logos'] ?? [],
            'globalContact' => $globalContact,
            'themeVersions' => $globals['themeVersions'] ?? [],
            'themeAssets' => $globals['themeAssets'] ?? [],
        ]);
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
     * Build header data from globals
     */
    protected function buildHeader($globals)
    {
        $globalHeader = $globals['navigation']['header'] ?? [];
        $globalHeaderText = $globals['text']['header'] ?? [];
        $globalContact = $globals['text']['contact'] ?? [];

        $header = [];

        // Menu
        if (!empty($globalHeader['menu'])) {
            $header['menu'] = $globalHeader['menu'];
        }

        // Category
        if (!empty($globalHeader['category'])) {
            $header['category'] = $globalHeader['category'];
        }

        // Top bar
        if (!empty($globalHeaderText['top'])) {
            $header['top'] = $globalHeaderText['top'];
        }

        // Contact info
        if (!empty($globalContact)) {
            $header['contact'] = [
                'phone' => [
                    'label' => $globalContact['labels']['phone'] ?? 'Call',
                    'value' => $globalContact['phone']['secondary'] ?? '',
                    'icon' => $globalContact['icons']['phone'] ?? ''
                ],
                'email' => [
                    'label' => $globalContact['labels']['email'] ?? 'Email',
                    'value' => $globalContact['email']['support'] ?? '',
                    'icon' => $globalContact['icons']['email'] ?? ''
                ]
            ];
        }

        // Side header
        if (!empty($globalHeaderText['side'])) {
            $header['side'] = $globalHeaderText['side'];
        }

        if (!empty($globalContact)) {
            $header['side'] = $header['side'] ?? [];
            $header['side']['contact'] = [
                'title' => $globalContact['labels']['contact_title'] ?? 'Contact Us',
                'phone' => $globalContact['phone']['primary'] ?? '',
                'phone_link' => $globalContact['phone']['primary_link'] ?? '',
                'email' => $globalContact['email']['primary'] ?? '',
                'address' => $globalContact['address']['primary_html'] ?? ''
            ];
            $header['side']['social'] = [
                'title' => $globalContact['labels']['follow_us'] ?? 'Follow Us',
                'links' => $globalContact['socials'] ?? []
            ];
        }

        // Buttons
        if (!empty($globalHeaderText['buttons'])) {
            $header['buttons'] = $globalHeaderText['buttons'];
        }

        if (!empty($globalHeaderText['cta_button'])) {
            $header['cta_button'] = $globalHeaderText['cta_button'];
        }

        return $header;
    }

    /**
     * Build footer data from globals
     */
    protected function buildFooter($globals)
    {
        $globalFooterNav = $globals['navigation']['footer'] ?? [];
        $globalFooterText = $globals['text']['footer'] ?? [];
        $globalContact = $globals['text']['contact'] ?? [];

        $footer = [];

        // Navigation
        foreach (['navigate', 'courses', 'bottom'] as $key) {
            if (!empty($globalFooterNav[$key])) {
                $footer[$key] = $globalFooterNav[$key];
            }
        }

        // About section
        if (!empty($globalContact)) {
            $footer['about'] = [
                'text' => $globalFooterText['about']['text'] ?? '',
                'phone' => $globalContact['phone']['primary'] ?? '',
                'phone_link' => $globalContact['phone']['primary_link'] ?? '',
                'email' => $globalContact['email']['primary'] ?? '',
                'address' => $globalContact['address']['primary_html'] ?? '',
                'socials' => $globalContact['socials'] ?? []
            ];
        }

        // Subscribe
        if (!empty($globalFooterText['subscribe'])) {
            $footer['subscribe'] = $globalFooterText['subscribe'];
        }

        // Bottom
        if (!empty($globalFooterText['bottom'])) {
            $footer['bottom'] = array_merge($footer['bottom'] ?? [], $globalFooterText['bottom']);
        }

        return $footer;
    }
}
