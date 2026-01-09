<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class BrandResolver
{
    public static function resolve(): string
    {
        // 1️⃣ Explicit admin selection (session)
        if (session()->has('active_brand')) {
            return session('active_brand');
        }

        // 2️⃣ Domain based (future ready)
        $host = Request::getHost();

        $brand = DB::table('brands')
            ->where('domain', $host)
            ->where('is_active', 1)
            ->first();

        if ($brand) {
            return $brand->key;
        }

        // 3️⃣ Default fallback
        $default = DB::table('brands')
            ->where('is_default', 1)
            ->where('is_active', 1)
            ->first();

        return $default->key ?? 'default';
    }
}
