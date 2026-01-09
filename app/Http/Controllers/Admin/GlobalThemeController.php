<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ThemeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GlobalThemeController extends Controller
{
    private $basePath = 'content/global-json/';

    /**
     * Display the appearance management page
     */
    public function index()
    {
        // Get active theme info
        $themeService = app(ThemeService::class);
        $activeTheme = $themeService->getActiveTheme();

        $data = [
            'colors' => $this->loadJson('global-colors.json'),
            'fonts' => $this->loadJson('global-fonts.json'),
            'logos' => $this->loadJson('global-logos.json'),
            'global_images' => $this->loadJson('global-images.json'),
            'text' => $this->loadJson('global-text.json'),
        ];

        return view('admin.appearance', compact('data', 'activeTheme'));
    }

    /**
     * Update appearance settings
     */
    public function update(Request $request)
    {
        $section = $request->input('section');

        try {
            switch ($section) {
                case 'colors':
                    $this->updateColors($request);
                    break;
                case 'fonts':
                    $this->updateFonts($request);
                    break;
                case 'logos':
                    $this->updateLogos($request);
                    break;
                case 'text':
                    $this->updateText($request);
                    break;
                default:
                    return back()->with('error', 'Invalid section');
            }

            return back()->with('success', ucfirst($section) . ' updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    /**
     * Update colors
     */
    private function updateColors(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'accent' => 'required|string',
            'heading' => 'required|string',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $colors = $this->loadJson('global-colors.json');

        // Update base colors
        $colors['base']['accent'] = $request->input('accent');
        $colors['base']['heading'] = $request->input('heading');
        $colors['base']['body'] = $request->input('body');

        $this->saveJson('global-colors.json', $colors);
    }

    /**
     * Update fonts
     */
    private function updateFonts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'primary_font' => 'required|string|max:100',
            'secondary_font' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $fonts = $this->loadJson('global-fonts.json');

        $fonts['default']['primary'] = $request->input('primary_font');
        $fonts['default']['secondary'] = $request->input('secondary_font');

        $this->saveJson('global-fonts.json', $fonts);
    }

    /**
     * Update logos
     */
    private function updateLogos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'header_logo' => 'nullable|string|max:255',
            'footer_logo' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $logos = $this->loadJson('global-logos.json');

        if ($request->filled('header_logo')) {
            $logos['header']['default'] = $request->input('header_logo');
        }

        if ($request->filled('footer_logo')) {
            $logos['footer']['default'] = $request->input('footer_logo');
        }

        $this->saveJson('global-logos.json', $logos);
    }

    /**
     * Update text/contact info
     */
    private function updateText(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_primary' => 'required|string|max:50',
            'email_primary' => 'required|email|max:100',
            'address_primary' => 'required|string|max:255',
            'cta_label' => 'required|string|max:50',
            'cta_url' => 'required|string|max:255',
            'footer_about_text' => 'required|string|max:500',
            'footer_copyright' => 'required|string|max:200',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        $text = $this->loadJson('global-text.json');

        // Update contact info
        $text['contact']['phone']['primary'] = $request->input('phone_primary');
        $text['contact']['phone']['primary_link'] = 'tel:' . preg_replace('/[^0-9+]/', '', $request->input('phone_primary'));
        $text['contact']['email']['primary'] = $request->input('email_primary');
        $text['contact']['address']['primary'] = $request->input('address_primary');
        $text['contact']['address']['primary_html'] = nl2br($request->input('address_primary'));

        // Update header CTA
        $text['header']['cta_button']['label'] = $request->input('cta_label');
        $text['header']['cta_button']['url'] = $request->input('cta_url');

        // Update footer
        $text['footer']['about']['text'] = $request->input('footer_about_text');
        $text['footer']['bottom']['copyright'] = $request->input('footer_copyright');

        $this->saveJson('global-text.json', $text);
    }

    /**
     * Load JSON file
     */
    private function loadJson($filename)
    {
        $path = $this->basePath . $filename;

        if (!Storage::exists($path)) {
            throw new \Exception("File not found: {$filename}");
        }

        $content = Storage::get($path);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Invalid JSON in {$filename}: " . json_last_error_msg());
        }

        return $data;
    }

    /**
     * Save JSON file with backup
     */
    private function saveJson($filename, $data)
    {
        $path = $this->basePath . $filename;

        // Create backup
        $this->createBackup($filename);

        // Save new data
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        Storage::put($path, $json);
    }

    /**
     * Create backup of JSON file
     */
    private function createBackup($filename)
    {
        $sourcePath = $this->basePath . $filename;
        $backupPath = 'content/global-json-backups/' . date('Y-m-d_His') . '_' . $filename;

        if (Storage::exists($sourcePath)) {
            $content = Storage::get($sourcePath);
            Storage::put($backupPath, $content);
        }
    }
}
