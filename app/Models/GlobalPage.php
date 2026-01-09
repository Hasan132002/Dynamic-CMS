<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalPage extends Model
{
    protected $table = 'global_pages';

    protected $fillable = [
        'title',
        'slug',
        'route_uri',
        'controller',
        'method',
        'route_name',
        'is_dynamic',
        'in_menu',
        'is_active',
        'is_missing_route',
        'menu_order',
    ];
}
