<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalMenuItem extends Model
{
    protected $table = 'global_menu_items';

    protected $fillable = [
        'location',
        'parent_id',
        'label',
        'url',
        'is_mega',
        'group_title',
        'page_id',
        'item_order',
        'is_active',
    ];
}
