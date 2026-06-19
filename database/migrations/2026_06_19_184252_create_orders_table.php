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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('qty');
            $table->string('ukuran');
            $table->string('warna');
            $table->string('shipping_tier');
            $table->string('shipping_name');
            $table->decimal('base_delivery_fee', 12, 2);
            $table->decimal('shipping_tier_fee', 12, 2);
            $table->decimal('total_shipping_cost', 12, 2);
            $table->boolean('use_voucher')->default(false);
            $table->decimal('voucher_discount', 12, 2)->default(0);
            $table->string('payment_method');
            $table->decimal('grand_total', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
