<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('global_menu_items', function (Blueprint $table) {
            $table->id();

            // menu location: header.menu, header.menu_left, header.menu_right, header.category.items, footer.navigate.links etc.
            $table->string('location'); // e.g. header.menu

            $table->foreignId('parent_id')->nullable()->constrained('global_menu_items')->nullOnDelete();

            $table->string('label');
            $table->string('url'); // keep raw url from JSON
            $table->boolean('is_mega')->default(false);
            $table->enum('type', ['link', 'mega'])->default('link');
            $table->string('column_title')->nullable(); // for mega columns

            $table->integer('sort_order')->default(0);


            // mega columns support (store title/grouping)
            $table->string('group_title')->nullable(); // "Admissions", "Academics" etc.

            // page link mapping
            $table->foreignId('page_id')->nullable()->constrained('global_pages')->nullOnDelete();

            $table->integer('item_order')->default(0);

            $table->boolean('is_active')->default(true); // menu item enable/disable

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_menu_items');
    }
};
