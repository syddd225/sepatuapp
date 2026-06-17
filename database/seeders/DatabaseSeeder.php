<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
=======
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
>>>>>>> 12309d05081218b0bf392f1ac7d5b4a2135f03e3

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // Create predefined shoe categories
        $categories = [
=======
        // 1. Masukkan data ke tabel categories
        DB::table('categories')->insert([
>>>>>>> 12309d05081218b0bf392f1ac7d5b4a2135f03e3
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

        // Create sample products for each category
        $formalCategory = Category::where('slug', 'formal')->first();
        $casualCategory = Category::where('slug', 'casual')->first();
        $bootsCategory = Category::where('slug', 'boots')->first();

        // Formal shoes
        if ($formalCategory) {
            $this->createFormalProducts($formalCategory);
        }

        // Casual shoes
        if ($casualCategory) {
            $this->createCasualProducts($casualCategory);
        }

        // Boots
        if ($bootsCategory) {
            $this->createBootsProducts($bootsCategory);
        }
    }

    /**
     * Create formal shoe products
     */
    private function createFormalProducts(Category $category): void
    {
        $formalShoes = [
            [
                'name' => 'Retro Oxford Dark Brown',
                'description' => 'Sepatu formal coklat tua dengan desain clean, nyaman untuk penggunaan harian.',
                'price' => 320000.00,
                'image' => 'formalcoklattua.jpeg',
                'stock' => 5,
                'materials' => [
                    ['name' => 'Kulit Asli', 'quality' => 'Premium'],
                    ['name' => 'Sol Karet', 'quality' => 'Durable']
                ],
                'philosophy' => 'Setiap sepatu formal kami dirancang dengan perhatian terhadap detail, menggunakan kulit pilihan berkualitas tinggi.',
                'images_angles' => ['formal-brown-side.jpg', 'formal-brown-top.jpg', 'formal-brown-detail.jpg']
            ],
            [
                'name' => 'Retro Oxford Black',
                'description' => 'Sepatu formal hitam dengan tampilan rapi dan sederhana, cocok untuk acara formal.',
                'price' => 330000.00,
                'image' => 'formalhitam.jpeg',
                'stock' => 8,
                'materials' => [
                    ['name' => 'Kulit Asli', 'quality' => 'Premium'],
                    ['name' => 'Sol Karet', 'quality' => 'Durable']
                ],
                'philosophy' => 'Klasik abadi: hitam yang sempurna untuk setiap kesempatan formal dengan kenyamanan sepanjang hari.',
                'images_angles' => ['formal-black-side.jpg', 'formal-black-top.jpg', 'formal-black-sole.jpg']
            ],
            [
                'name' => 'Retro Derby Brown',
                'description' => 'Sepatu formal coklat dengan desain santai, cocok untuk semi formal.',
                'price' => 300000.00,
                'image' => 'sepatuformalcoklat.jpeg',
                'stock' => 6,
                'materials' => [
                    ['name' => 'Suede', 'quality' => 'Premium'],
                    ['name' => 'Sol Kulit', 'quality' => 'Natural']
                ],
                'philosophy' => 'Perpaduan sempurna antara formalitas dan kenyamanan untuk pria modern yang menghargai gaya.',
                'images_angles' => ['derby-brown-side.jpg', 'derby-brown-angle.jpg', 'derby-brown-closeup.jpg']
            ],
            [
                'name' => 'Retro Brogue Heritage Tan',
                'description' => 'Sepatu brogue bermotif perforasi wingtip klasik, memberikan kesan vintage Inggris yang sangat kuat.',
                'price' => 355000.00,
                'image' => 'formalcoklattua.jpeg',
                'stock' => 7,
                'materials' => [
                    ['name' => 'Kulit Full Grain', 'quality' => 'Premium'],
                    ['name' => 'Sol Kulit Campuran', 'quality' => 'Handcrafted']
                ],
                'philosophy' => 'Karya seni perforasi klasik yang melambangkan keanggunan gaya aristokrat tradisional.',
                'images_angles' => ['formal-brown-side.jpg', 'formal-brown-top.jpg']
            ],
            [
                'name' => 'Retro Single Monk Strap Black',
                'description' => 'Sepatu monk strap tunggal dengan buckle stainless steel, tampil maskulin dan elegan tanpa tali.',
                'price' => 340000.00,
                'image' => 'formalhitam2.jpeg',
                'stock' => 4,
                'materials' => [
                    ['name' => 'Kulit Sapi Asli', 'quality' => 'Premium Class'],
                    ['name' => 'Buckle Logam', 'quality' => 'Stainless']
                ],
                'philosophy' => 'Kemudahan tanpa mengorbankan estetika formal bagi eksekutif yang aktif.',
                'images_angles' => ['formal-black-side.jpg', 'formal-black-sole.jpg']
            ],
            [
                'name' => 'Retro Penny Loafer Mahogany',
                'description' => 'Loafer kasual-formal tanpa tali dengan warna kayu mahoni yang anggun, mudah dipakai.',
                'price' => 310000.00,
                'image' => 'sepatuformalcoklat.jpeg',
                'stock' => 10,
                'materials' => [
                    ['name' => 'Kulit Brush-off', 'quality' => 'Glossy Premium'],
                    ['name' => 'Sol Rubber Anti-Slip', 'quality' => 'Medium Durability']
                ],
                'philosophy' => 'Praktis, nyaman, dan memikat. Desain slip-on legendaris sejak era 1950-an.',
                'images_angles' => ['derby-brown-side.jpg', 'derby-brown-angle.jpg']
            ],
            [
                'name' => 'Retro Wingtip Dress Shoe Black',
                'description' => 'Sepatu gaun bermotif wingtip warna hitam mengkilap, cocok dipasangkan dengan tuxedo terbaik Anda.',
                'price' => 365000.00,
                'image' => 'formalhitam.jpeg',
                'stock' => 5,
                'materials' => [
                    ['name' => 'Patent Leather', 'quality' => 'Super Shiny'],
                    ['name' => 'Sol Fiber Premium', 'quality' => 'Extra Hard']
                ],
                'philosophy' => 'Dibuat khusus untuk perayaan momen penting hidup Anda dengan kemegahan sejati.',
                'images_angles' => ['formal-black-side.jpg', 'formal-black-top.jpg']
            ],
            [
                'name' => 'Retro Double Monk Strap Dark Cognac',
                'description' => 'Double monk strap dengan warna cognac gelap dan aksen brass buckle, memikat pandangan dengan gaya dandy.',
                'price' => 380000.00,
                'image' => 'formalcoklattua.jpeg',
                'stock' => 4,
                'materials' => [
                    ['name' => 'Aniline Leather', 'quality' => 'Cognac Finish'],
                    ['name' => 'Dual Buckle', 'quality' => 'Solid Brass']
                ],
                'philosophy' => 'Keseimbangan gaya formal kontemporer yang berkarakter kuat.',
                'images_angles' => ['formal-brown-side.jpg']
            ],
            [
                'name' => 'Retro Tassel Loafer Vintage Ebony',
                'description' => 'Loafer hitam pekat dengan gantungan tassel kulit di atasnya, perpaduan kasual kelas atas.',
                'price' => 325000.00,
                'image' => 'formalhitam2.jpeg',
                'stock' => 6,
                'materials' => [
                    ['name' => 'Calfskin Leather', 'quality' => 'Super Soft'],
                    ['name' => 'Tassel detail', 'quality' => 'Handcrafted']
                ],
                'philosophy' => 'Sentuhan santai bangsawan Eropa pada kenyamanan melangkah harian Anda.',
                'images_angles' => ['formal-black-side.jpg', 'formal-black-sole.jpg']
            ],
            [
                'name' => 'Retro Cap-toe Oxford Chocolate',
                'description' => 'Oxford bertipe cap-toe lurus dengan jahitan presisi, sangat minimalis dan anggun.',
                'price' => 335000.00,
                'image' => 'sepatuformalcoklat.jpeg',
                'stock' => 8,
                'materials' => [
                    ['name' => 'Kulit Sapi Premium', 'quality' => 'Matte Finish'],
                    ['name' => 'Sol Karet Sintetis', 'quality' => 'Daily Usable']
                ],
                'philosophy' => 'Kesederhanaan garis desain yang melambangkan kejujuran craftsmanship.',
                'images_angles' => ['derby-brown-side.jpg', 'derby-brown-angle.jpg']
            ],
            [
                'name' => 'Retro Kiltie Slip-On Oxblood',
                'description' => 'Sepatu slip-on berumbai rumbai khas kiltie dengan warna merah marun oxblood yang dramatis.',
                'price' => 345000.00,
                'image' => '.jpeg',
                'stock' => 3,
                'materials' => [
                    ['name' => 'Kulit Suede Oxblood', 'quality' => 'Fine Grain'],
                    ['name' => 'Kiltie Fringe', 'quality' => 'Tradisional Stitch']
                ],
                'philosophy' => 'Menghormati tradisi pembuatan sepatu Skotlandia dalam balutan estetika modern.',
                'images_angles' => ['formal-brown-side.jpg']
            ],
            [
                'name' => 'Retro Balmoral Dress Boots Black',
                'description' => 'Boot dress bertipe Balmoral dengan penutup pergelangan kaki berbahan kanvas tebal dan bagian bawah kulit hitam.',
                'price' => 390000.00,
                'image' => '.jpeg',
                'stock' => 4,
                'materials' => [
                    ['name' => 'Kulit Sapi & Kanvas', 'quality' => 'Two-Tone Premium'],
                    ['name' => 'Sol Kulit Soled', 'quality' => 'Classic Balmoral']
                ],
                'philosophy' => 'Warisan gaya Victorian Inggris yang gagah namun tetap bersahabat untuk modern formal.',
                'images_angles' => ['formal-black-side.jpg', 'formal-black-top.jpg']
            ],
            [
                'name' => 'Retro Plain-Toe Derby Walnut',
                'description' => 'Sepatu Derby polos warna kayu walnut yang sangat fleksibel dipadukan dengan celana chino maupun jeans.',
                'price' => 295000.00,
                'image' => '.jpeg',
                'stock' => 12,
                'materials' => [
                    ['name' => 'Kulit Nubuck Lembut', 'quality' => 'Earth Tone'],
                    ['name' => 'Sol Karet Ringan', 'quality' => 'Extra Flexible']
                ],
                'philosophy' => 'Keindahan alami kayu walnut yang dituangkan ke dalam kenyamanan alas kaki harian.',
                'images_angles' => ['derby-brown-side.jpg']
            ],
        ];

        foreach ($formalShoes as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, ['category_id' => $category->id])
            );
        }
    }

    /**
     * Create casual shoe products
     */
    private function createCasualProducts(Category $category): void
    {
        $casualShoes = [
            [
                'name' => 'Retro Suede Brown',
                'description' => 'Sepatu kasual berbahan suede coklat muda dengan sol tebal, cocok untuk gaya santai natural.',
                'price' => 250000.00,
                'image' => 'casual1.jpeg',
                'stock' => 12,
                'materials' => [
                    ['name' => 'Suede', 'quality' => 'Premium'],
                    ['name' => 'Mesh Breathable', 'quality' => 'High-Tech']
                ],
                'philosophy' => 'Kenyamanan adalah prioritas utama. Desain kasual yang cocok untuk aktivitas sehari-hari dengan gaya.',
                'images_angles' => ['casual-brown-front.jpg', 'casual-brown-side.jpg', 'casual-brown-comfort.jpg']
            ],
            [
                'name' => 'Retro Canvas White',
                'description' => 'Sepatu kasual kanvas putih dengan desain minimalis, sempurna untuk pairing dengan berbagai outfit.',
                'price' => 180000.00,
                'image' => 'casual2.jpeg',
                'stock' => 15,
                'materials' => [
                    ['name' => 'Kanvas', 'quality' => 'Natural'],
                    ['name' => 'Sol Karet', 'quality' => 'Flexible']
                ],
                'philosophy' => 'Kesederhanaan yang elegan. Putih murni untuk kanvas gaya hidup Anda yang dinamis.',
                'images_angles' => ['canvas-white-top.jpg', 'canvas-white-side.jpg', 'canvas-white-clean.jpg']
            ],
            [
                'name' => 'Retro Slip-on Creamy',
                'description' => 'Sepatu kasual model slip-on tanpa tali berwarna krem lembut dengan rajutan kanvas berpori.',
                'price' => 195000.00,
                'image' => 'casual3.jpeg',
                'stock' => 14,
                'materials' => [
                    ['name' => 'Kain Kanvas Knit', 'quality' => 'Highly Breathable'],
                    ['name' => 'Sol Sponge EVA', 'quality' => 'Ultra Soft']
                ],
                'philosophy' => 'Menemani langkah santai di sore hari dengan kelembutan tanpa tekanan.',
                'images_angles' => ['canvas-white-side.jpg', 'canvas-white-clean.jpg']
            ],
            [
                'name' => 'Retro Sneaker Vintage Olive',
                'description' => 'Sneaker retro bernuansa hijau olive klasik dengan garis samping putih bergaya lawas.',
                'price' => 270000.00,
                'image' => 'casual4.jpeg',
                'stock' => 9,
                'materials' => [
                    ['name' => 'Kanvas & Suede', 'quality' => 'Vintage Mixture'],
                    ['name' => 'Sol Karet Vulkanisir', 'quality' => 'Super Grip']
                ],
                'philosophy' => 'Mengembalikan jiwa petualang perkotaan era 70-an ke langkah modern Anda.',
                'images_angles' => ['casual-brown-front.jpg', 'casual-brown-side.jpg']
            ],
            [
                'name' => 'Retro Leather Deck Navy',
                'description' => 'Sepatu kasual bertipe deck shoe / boat shoe dengan warna biru navy yang terbuat dari bahan nubuck leather lembut.',
                'price' => 290000.00,
                'image' => 'casual1.jpeg',
                'stock' => 8,
                'materials' => [
                    ['name' => 'Kulit Nubuck', 'quality' => 'Velvet Touch'],
                    ['name' => 'Tali Kulit Mentah', 'quality' => 'Traditional Stitch']
                ],
                'philosophy' => 'Semangat kebebasan laut lepas yang disematkan dalam kepraktisan alas kaki harian.',
                'images_angles' => ['casual-brown-side.jpg', 'casual-brown-comfort.jpg']
            ],
            [
                'name' => 'Retro Canvas Sneaker Mustard',
                'description' => 'Sneaker kanvas berwarna kuning mustard menyala, memberikan aksen ceria pada tampilan kasual Anda.',
                'price' => 210000.00,
                'image' => 'casual2.jpeg',
                'stock' => 11,
                'materials' => [
                    ['name' => 'Kanvas Katun 12oz', 'quality' => 'Strong Canvas'],
                    ['name' => 'Gum Sole', 'quality' => 'Retro Look']
                ],
                'philosophy' => 'Mengekspresikan keberanian dan keceriaan jiwa muda yang dinamis di setiap jalan.',
                'images_angles' => ['canvas-white-top.jpg', 'canvas-white-clean.jpg']
            ],
            [
                'name' => 'Retro Chelsea Casual Sand',
                'description' => 'Chelsea boots dengan potongan kasual rendah berwarna pasir, mudah dikombinasikan dengan celana pendek.',
                'price' => 310000.00,
                'image' => 'casual3.jpeg',
                'stock' => 7,
                'materials' => [
                    ['name' => 'Suede Pasir', 'quality' => 'Soft Suede'],
                    ['name' => 'Karet Elastis samping', 'quality' => 'Stretchy Elastic']
                ],
                'philosophy' => 'Menggabungkan kemudahan chelsea boot dengan nuansa kasual gurun pasir.',
                'images_angles' => ['canvas-white-side.jpg']
            ],
            [
                'name' => 'Retro High-Top Classic Black',
                'description' => 'Sneaker kanvas bertinggi di atas mata kaki klasik berwarna hitam pekat, model legendaris sepanjang masa.',
                'price' => 230000.00,
                'image' => 'casual4.jpeg',
                'stock' => 16,
                'materials' => [
                    ['name' => 'Kanvas Katun Hitam', 'quality' => '14oz Canvas'],
                    ['name' => 'Sol Karet Putih', 'quality' => 'Contrast Vulc']
                ],
                'philosophy' => 'Gaya abadi ikon pop-culture retro yang terus melintasi generasi.',
                'images_angles' => ['casual-brown-front.jpg', 'casual-brown-side.jpg']
            ],
            [
                'name' => 'Retro Espadrille Indigo Wash',
                'description' => 'Sepatu kasual santai espadrille dengan rajutan tali rami melingkar pada sol bawah dan kain denim indigo wash.',
                'price' => 185000.00,
                'image' => '.jpeg',
                'stock' => 20,
                'materials' => [
                    ['name' => 'Denim Katun Indigo', 'quality' => 'Lightweight Denim'],
                    ['name' => 'Sol Tali Rami Rajut', 'quality' => 'Traditional Jute']
                ],
                'philosophy' => 'Kenyamanan ringan bagaikan tidak menggunakan sepatu saat berlibur musim panas.',
                'images_angles' => ['canvas-white-top.jpg']
            ],
            [
                'name' => 'Retro Leather Trainer Burgundy',
                'description' => 'Trainer bergaya olah raga lawas era 80-an dengan warna burgundy tua yang memukau.',
                'price' => 280000.00,
                'image' => '.jpeg',
                'stock' => 9,
                'materials' => [
                    ['name' => 'Kulit Action Premium', 'quality' => 'Clean Smooth'],
                    ['name' => 'Sol Karet Cupsole', 'quality' => 'Stitch-on Sole']
                ],
                'philosophy' => 'Sentuhan gaya olahraga retro Eropa yang trendi untuk outfit perkotaan.',
                'images_angles' => ['casual-brown-side.jpg']
            ],
            [
                'name' => 'Retro Waffle Sole Sneaker Grey',
                'description' => 'Sepatu lari vintage dengan sol bermotif waffle yang unik dan bobot yang sangat ringan.',
                'price' => 240000.00,
                'image' => '.jpeg',
                'stock' => 13,
                'materials' => [
                    ['name' => 'Kain Nylon & Suede', 'quality' => 'Retro Runner Mix'],
                    ['name' => 'Sol Waffle Karet', 'quality' => 'High Grip Waffle']
                ],
                'philosophy' => 'Inovasi lawas sol waffle yang merevolusi cara berlari dengan kenyamanan harian.',
                'images_angles' => ['canvas-white-clean.jpg']
            ],
            [
                'name' => 'Retro Corduroy Slip-on Rust',
                'description' => 'Slip-on kasual unik menggunakan bahan kain korduroi garis besar berwarna coklat karat kemerahan.',
                'price' => 215000.00,
                'image' => 'casual3.jpeg',
                'stock' => 10,
                'materials' => [
                    ['name' => 'Kain Korduroi Rust', 'quality' => 'Warm Corduroy'],
                    ['name' => 'Sol Karet Fleksibel', 'quality' => 'Soft Insole']
                ],
                'philosophy' => 'Tekstur korduroi retro yang menghangatkan suasana santai Anda.',
                'images_angles' => ['canvas-white-side.jpg']
            ],
            [
                'name' => 'Retro Knit Sneaker Charcoal',
                'description' => 'Sneaker rajut dengan sirkulasi udara maksimal berwarna abu-abu arang, fleksibel untuk jalan-jalan santai.',
                'price' => 225000.00,
                'image' => 'casual4.jpeg',
                'stock' => 14,
                'materials' => [
                    ['name' => 'Flyknit Polyester', 'quality' => 'Lightweight'],
                    ['name' => 'Sol Phylon', 'quality' => 'Cushion Soft']
                ],
                'philosophy' => 'Kebebasan bergerak dalam rajutan kain modern dengan gaya lawas yang elegan.',
                'images_angles' => ['casual-brown-front.jpg']
            ],
            [
                'name' => 'Retro Velvet Slipper Ruby',
                'description' => 'Slipper kasual santai dari bahan bludru merah ruby halus dengan bordir inisial emas di atasnya.',
                'price' => 260000.00,
                'image' => 'casual1.jpeg',
                'stock' => 5,
                'materials' => [
                    ['name' => 'Bludru Velvet', 'quality' => 'Premium Soft'],
                    ['name' => 'Sol Kulit Suede', 'quality' => 'Indoor Comfort']
                ],
                'philosophy' => 'Kemewahan gaya santai bangsawan saat menikmati waktu istirahat di dalam ruangan.',
                'images_angles' => ['casual-brown-side.jpg']
            ],
        ];

        foreach ($casualShoes as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, ['category_id' => $category->id])
            );
        }
    }

    /**
     * Create boots products
     */
    private function createBootsProducts(Category $category): void
    {
        $boots = [
            [
                'name' => 'Retro Combat Boots Black',
                'description' => 'Sepatu boots combat bergaya retro dengan desain kokoh dan tahan lama, cocok untuk berbagai gaya.',
                'price' => 450000.00,
                'image' => 'bootshitamfull.jpeg',
                'stock' => 4,
                'materials' => [
                    ['name' => 'Kulit Asli', 'quality' => 'Premium'],
                    ['name' => 'Sol Karet Tebal', 'quality' => 'Heavy Duty']
                ],
                'philosophy' => 'Kekuatan dan gaya dalam satu paket. Boots yang dibangun untuk tahan lama dan membuat pernyataan fashion.',
                'images_angles' => ['boots-black-front.jpg', 'boots-black-side.jpg', 'boots-black-lacing.jpg']
            ],
            [
                'name' => 'Retro Desert Boots Suede Tan',
                'description' => 'Boots bertinggi pergelangan kaki dengan 3 lubang tali, menggunakan suede berwarna coklat gurun yang kasual.',
                'price' => 360000.00,
                'image' => 'bootscoklattali.jpeg',
                'stock' => 6,
                'materials' => [
                    ['name' => 'Suede Calfskin', 'quality' => 'Soft Feel'],
                    ['name' => 'Sol Crepe Alami', 'quality' => 'Cushiony bouncy']
                ],
                'philosophy' => 'Simbol pemberontakan subkultur modern dengan kenyamanan tapak sol karet crepe yang empuk.',
                'images_angles' => ['boots-black-side.jpg', 'boots-black-lacing.jpg']
            ],
            [
                'name' => 'Retro Engineer Boots Dark Oak',
                'description' => 'Boots tangguh bertali dengan resleting samping bertekstur kulit kayu ek tua, memancarkan kesan petualang tangguh.',
                'price' => 480000.00,
                'image' => '.jpeg',
                'stock' => 5,
                'materials' => [
                    ['name' => 'Pull-up Leather', 'quality' => 'Patina Aging'],
                    ['name' => 'Welted Construction', 'quality' => 'Extra Sturdy']
                ],
                'philosophy' => 'Semakin lama dipakai, semakin indah. Menua bersama cerita perjalanan Anda.',
                'images_angles' => ['boots-black-front.jpg', 'boots-black-side.jpg']
            ],
            [
                'name' => 'Retro Chelsea Boots Vintage White',
                'description' => 'Chelsea boots bergaya mod era 60-an berwarna putih tulang dengan karet samping kontras hitam.',
                'price' => 395000.00,
                'image' => '.jpeg',
                'stock' => 3,
                'materials' => [
                    ['name' => 'Kulit Sapi Nappa', 'quality' => 'Super Soft Finish'],
                    ['name' => 'Double Elastic Band', 'quality' => 'Flexible Stretch']
                ],
                'philosophy' => 'Menghadirkan pesona musik rock n roll klasik London langsung ke gaya harian Anda.',
                'images_angles' => ['boots-black-side.jpg', 'boots-black-lacing.jpg']
            ],
            [
                'name' => 'Retro Moc Toe Work Boots Coffee',
                'description' => 'Boots kerja dengan jahitan moccasin melengkung di ujung depan, bernuansa kopi robusta hangat.',
                'price' => 430000.00,
                'image' => '.jpeg',
                'stock' => 8,
                'materials' => [
                    ['name' => 'Oil Tanned Leather', 'quality' => 'Water Resistant'],
                    ['name' => 'Sol Traction Tred', 'quality' => 'White Wedge Sole']
                ],
                'philosophy' => 'Boots andalan para pekerja tambang dan pabrik Amerika masa lampau yang tangguh.',
                'images_angles' => ['boots-black-lacing.jpg']
            ],
            [
                'name' => 'Retro Brogue Lace Boots Oxblood',
                'description' => 'Boots formal tinggi bertali dengan detail ukiran brogue elegan, berwarna merah gelap oxblood.',
                'price' => 460000.00,
                'image' => 'bootshitamtali.jpeg',
                'stock' => 4,
                'materials' => [
                    ['name' => 'Kulit Premium Polished', 'quality' => 'High Shine'],
                    ['name' => 'Welted Sole Goodyear', 'quality' => 'Long Lasting']
                ],
                'philosophy' => 'Gaya bertualang yang anggun, siap digunakan untuk rapat penting maupun berjalan santai di kota.',
                'images_angles' => ['boots-black-front.jpg']
            ],
            [
                'name' => 'Retro Chukka Boots Mustard Suede',
                'description' => 'Chukka boots kasual setinggi pergelangan kaki berbahan suede berwarna kuning mustard.',
                'price' => 350000.00,
                'image' => 'bootscoklattali.jpeg',
                'stock' => 9,
                'materials' => [
                    ['name' => 'Suede Kulit Asli', 'quality' => 'Super Soft Suede'],
                    ['name' => 'Sol Karet Ringan', 'quality' => 'Flex Rubber']
                ],
                'philosophy' => 'Ringan, santai, dan memberi aksen warna unik pada penampilan harian.',
                'images_angles' => ['boots-black-lacing.jpg']
            ],
            [
                'name' => 'Retro Monkey Boots Charcoal Black',
                'description' => 'Boots klasik dengan tali sepatu yang sangat panjang hingga mendekati ujung jari kaki, memberikan tampilan vintage unik.',
                'price' => 410000.00,
                'image' => 'bootshitamfull.jpeg',
                'stock' => 6,
                'materials' => [
                    ['name' => 'Kulit Sapi Tebal', 'quality' => 'Hard Wearing'],
                    ['name' => 'Sol Karet Bergerigi', 'quality' => 'Deep Commando Tread']
                ],
                'philosophy' => 'Menghidupkan kembali desain militer era Perang Dunia ke-2 ke langkah kasual modern.',
                'images_angles' => ['boots-black-side.jpg']
            ],
            [
                'name' => 'Retro Duck Boots Navy Tan',
                'description' => 'Boots tahan air bertipe duck boots dengan bagian bawah berlapis karet kedap air dan bagian atas kulit tan.',
                'price' => 425000.00,
                'image' => 'bootscoklattali.jpeg',
                'stock' => 5,
                'materials' => [
                    ['name' => 'Karet Kedap Air & Kulit', 'quality' => 'Waterproof Lower'],
                    ['name' => 'Sol Rubber Anti-Slip', 'quality' => 'Slippery Protection']
                ],
                'philosophy' => 'Ketangguhan sejati dalam menghadapi cuaca basah dan becek tanpa takut merusak sepatu.',
                'images_angles' => ['boots-black-front.jpg']
            ],
            [
                'name' => 'Retro Hiking Boots Forest Green',
                'description' => 'Boots gunung model vintage berbahan kombinasi suede hijau hutan dengan tali sepatu berwarna merah menyala.',
                'price' => 445000.00,
                'image' => 'bootscoklattali.jpeg',
                'stock' => 7,
                'materials' => [
                    ['name' => 'Suede & Nylon Cordura', 'quality' => 'Tear Resistant'],
                    ['name' => 'Sol Vibram style', 'quality' => 'Multi-surface Grip']
                ],
                'philosophy' => 'Bagi mereka yang mendengar panggilan alam bebas dengan semangat retro hiking.',
                'images_angles' => ['boots-black-side.jpg']
            ],
            [
                'name' => 'Retro Biker Buckle Boots Jet Black',
                'description' => 'Boots pengendara motor dengan gesper logam ganda di samping, tampil tangguh dan maskulin.',
                'price' => 495000.00,
                'image' => 'bootshitamfull.jpeg',
                'stock' => 3,
                'materials' => [
                    ['name' => 'Kulit Sapi Kasar', 'quality' => 'Heavy Weight Leather'],
                    ['name' => 'Double Steel Buckles', 'quality' => 'Heavy Hardware']
                ],
                'philosophy' => 'Kebebasan menjelajah aspal dengan proteksi maksimal dan karisma biker sejati.',
                'images_angles' => ['boots-black-front.jpg']
            ],
        ];

        foreach ($boots as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, ['category_id' => $category->id])
            );
        }
    }
}
