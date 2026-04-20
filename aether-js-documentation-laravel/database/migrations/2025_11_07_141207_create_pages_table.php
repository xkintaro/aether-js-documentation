<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);

            $table->string('slug')->nullable();
            $table->boolean('is_homepage')->default(false);
            $table->boolean('menu_show')->default(true);
            $table->string('blade_name')->nullable();
            $table->string('menu_data_source')->nullable();

            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('icon')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('seo_text')->nullable();

            $table->timestamps();

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('pages')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
