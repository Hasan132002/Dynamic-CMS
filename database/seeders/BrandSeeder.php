<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'name' => 'Default',
                'key' => 'default',
                'is_default' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'Educve',
                'key' => 'educve',
                'is_default' => 0,
                'is_active' => 1,
            ]
        ]);
    }
}
