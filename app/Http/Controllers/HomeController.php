<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class HomeController extends BasePageController
{
    protected function mapHeaderV1Menus(array $globalHeader): array
    {
        $header = [];

        // Use single unified menu variable
        $header['menu'] = $globalHeader['menu'] ?? [];

        return $header;
    }

    protected function buildView(string $view, string $jsonPath)
    {
        $globals = $this->loadGlobals();
        $content = json_decode(Storage::get($jsonPath), true) ?? [];

        $content['header'] = $content['header'] ?? [];
        $content['footer'] = $content['footer'] ?? [];

        $globalHeader = $globals['navigation']['header'] ?? [];
        $globalHeaderText = $globals['text']['header'] ?? [];
        $globalContact = $globals['text']['contact'] ?? [];

        if (str_contains($view, '.v1')) {
            $content['header'] = array_merge(
                $content['header'],
                $this->mapHeaderV1Menus($globalHeader)
            );
            // Add socials for header-v1
            if (!empty($globalContact['socials'])) {
                $content['header']['socials'] = $globalContact['socials'];
            }
        } else {
            if (!empty($globalHeader['menu'])) {
                $content['header']['menu'] = $globalHeader['menu'];
            }
        }

        if (!empty($globalHeader['category'])) {
            $content['header']['category'] = $globalHeader['category'];
        }

        if (!empty($globalHeaderText['top'])) {
            $content['header']['top'] = $globalHeaderText['top'];
        }

        // Build header contact from global contact
        if (!empty($globalContact)) {
            $content['header']['contact'] = [
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

        // Initialize side header from global text if available
        if (!empty($globalHeaderText['side'])) {
            $content['header']['side'] = $globalHeaderText['side'];
        }

        // Always merge global contact into side header
        if (!empty($globalContact)) {
            $content['header']['side'] = $content['header']['side'] ?? [];
            $content['header']['side']['contact'] = [
                'title' => $globalContact['labels']['contact_title'] ?? 'Contact Us',
                'phone' => $globalContact['phone']['primary'] ?? '',
                'phone_link' => $globalContact['phone']['primary_link'] ?? '',
                'email' => $globalContact['email']['primary'] ?? '',
                'address' => $globalContact['address']['primary_html'] ?? ''
            ];
            $content['header']['side']['social'] = [
                'title' => $globalContact['labels']['follow_us'] ?? 'Follow Us',
                'links' => $globalContact['socials'] ?? []
            ];
        }

        if (!empty($globalHeaderText['buttons'])) {
            $content['header']['buttons'] = $globalHeaderText['buttons'];
        }

        // Add CTA button from global text
        if (!empty($globalHeaderText['cta_button'])) {
            $content['header']['cta_button'] = $globalHeaderText['cta_button'];
        }

        $globalFooterNav = $globals['navigation']['footer'] ?? [];
        foreach (['navigate', 'courses', 'bottom'] as $key) {
            if (!empty($globalFooterNav[$key])) {
                $content['footer'][$key] = $globalFooterNav[$key];
            }
        }

        $globalFooterText = $globals['text']['footer'] ?? [];

        // Build footer about from global contact
        if (!empty($globalContact)) {
            $content['footer']['about'] = array_merge($content['footer']['about'] ?? [], [
                'text' => $globalFooterText['about']['text'] ?? ($content['footer']['about']['text'] ?? ''),
                'phone' => $globalContact['phone']['primary'] ?? '',
                'phone_link' => $globalContact['phone']['primary_link'] ?? '',
                'email' => $globalContact['email']['primary'] ?? '',
                'address' => $globalContact['address']['primary_html'] ?? '',
                'socials' => $globalContact['socials'] ?? []
            ]);
        }

        // Merge other footer text
        foreach (['subscribe', 'bottom'] as $key) {
            if (!empty($globalFooterText[$key])) {
                $content['footer'][$key] = array_merge(
                    $content['footer'][$key] ?? [],
                    $globalFooterText[$key]
                );
            }
        }

        if (
            empty($content['footer']['subscribe']['socials']) &&
            !empty($content['footer']['about']['socials'])
        ) {
            $content['footer']['subscribe']['socials'] = $content['footer']['about']['socials'];
        }

        return view($view, array_merge($content, $globals, ['globalContact' => $globalContact]));
    }

    public function homeV1() { return $this->buildView('pages.homes.v1', 'content/home-v1.json'); }
    public function homeV2() { return $this->buildView('pages.homes.v2', 'content/home-v2.json'); }
    public function homeV3() { return $this->buildView('pages.homes.v3', 'content/home-v3.json'); }
    public function homeV4() { return $this->buildView('pages.homes.v4', 'content/home-v4.json'); }
    public function homeV5() { return $this->buildView('pages.homes.v5', 'content/home-v5.json'); }
    public function homeV6() { return $this->buildView('pages.homes.v6', 'content/home-v6.json'); }
    public function homeV7() { return $this->buildView('pages.homes.v7', 'content/home-v7.json'); }
    public function homeV8() { return $this->buildView('pages.homes.v8', 'content/home-v8.json'); }
}
