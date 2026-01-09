<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('global_pages', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('route_uri')->unique(); // /about, /contact etc.

            $table->string('controller')->nullable(); // AboutController
            $table->string('method')->nullable();     // index
            $table->string('route_name')->nullable(); // optional if you want
            $table->boolean('is_dynamic')->default(false);

            $table->boolean('in_menu')->default(false);
            $table->boolean('is_active')->default(false);

            // if menu JSON has a URL that does not exist in routes list
            $table->boolean('is_missing_route')->default(false);

            $table->integer('menu_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_pages');
    }
};
