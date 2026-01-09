<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    protected $seoPath;

    public function __construct()
    {
        $this->seoPath = storage_path('app/content/global-json/global-seo.json');
    }

    public function index()
    {
        $seo = $this->loadSeo();
        return view('admin.seo', compact('seo'));
    }

    public function update(Request $request)
    {
        $seo = [
            'global' => [
                'title_suffix' => $request->input('title_suffix', ''),
                'meta_description' => $request->input('meta_description', ''),
                'meta_keywords' => $request->input('meta_keywords', ''),
                'og_image' => $request->input('og_image', ''),
            ],
            'robots' => [
                'index' => $request->has('robots_index'),
                'follow' => $request->has('robots_follow'),
            ],
            'verification' => [
                'google' => $request->input('google_verification', ''),
                'bing' => $request->input('bing_verification', ''),
            ],
            'analytics' => [
                'google_analytics' => $request->input('google_analytics', ''),
                'facebook_pixel' => $request->input('facebook_pixel', ''),
            ],
        ];

        $this->saveSeo($seo);

        return redirect()->back()->with('success', 'SEO settings saved successfully!');
    }

    protected function loadSeo()
    {
        if (file_exists($this->seoPath)) {
            return json_decode(file_get_contents($this->seoPath), true) ?? [];
        }
        return [];
    }

    protected function saveSeo($seo)
    {
        $dir = dirname($this->seoPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents(
            $this->seoPath,
            json_encode($seo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }
}
