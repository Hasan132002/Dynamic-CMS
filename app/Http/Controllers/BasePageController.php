<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Services\NavigationResolver;
use App\Services\BrandResolver;

abstract class BasePageController extends Controller
{
    /**
     * Load all global JSONs (single source of truth)
     */
    protected function loadGlobals(): array
    {
        $basePath = storage_path('app/content/global-json/');

        $globals = [
            'fonts'         => json_decode(@file_get_contents($basePath . 'global-fonts.json'), true) ?? [],
            'colors'        => json_decode(@file_get_contents($basePath . 'global-colors.json'), true) ?? [],
            'logos'         => json_decode(@file_get_contents($basePath . 'global-logos.json'), true) ?? [],
            'navigation'    => json_decode(@file_get_contents($basePath . 'global-navigation.json'), true) ?? [],
            'text'          => json_decode(@file_get_contents($basePath . 'global-text.json'), true) ?? [],
            'global_images' => json_decode(@file_get_contents($basePath . 'global-images.json'), true) ?? [],
        ];

        // 🔑 PHASE-04 CORE: DB-based navigation filtering
        if (!empty($globals['navigation'])) {
            $globals['navigation'] =
                NavigationResolver::resolve($globals['navigation']);
        }

        return $globals;
    }

    /**
     * Check if a section is visible
     */
    protected function isSectionVisible(array $section): bool
    {
        // If section has 'visible' key, check it
        if (isset($section['visible'])) {
            return $section['visible'] === true;
        }

        // Default to visible if not specified
        return true;
    }

    /**
     * Get section data (unwrap if wrapped with visible property)
     */
    protected function getSectionData(array $section): array
    {
        // If section is wrapped with 'data' key, return that
        if (isset($section['data']) && is_array($section['data'])) {
            return $section['data'];
        }

        // Otherwise return the section as-is (but remove 'visible' key if present)
        $data = $section;
        unset($data['visible']);
        return $data;
    }

    /**
     * Render any page with global + page JSON merged
     */
    protected function renderPage(string $view, string $contentPath)
    {
        $globals = $this->loadGlobals();
        $pageContent = json_decode(Storage::get($contentPath), true) ?? [];

        // Header base comes from page JSON (version-specific)
        $header = $pageContent['header'] ?? [];

        // Inject navigation (already filtered)
        if (!empty($globals['navigation']['header'])) {
            $header = array_merge(
                $header,
                $globals['navigation']['header']
            );
        }

        // Header text + contact
        $globalHeaderText = $globals['text']['header'] ?? [];
        $globalContact    = $globals['text']['contact'] ?? [];

        if (!empty($globalHeaderText['cta_button'])) {
            $header['cta_button'] = $globalHeaderText['cta_button'];
        }

        if (!empty($globalHeaderText['side'])) {
            $header['side'] = $globalHeaderText['side'];
        }

        if (!empty($globalContact)) {
            $header['contact'] = [
                'phone' => [
                    'label' => $globalContact['labels']['phone'] ?? 'Call',
                    'value' => $globalContact['phone']['secondary'] ?? '',
                    'icon'  => $globalContact['icons']['phone'] ?? '',
                ],
                'email' => [
                    'label' => $globalContact['labels']['email'] ?? 'Email',
                    'value' => $globalContact['email']['support'] ?? '',
                    'icon'  => $globalContact['icons']['email'] ?? '',
                ],
            ];

            $header['side']['contact'] = [
                'title'      => $globalContact['labels']['contact_title'] ?? 'Contact Us',
                'phone'      => $globalContact['phone']['primary'] ?? '',
                'phone_link'=> $globalContact['phone']['primary_link'] ?? '',
                'email'      => $globalContact['email']['primary'] ?? '',
                'address'    => $globalContact['address']['primary_html'] ?? '',
            ];

            $header['side']['social'] = [
                'title' => $globalContact['labels']['follow_us'] ?? 'Follow Us',
                'links' => $globalContact['socials'] ?? [],
            ];
        }

        // Footer
        $footer = $pageContent['footer'] ?? [];

        if (!empty($globals['navigation']['footer'])) {
            foreach (['navigate', 'courses', 'bottom'] as $key) {
                if (!empty($globals['navigation']['footer'][$key])) {
                    $footer[$key] = $globals['navigation']['footer'][$key];
                }
            }
        }

        $globalFooterText = $globals['text']['footer'] ?? [];

        if (!empty($globalContact)) {
            $footer['about'] = array_merge($footer['about'] ?? [], [
                'text'        => $globalFooterText['about']['text'] ?? '',
                'phone'       => $globalContact['phone']['primary'] ?? '',
                'phone_link'  => $globalContact['phone']['primary_link'] ?? '',
                'email'       => $globalContact['email']['primary'] ?? '',
                'address'     => $globalContact['address']['primary_html'] ?? '',
                'socials'     => $globalContact['socials'] ?? [],
            ]);
        }

        foreach (['subscribe', 'bottom'] as $key) {
            if (!empty($globalFooterText[$key])) {
                $footer[$key] = array_merge(
                    $footer[$key] ?? [],
                    $globalFooterText[$key]
                );
            }
        }

        // Store original visibility states before unwrapping
        $sectionVisibility = [];
        foreach ($pageContent as $key => $value) {
            if (is_array($value) && isset($value['visible'])) {
                $sectionVisibility[$key] = $value['visible'];
            }
        }

        // Unwrap all sections automatically so templates get clean data
        foreach ($pageContent as $key => $value) {
            if (is_array($value) && !in_array($key, ['header', 'footer', 'page_title', 'page_meta', 'page_description'])) {
                $pageContent[$key] = $this->getSectionData($value);
                // Add visibility flag back as a meta key
                if (isset($sectionVisibility[$key])) {
                    $pageContent[$key]['__visible'] = $sectionVisibility[$key];
                }
            }
        }

        return view($view, array_merge(
            [
                'fonts'         => $globals['fonts'],
                'colors'        => $globals['colors'],
                'logos'         => $globals['logos'],
                'global_images' => $globals['global_images'],
                'globalContact' => $globalContact,
                'header'        => $header,
                'footer'        => $footer,
            ],
            $pageContent
        ));
    }


}
