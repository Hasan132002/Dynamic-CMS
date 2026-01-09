<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MediaLibraryController extends Controller
{
    public function index()
    {
        $media = $this->getMediaFiles();
        return view('admin.media-library', compact('media'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:jpg,jpeg,png,gif,svg,webp,mp4,pdf|max:10240'
        ]);

        $uploadedCount = 0;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads', 'public');
                $uploadedCount++;
            }
        }

        return redirect()->back()->with('success', "{$uploadedCount} file(s) uploaded successfully!");
    }

    public function delete(Request $request)
    {
        $path = $request->input('path');

        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'File not found']);
    }

    protected function getMediaFiles()
    {
        $media = [];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'mp4', 'pdf', 'ico'];

        // Scan storage/app/public/uploads
        $uploadPath = storage_path('app/public/uploads');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }
        $media = array_merge($media, $this->scanDirectory($uploadPath, 'storage/uploads', $allowedExtensions));

        // Scan storage/app/public/logos
        $logosPath = storage_path('app/public/logos');
        if (File::isDirectory($logosPath)) {
            $media = array_merge($media, $this->scanDirectory($logosPath, 'storage/logos', $allowedExtensions));
        }

        // Scan public/assets/img folder
        $assetsImgPath = public_path('assets/img');
        if (File::isDirectory($assetsImgPath)) {
            $media = array_merge($media, $this->scanDirectory($assetsImgPath, 'assets/img', $allowedExtensions));
        }

        // Scan public/assets/images folder
        $assetsImagesPath = public_path('assets/images');
        if (File::isDirectory($assetsImagesPath)) {
            $media = array_merge($media, $this->scanDirectory($assetsImagesPath, 'assets/images', $allowedExtensions));
        }

        // Sort by modified date (newest first)
        usort($media, function($a, $b) {
            return strtotime($b['modified']) - strtotime($a['modified']);
        });

        return $media;
    }

    protected function scanDirectory($directory, $urlPrefix, $allowedExtensions)
    {
        $media = [];

        if (!File::isDirectory($directory)) {
            return $media;
        }

        $files = File::allFiles($directory);

        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            if (!in_array($extension, $allowedExtensions)) {
                continue;
            }

            $relativePath = str_replace($directory . DIRECTORY_SEPARATOR, '', $file->getPathname());
            $relativePath = str_replace('\\', '/', $relativePath);

            $media[] = [
                'name' => $file->getFilename(),
                'path' => $urlPrefix . '/' . $relativePath,
                'url' => asset($urlPrefix . '/' . $relativePath),
                'size' => $this->formatBytes($file->getSize()),
                'type' => $extension,
                'modified' => date('Y-m-d H:i', $file->getMTime()),
                'folder' => dirname($urlPrefix . '/' . $relativePath),
            ];
        }

        return $media;
    }

    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes / pow(1024, $pow), $precision) . ' ' . $units[$pow];
    }
}
