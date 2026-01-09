<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DegreeController extends BasePageController
{
    public function show($degreeType, $slug)
    {
        $globals = $this->loadGlobals();

        // Load degree data
        $degreeData = json_decode(Storage::get('content/pages/degree.json'), true) ?? [];

        // Find the specific program by slug
        $program = null;
        foreach ($degreeData['programs'] as $p) {
            if ($p['slug'] === $slug) {
                $program = $p;
                break;
            }
        }

        // If program not found, abort
        if (!$program) {
            abort(404);
        }

        // Load home data for header/footer
        $homeV3 = json_decode(Storage::get('content/home-v3.json'), true) ?? [];
        $homeV1 = json_decode(Storage::get('content/home-v1.json'), true) ?? [];

        $header = $homeV3['header'] ?? [];

        if (!empty($globals['navigation']['header']['menu'])) {
            $header['menu'] = $globals['navigation']['header']['menu'];
        }

        if (!empty($globals['navigation']['header']['category'])) {
            $header['category'] = $globals['navigation']['header']['category'];
        }

        $globalHeaderText = $globals['text']['header'] ?? [];
        $globalContact = $globals['text']['contact'] ?? [];

        if (!empty($globalHeaderText['top'])) {
            $header['top'] = $globalHeaderText['top'];
        }

        // Build header contact from global contact
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

        // Initialize side header
        if (!empty($globalHeaderText['side'])) {
            $header['side'] = $globalHeaderText['side'];
        }

        // Always merge global contact into side header
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

        if (!empty($globalHeaderText['buttons'])) {
            $header['buttons'] = $globalHeaderText['buttons'];
        }

        $footer = $homeV1['footer'] ?? [];

        if (!empty($globals['navigation']['footer'])) {
            foreach (['navigate', 'courses', 'bottom'] as $key) {
                if (!empty($globals['navigation']['footer'][$key])) {
                    $footer[$key] = $globals['navigation']['footer'][$key];
                }
            }
        }

        $globalFooterText = $globals['text']['footer'] ?? [];

        // Build footer about from global contact
        if (!empty($globalContact)) {
            $footer['about'] = array_merge($footer['about'] ?? [], [
                'text' => $globalFooterText['about']['text'] ?? ($footer['about']['text'] ?? ''),
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
                $footer[$key] = array_merge($footer[$key] ?? [], $globalFooterText[$key]);
            }
        }

        return view('pages.degree', [
            'fonts'  => $globals['fonts'],
            'colors' => $globals['colors'],
            'logos'  => $globals['logos'],
            'header' => $header,
            'footer' => $footer,
            'globalContact' => $globalContact,
            'program' => $program,
            'sidebar' => $degreeData['sidebar'] ?? [],
        ]);
    }
}
