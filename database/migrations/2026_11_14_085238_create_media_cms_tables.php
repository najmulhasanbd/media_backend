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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('talent'); // talent, video, gallery, article
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('hero_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('image')->nullable();
            $table->string('btn_text_1')->nullable();
            $table->string('btn_url_1')->nullable();
            $table->string('btn_text_2')->nullable();
            $table->string('btn_url_2')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('talents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->string('specialty')->nullable();
            $table->boolean('is_international')->default(false);
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('experience')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('audition_url')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->boolean('is_verified')->default(true);
            $table->boolean('is_featured')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('casting_calls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('project_type')->nullable(); // Cinema, Drama, OTT, TVC
            $table->string('roles')->nullable();
            $table->text('requirements')->nullable();
            $table->string('deadline')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->default('open'); // open, closed
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable(); // drama, cinema, tvc, music, ott
            $table->string('title');
            $table->string('director')->nullable();
            $table->string('client')->nullable();
            $table->string('duration')->nullable();
            $table->string('youtube_url');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable(); // photoshoot, shooting_set, event
            $table->string('title');
            $table->string('image');
            $table->text('caption')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('shooting_houses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('rent')->nullable();
            $table->string('contact')->nullable();
            $table->text('facilities')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('director'); // director, artist, opinion
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author_name');
            $table->string('author_role')->nullable();
            $table->string('author_image')->nullable();
            $table->string('image')->nullable();
            $table->longText('content');
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('date')->nullable();
            $table->text('description');
            $table->string('file')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->text('review');
            $table->integer('rating')->default(5);
            $table->string('photo')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('status')->default('pending'); // pending, shortlisted, approved, rejected
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('notices');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('shooting_houses');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('casting_calls');
        Schema::dropIfExists('talents');
        Schema::dropIfExists('hero_sliders');
        Schema::dropIfExists('categories');
    }
};
