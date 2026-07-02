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
        Schema::table('orders', function (Blueprint $table) {
            // Ini perintah untuk menambah kolom 'status' dengan pilihan isi tertentu
            $table->enum('status', ['siap_kirim', 'sudah_sampai'])->default('siap_kirim');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Ini perintah untuk menghapus kembali kolom 'status' jika migration di-rollback
            $table->dropColumn('status');
        });
    }
};