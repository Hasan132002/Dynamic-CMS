<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action')->index(); // e.g., 'page_view', 'content_edit', 'theme_update', etc.
            $table->string('url')->nullable();
            $table->string('method')->default('GET'); // HTTP method
            $table->string('resource_type')->nullable()->index(); // e.g., 'page', 'theme', 'setting'
            $table->string('resource_id')->nullable(); // ID or slug of the resource
            $table->text('description')->nullable();
            $table->json('old_data')->nullable(); // Previous state for edits (for revert)
            $table->json('new_data')->nullable(); // New state after edit
            $table->json('changes')->nullable(); // Diff of changes
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // If user auth is implemented
            $table->boolean('is_revertible')->default(false);
            $table->boolean('is_reverted')->default(false);
            $table->unsignedBigInteger('reverted_by_log_id')->nullable(); // ID of the log that reverted this
            $table->timestamps();

            $table->index(['created_at']);
            $table->index(['action', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
