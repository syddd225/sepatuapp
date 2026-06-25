<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create predefined shoe categories
        $categories = [
            [
                'name' => 'Formal',
                'slug' => 'formal',
                'description' => 'Sepatu formal elegan untuk acara resmi'
            ],
            [
                'name' => 'Casual',
                'slug' => 'casual',
                'description' => 'Sepatu kasual nyaman untuk sehari-hari'
            ],
            [
                'name' => 'Boots',
                'slug' => 'boots',
                'description' => 'Sepatu boots stylish dan tahan lama'
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $formalCategory = Category::where('slug', 'formal')->first();
        $casualCategory = Category::where('slug', 'casual')->first();
        $bootsCategory = Category::where('slug', 'boots')->first();

        if ($formalCategory) {
            $this->createFormalProducts($formalCategory);
        }
        if ($casualCategory) {
            $this->createCasualProducts($casualCategory);
        }
        if ($bootsCategory) {
            $this->createBootsProducts($bootsCategory);
        }
    }

    private function createFormalProducts(Category $category): void
    {
        $formalShoes = [
            ['name' => 'Retro Oxford Dark Brown', 'description' => 'Sepatu formal coklat tua dengan desain clean, nyaman untuk penggunaan harian.', 'price' => 320000.00, 'image' => 'sepatu-1.1.png', 'stock' => 5],
            ['name' => 'Retro Oxford Black', 'description' => 'Sepatu formal hitam dengan tampilan rapi dan sederhana, cocok untuk acara formal.', 'price' => 330000.00, 'image' => 'sepatu-2.1.png', 'stock' => 8],
            ['name' => 'Retro Derby Brown', 'description' => 'Sepatu formal coklat dengan desain santai, cocok untuk semi formal.', 'price' => 300000.00, 'image' => 'sepatu-3.2.png', 'stock' => 6],
            ['name' => 'Retro Brogue Heritage Tan', 'description' => 'Sepatu brogue bermotif perforasi wingtip klasik, memberikan kesan vintage Inggris yang sangat kuat.', 'price' => 355000.00, 'image' => 'formalcoklattua.jpeg', 'stock' => 7],
            ['name' => 'Retro Single Monk Strap Black', 'description' => 'Sepatu monk strap tunggal dengan buckle stainless steel, tampil maskulin dan elegan tanpa tali.', 'price' => 340000.00, 'image' => 'formalhitam2.jpeg', 'stock' => 4],
            ['name' => 'Retro Penny Loafer Mahogany', 'description' => 'Loafer kasual-formal tanpa tali dengan warna kayu mahoni yang anggun, mudah dipakai.', 'price' => 310000.00, 'image' => 'sepatuformalcoklat.jpeg', 'stock' => 10],
        ];

        foreach ($formalShoes as $shoe) {
            Product::firstOrCreate(['name' => $shoe['name']], array_merge($shoe, ['category_id' => $category->id]));
        }
    }

    private function createCasualProducts(Category $category): void
    {
        $casualShoes = [
            ['name' => 'Retro Suede Brown', 'description' => 'Sepatu kasual berbahan suede coklat muda dengan sol tebal, cocok untuk gaya santai natural.', 'price' => 250000.00, 'image' => 'casual1.jpeg', 'stock' => 12],
            ['name' => 'Retro Canvas White', 'description' => 'Sepatu kasual kanvas putih dengan desain minimalis, sempurna untuk pairing dengan berbagai outfit.', 'price' => 180000.00, 'image' => 'casual2.jpeg', 'stock' => 15],
            ['name' => 'Retro Slip-on Creamy', 'description' => 'Sepatu kasual model slip-on tanpa tali berwarna krem lembut dengan rajutan kanvas berpori.', 'price' => 195000.00, 'image' => 'casual3.jpeg', 'stock' => 14],
            ['name' => 'Retro Sneaker Vintage Olive', 'description' => 'Sneaker retro bernuansa hijau olive klasik dengan garis samping putih bergaya lawas.', 'price' => 270000.00, 'image' => 'casual4.jpeg', 'stock' => 9],
            ['name' => 'Retro Leather Deck Navy', 'description' => 'Sepatu kasual bertipe deck shoe / boat shoe dengan warna biru navy yang terbuat dari bahan nubuck leather lembut.', 'price' => 290000.00, 'image' => 'casual1.jpeg', 'stock' => 8],
            ['name' => 'Retro Canvas Sneaker Mustard', 'description' => 'Sneaker kanvas berwarna kuning mustard menyala, memberikan aksen ceria pada tampilan kasual Anda.', 'price' => 210000.00, 'image' => 'casual2.jpeg', 'stock' => 11],
        ];

        foreach ($casualShoes as $shoe) {
            Product::firstOrCreate(['name' => $shoe['name']], array_merge($shoe, ['category_id' => $category->id]));
        }
    }

    private function createBootsProducts(Category $category): void
    {
        $boots = [
            ['name' => 'Retro Combat Boots Black', 'description' => 'Sepatu boots combat bergaya retro dengan desain kokoh dan tahan lama, cocok untuk berbagai gaya.', 'price' => 450000.00, 'image' => 'bootshitamfull.jpeg', 'stock' => 4],
            ['name' => 'Retro Desert Boots Suede Tan', 'description' => 'Boots bertinggi pergelangan kaki dengan 3 lubang tali, menggunakan suede berwarna coklat gurun yang kasual.', 'price' => 360000.00, 'image' => 'bootscoklattali.jpeg', 'stock' => 6],
            ['name' => 'Retro Engineer Boots Dark Oak', 'description' => 'Boots tangguh bertali dengan resleting samping bertekstur kulit kayu ek tua, memancarkan kesan petualang tangguh.', 'price' => 480000.00, 'image' => 'bootshitamtali.jpeg', 'stock' => 5],
            ['name' => 'Retro Chelsea Boots Vintage White', 'description' => 'Chelsea boots bergaya mod era 60-an berwarna putih tulang dengan karet samping kontras hitam.', 'price' => 395000.00, 'image' => 'bootsputih.jpeg', 'stock' => 3],
            ['name' => 'Retro Moc Toe Work Boots Coffee', 'description' => 'Boots kerja dengan jahitan moccasin melengkung di ujung depan, bernuansa kopi robusta hangat.', 'price' => 430000.00, 'image' => 'bootscoklattali.jpeg', 'stock' => 8],
            ['name' => 'Retro Brogue Lace Boots Oxblood', 'description' => 'Boots formal tinggi bertali dengan detail ukiran brogue elegan, berwarna merah gelap oxblood.', 'price' => 460000.00, 'image' => 'bootshitamtali.jpeg', 'stock' => 4],
        ];

        foreach ($boots as $shoe) {
            Product::firstOrCreate(['name' => $shoe['name']], array_merge($shoe, ['category_id' => $category->id]));
        }
    }
}