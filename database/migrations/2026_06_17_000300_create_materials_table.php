<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Create materials table - Store information about materials used
     * Tells the story of sourcing, quality, and sustainability
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            
            // Material Identity
            $table->string('name')->unique(); // "Kulit Asli Premium", "Kanvas Organik", etc.
            $table->string('slug')->unique();
            $table->string('category')->nullable(); // "Leather", "Canvas", "Sole", "Hardware"
            $table->string('color')->nullable(); // For display purposes
            
            // Technical Details
            $table->text('description')->nullable(); // What is it?
            $table->text('properties')->nullable(); // Durability, breathability, etc.
            $table->text('care_instructions')->nullable(); // How to maintain
            
            // Sourcing Story
            $table->text('origin')->nullable(); // Where it comes from
            $table->string('supplier_name')->nullable(); // Our trusted supplier
            $table->text('supplier_story')->nullable(); // Why we chose this supplier
            $table->string('supplier_country')->nullable(); // Indonesia, Italy, France, etc.
            
            // Sustainability & Ethics
            $table->boolean('is_sustainable')->default(false);
            $table->boolean('is_organic')->default(false);
            $table->boolean('is_locally_sourced')->default(false);
            $table->text('sustainability_note')->nullable(); // Environmental impact
            $table->text('ethical_statement')->nullable(); // Fair trade, worker rights, etc.
            
            // Quality Metrics
            $table->string('durability_rating')->nullable(); // "Excellent", "Very Good", etc. (5-year lifespan)
            $table->string('eco_rating')->nullable(); // "A+", "A", "B", etc.
            $table->text('longevity_story')->nullable(); // How long will shoes last?
            
            // Visual
            $table->string('image')->nullable(); // Close-up/texture image
            $table->string('icon')->nullable(); // SVG icon or emoji
            
            // Association
            $table->json('products_using_this')->nullable(); // Array of product IDs
            
            // Featured
            $table->boolean('is_featured')->default(false);
            
            $table->timestamps();
            
            // Indexes
            $table->index('brand_id');
            $table->index('category');
            $table->index('is_sustainable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
