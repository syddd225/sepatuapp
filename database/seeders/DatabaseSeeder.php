<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Masukkan data ke tabel categories
        DB::table('categories')->insert([
            [
                'id' => 1, 
                'name' => 'Formal', 
                'slug' => 'formal', 
                'description' => 'Sepatu formal elegan untuk acara resmi', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 2, 
                'name' => 'Casual', 
                'slug' => 'casual', 
                'description' => 'Sepatu kasual nyaman untuk sehari-hari', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 3, 
                'name' => 'Boots', 
                'slug' => 'boots', 
                'description' => 'Sepatu boots stylish dan tahan lama', 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);

        // 2. Masukkan data ke tabel products
        DB::table('products')->insert([
            [
                'id' => 2, 
                'name' => 'Retro Oxford Dark Brown', 
                'description' => 'Sepatu formal coklat tua dengan desain clean, nyaman untuk penggunaan harian.', 
                'price' => 320000.00, 
                'image' => 'formalcoklattua.jpeg', 
                'category_id' => 1, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 3, 
                'name' => 'Retro Oxford Black', 
                'description' => 'Sepatu formal hitam dengan tampilan rapi dan sederhana, cocok untuk acara formal.', 
                'price' => 330000.00, 
                'image' => 'formalhitam.jpeg', 
                'category_id' => 1, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 4, 
                'name' => 'Retro Oxford Black Gloss', 
                'description' => 'Sepatu formal hitam dengan finishing mengkilap, cocok untuk acara resmi.', 
                'price' => 340000.00, 
                'image' => 'formalhitam2.jpeg', 
                'category_id' => 1, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 5, 
                'name' => 'Retro Derby Brown', 
                'description' => 'Sepatu formal coklat dengan desain santai, cocok untuk semi formal.', 
                'price' => 300000.00, 
                'image' => 'sepatuformalcoklat.jpeg', 
                'category_id' => 1, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 6, 
                'name' => 'Retro Suede Brown', 
                'description' => 'Sepatu kasual berbahan suede coklat muda dengan sol tebal, cocok untuk gaya santai natural.', 
                'price' => 250000.00, 
                'image' => 'casual1.jpeg', 
                'category_id' => 2, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 7, 
                'name' => 'Retro Grey Perforated', 
                'description' => 'Sepatu kasual abu-abu dengan detail perforasi, memberikan sirkulasi udara dan nyaman dipakai lama.', 
                'price' => 290000.00, 
                'image' => 'casual2.jpeg', 
                'category_id' => 2, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 8, 
                'name' => 'Retro Cream Lace', 
                'description' => 'Sepatu kasual warna cream dengan desain lace-up dan sol tebal, tampil clean dan modern.', 
                'price' => 180000.00, 
                'image' => 'casual3.jpeg', 
                'category_id' => 2, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 9, 
                'name' => 'Retro Olive Casual', 
                'description' => 'Sneakers warna olive dengan desain minimalis dan sol putih, cocok untuk gaya santai modern.', 
                'price' => 270000.00, 
                'image' => 'casual4.jpeg', 
                'category_id' => 2, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 10, 
                'name' => 'Retro Boots Brown Lace', 
                'description' => 'Boots coklat dengan tali penuh dan sol tebal, cocok untuk aktivitas outdoor.', 
                'price' => 350000.00, 
                'image' => 'bootscoklattali.jpeg', 
                'category_id' => 3, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 11, 
                'name' => 'Retro Boots Black Lace', 
                'description' => 'Boots hitam bertali dengan desain kokoh, cocok untuk penggunaan aktif.', 
                'price' => 340000.00, 
                'image' => 'bootshitamtali.jpeg', 
                'category_id' => 3, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 12, 
                'name' => 'Retro Boots White Heel', 
                'description' => 'Boots putih dengan desain modern dan hak, cocok untuk gaya fashion.', 
                'price' => 300000.00, 
                'image' => 'bootsputih.jpeg', 
                'category_id' => 3, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id' => 13, 
                'name' => 'Retro Boots Black Zip', 
                'description' => 'Boots hitam tanpa tali dengan resleting samping, tampilan clean dan minimal.', 
                'price' => 330000.00, 
                'image' => 'bootshitamfull.jpeg', 
                'category_id' => 3, 
                'stock' => 0, 
                'created_at' => now(), 
                'updated_at' => now()
            ],
        ]);
    }
}