<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected $settingsPath;

    public function __construct()
    {
        $this->settingsPath = storage_path('app/content/global-json/global-settings.json');
    }

    public function index()
    {
        $settings = $this->loadSettings();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = [
            'site' => [
                'name' => $request->input('site_name', 'EduCVE'),
                'tagline' => $request->input('site_tagline', ''),
                'email' => $request->input('site_email', ''),
                'phone' => $request->input('site_phone', ''),
                'address' => $request->input('site_address', ''),
            ],
            'social' => [
                'facebook' => $request->input('social_facebook', ''),
                'twitter' => $request->input('social_twitter', ''),
                'instagram' => $request->input('social_instagram', ''),
                'linkedin' => $request->input('social_linkedin', ''),
                'youtube' => $request->input('social_youtube', ''),
            ],
            'scripts' => [
                'header' => $request->input('header_scripts', ''),
                'footer' => $request->input('footer_scripts', ''),
            ],
        ];

        $this->saveSettings($settings);

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }

    protected function loadSettings()
    {
        if (file_exists($this->settingsPath)) {
            return json_decode(file_get_contents($this->settingsPath), true) ?? [];
        }
        return [];
    }

    protected function saveSettings($settings)
    {
        $dir = dirname($this->settingsPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents(
            $this->settingsPath,
            json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }
}
