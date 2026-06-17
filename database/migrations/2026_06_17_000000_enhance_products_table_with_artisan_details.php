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
        Schema::table('products', function (Blueprint $table) {
            // Add fields for premium shoe showcase
            $table->json('materials')->nullable()->comment('JSON array of materials used');
            $table->text('philosophy')->nullable()->comment('Artisan philosophy and craftsmanship story');
            $table->json('images_angles')->nullable()->comment('JSON array of image filenames for multiple angles/views');
            $table->string('whatsapp_phone')->nullable()->comment('Product-specific WhatsApp number (overrides default)');
            
            // Index for better query performance
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['materials', 'philosophy', 'images_angles', 'whatsapp_phone']);
            $table->dropIndex(['category_id']);
        });
    }
};
