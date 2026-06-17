<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create artisans table - Store individual craftsperson information
     * Each artisan has their own story, specialty, and photo
     */
    public function up(): void
    {
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            
            // Basic Info
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('specialty')->nullable(); // "Leather work", "Pattern design", "Finishing"
            $table->integer('years_experience')->nullable(); // How long they've been crafting
            
            // Storytelling
            $table->text('bio')->nullable(); // Personal artisan story
            $table->longText('philosophy')->nullable(); // Their craftsmanship philosophy
            $table->text('signature_style')->nullable(); // What makes their work unique
            
            // Qualifications & Recognition
            $table->json('certifications')->nullable(); // Array of certifications
            $table->json('awards')->nullable(); // Array: ["Award Name (Year)", ...]
            $table->text('achievements')->nullable(); // Free-form achievements text
            
            // Multimedia
            $table->string('photo')->nullable(); // Artisan headshot
            $table->string('action_photo')->nullable(); // Artisan at work (hero image)
            
            // Social & Contact
            $table->string('instagram_handle')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            
            // Product Association
            $table->json('specialty_products')->nullable(); // JSON array of product IDs they specialize in
            
            // Featured
            $table->boolean('is_featured')->default(false); // Show on homepage
            $table->integer('display_order')->default(999); // Sort order
            
            $table->timestamps();
            
            // Indexes
            $table->index('brand_id');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artisans');
    }
};
