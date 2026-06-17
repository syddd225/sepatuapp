<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create brands table - Store company/brand information
     * Allows for multiple brands if scaled later
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // "Retro Collection", "Sepatu Retro", etc.
            $table->string('slug')->unique();
            
            // Brand Story & Identity
            $table->text('tagline')->nullable(); // Short brand promise
            $table->longText('story')->nullable(); // Full brand origin story
            $table->longText('mission')->nullable(); // Why we make shoes
            $table->longText('vision')->nullable(); // Where we're going
            $table->longText('values')->nullable(); // JSON array: craftsmanship, quality, heritage
            
            // Founder/Founder Story
            $table->string('founder_name')->nullable();
            $table->text('founder_bio')->nullable();
            $table->string('founder_image')->nullable(); // Photo path
            
            // Brand Details
            $table->year('founded_year')->nullable();
            $table->string('location')->nullable(); // City/Region
            $table->text('sustainability_note')->nullable(); // Environmental commitments
            $table->string('phone')->nullable(); // For contact
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            
            // Social Media
            $table->json('social_links')->nullable(); // { "instagram": "...", "tiktok": "...", "whatsapp": "..." }
            
            // SEO & Meta
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            
            // Logo & Branding
            $table->string('logo_path')->nullable();
            $table->string('hero_image')->nullable(); // Large background image for about page
            
            // Status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
