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
            ['name' => 'Retro Oxford Dark Brown', 'description' => 'Sepatu formal coklat tua dengan desain clean, nyaman untuk penggunaan harian.', 'price' => 320000.00, 'image' => 'formalcoklattua.jpeg', 'stock' => 5],
            ['name' => 'Retro Oxford Black', 'description' => 'Sepatu formal hitam dengan tampilan rapi dan sederhana, cocok untuk acara formal.', 'price' => 330000.00, 'image' => 'formalhitam.jpeg', 'stock' => 8],
            ['name' => 'Retro Derby Brown', 'description' => 'Sepatu formal coklat dengan desain santai, cocok untuk semi formal.', 'price' => 300000.00, 'image' => 'sepatuformalcoklat.jpeg', 'stock' => 6],
            ['name' => 'Retro Brogue Heritage Tan', 'description' => 'Sepatu brogue bermotif perforasi wingtip klasik, memberikan kesan vintage Inggris yang sangat kuat.', 'price' => 355000.00, 'image' => 'formalcoklattua.jpeg', 'stock' => 7],
            ['name' => 'Retro Single Monk Strap Black', 'description' => 'Sepatu monk strap tunggal dengan buckle stainless steel, tampil maskulin dan elegan tanpa tali.', 'price' => 340000.00, 'image' => 'formalhitam2.jpeg', 'stock' => 4],
            ['name' => 'Retro Penny Loafer Mahogany', 'description' => 'Loafer kasual-formal tanpa tali dengan warna kayu mahoni yang anggun, mudah dipakai.', 'price' => 310000.00, 'image' => 'sepatuformalcoklat.jpeg', 'stock' => 10],
            ['name' => 'Retro Wingtip Dress Shoe Black', 'description' => 'Sepatu gaun bermotif wingtip warna hitam mengkilap, cocok dipasangkan dengan tuxedo terbaik Anda.', 'price' => 365000.00, 'image' => 'formalhitam.jpeg', 'stock' => 5],
            ['name' => 'Retro Double Monk Strap Dark Cognac', 'description' => 'Double monk strap dengan warna cognac gelap dan aksen brass buckle, memikat pandangan dengan gaya dandy.', 'price' => 380000.00, 'image' => 'formalcoklattua.jpeg', 'stock' => 4],
            ['name' => 'Retro Tassel Loafer Vintage Ebony', 'description' => 'Loafer hitam pekat dengan gantungan tassel kulit di atasnya, perpaduan kasual kelas atas.', 'price' => 325000.00, 'image' => 'formalhitam2.jpeg', 'stock' => 6],
            ['name' => 'Retro Cap-toe Oxford Chocolate', 'description' => 'Oxford bertipe cap-toe lurus dengan jahitan presisi, sangat minimalis dan anggun.', 'price' => 335000.00, 'image' => 'sepatuformalcoklat.jpeg', 'stock' => 8],
            ['name' => 'Retro Kiltie Slip-On Oxblood', 'description' => 'Sepatu slip-on berumbai rumbai khas kiltie dengan warna merah marun oxblood yang dramatis.', 'price' => 345000.00, 'image' => 'formalhitam.jpeg', 'stock' => 3],
            ['name' => 'Retro Balmoral Dress Boots Black', 'description' => 'Boot dress bertipe Balmoral dengan penutup pergelangan kaki berbahan kanvas tebal dan bagian bawah kulit hitam.', 'price' => 390000.00, 'image' => 'formalhitam2.jpeg', 'stock' => 4],
            ['name' => 'Retro Plain-Toe Derby Walnut', 'description' => 'Sepatu Derby polos warna kayu walnut yang sangat fleksibel dipadukan dengan celana chino maupun jeans.', 'price' => 295000.00, 'image' => 'sepatuformalcoklat.jpeg', 'stock' => 12],
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
            ['name' => 'Retro Chelsea Casual Sand', 'description' => 'Chelsea boots dengan potongan kasual rendah berwarna pasir, mudah dikombinasikan dengan celana pendek.', 'price' => 310000.00, 'image' => 'casual3.jpeg', 'stock' => 7],
            ['name' => 'Retro High-Top Classic Black', 'description' => 'Sneaker kanvas bertinggi di atas mata kaki klasik berwarna hitam pekat, model legendaris sepanjang masa.', 'price' => 230000.00, 'image' => 'casual4.jpeg', 'stock' => 16],
            ['name' => 'Retro Espadrille Indigo Wash', 'description' => 'Sepatu kasual santai espadrille dengan rajutan tali rami melingkar pada sol bawah dan kain denim indigo wash.', 'price' => 185000.00, 'image' => 'casual1.jpeg', 'stock' => 20],
            ['name' => 'Retro Leather Trainer Burgundy', 'description' => 'Trainer bergaya olah raga lawas era 80-an dengan warna burgundy tua yang memukau.', 'price' => 280000.00, 'image' => 'casual2.jpeg', 'stock' => 9],
            ['name' => 'Retro Waffle Sole Sneaker Grey', 'description' => 'Sepatu lari vintage dengan sol bermotif waffle yang unik dan bobot yang sangat ringan.', 'price' => 240000.00, 'image' => 'casual3.jpeg', 'stock' => 13],
            ['name' => 'Retro Corduroy Slip-on Rust', 'description' => 'Slip-on kasual unik menggunakan bahan kain korduroi garis besar berwarna coklat karat kemerahan.', 'price' => 215000.00, 'image' => 'casual4.jpeg', 'stock' => 10],
            ['name' => 'Retro Knit Sneaker Charcoal', 'description' => 'Sneaker rajut dengan sirkulasi udara maksimal berwarna abu-abu arang, fleksibel untuk jalan-jalan santai.', 'price' => 225000.00, 'image' => 'casual1.jpeg', 'stock' => 14],
            ['name' => 'Retro Velvet Slipper Ruby', 'description' => 'Slipper kasual santai dari bahan bludru merah ruby halus dengan bordir inisial emas di atasnya.', 'price' => 260000.00, 'image' => 'casual2.jpeg', 'stock' => 5],
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
            ['name' => 'Retro Chukka Boots Mustard Suede', 'description' => 'Chukka boots kasual setinggi pergelangan kaki berbahan suede berwarna kuning mustard.', 'price' => 350000.00, 'image' => 'bootscoklattali.jpeg', 'stock' => 9],
            ['name' => 'Retro Monkey Boots Charcoal Black', 'description' => 'Boots klasik dengan tali sepatu yang sangat panjang hingga mendekati ujung jari kaki, memberikan tampilan vintage unik.', 'price' => 410000.00, 'image' => 'bootshitamfull.jpeg', 'stock' => 6],
            ['name' => 'Retro Duck Boots Navy Tan', 'description' => 'Boots tahan air bertipe duck boots dengan bagian bawah berlapis karet kedap air dan bagian atas kulit tan.', 'price' => 425000.00, 'image' => 'bootscoklattali.jpeg', 'stock' => 5],
            ['name' => 'Retro Hiking Boots Forest Green', 'description' => 'Boots gunung model vintage berbahan kombinasi suede hijau hutan dengan tali sepatu berwarna merah menyala.', 'price' => 445000.00, 'image' => 'bootscoklattali.jpeg', 'stock' => 7],
            ['name' => 'Retro Biker Buckle Boots Jet Black', 'description' => 'Boots pengendara motor dengan gesper logam ganda di samping, tampil tangguh dan maskulin.', 'price' => 495000.00, 'image' => 'bootshitamfull.jpeg', 'stock' => 3],
        ];

        foreach ($boots as $shoe) {
            Product::firstOrCreate(['name' => $shoe['name']], array_merge($shoe, ['category_id' => $category->id]));
        }
    }
}