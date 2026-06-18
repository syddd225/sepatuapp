<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * PlaceholderProductSeeder
 * 
 * Membuat 9 dummy products per category untuk testing & placeholder
 * Jalankan dengan: php artisan db:seed --class=PlaceholderProductSeeder
 */
class PlaceholderProductSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create categories
        $formalCategory = Category::firstOrCreate(
            ['slug' => 'formal'],
            [
                'name' => 'Formal',
                'description' => 'Sepatu formal elegan untuk acara resmi'
            ]
        );

        $casualCategory = Category::firstOrCreate(
            ['slug' => 'casual'],
            [
                'name' => 'Casual',
                'description' => 'Sepatu kasual nyaman untuk sehari-hari'
            ]
        );

        $bootsCategory = Category::firstOrCreate(
            ['slug' => 'boots'],
            [
                'name' => 'Boots',
                'description' => 'Sepatu boots stylish dan tahan lama'
            ]
        );

        // Create products
        $this->createFormalPlaceholders($formalCategory);
        $this->createCasualPlaceholders($casualCategory);
        $this->createBootsPlaceholders($bootsCategory);

        $this->command->info('✅ 27 placeholder products created successfully!');
    }

    /**
     * Create 9 formal shoe placeholders
     */
    private function createFormalPlaceholders(Category $category): void
    {
        $formalShoes = [
            [
                'name' => 'Formal Leather Black Premium',
                'description' => 'Sepatu formal kulit asli warna hitam dengan finishing premium, desain klasik untuk kesempatan formal.',
                'price' => 350000.00,
                'image' => 'placeholder-formal-1.jpg',
                'stock' => 8,
                'materials' => ['Kulit Premium', 'Sol Karet', 'Flock Lining'],
                'philosophy' => 'Elegan dan timeless. Setiap sepatu formal kami adalah investasi pada penampilan profesional Anda.',
            ],
            [
                'name' => 'Formal Oxford Brown Classic',
                'description' => 'Oxford berkualitas tinggi dengan warna coklat hangat, cocok untuk penggunaan sehari-hari hingga acara semi-formal.',
                'price' => 340000.00,
                'image' => 'placeholder-formal-2.jpg',
                'stock' => 10,
                'materials' => ['Kulit Asli', 'Sol Karet Natural', 'Breathable Lining'],
                'philosophy' => 'Kualitas yang bertahan. Dirancang untuk kenyamanan maksimal tanpa mengorbankan gaya.',
            ],
            [
                'name' => 'Formal Derby Burgundy',
                'description' => 'Sepatu formal warna merah marun yang jarang ditemukan, sempurna untuk yang ingin tampil berbeda dengan tetap formal.',
                'price' => 360000.00,
                'image' => 'placeholder-formal-3.jpg',
                'stock' => 5,
                'materials' => ['Suede Premium', 'Karet Fleksibel', 'Premium Insole'],
                'philosophy' => 'Keberanian untuk berbeda. Warna yang membuat statement tanpa mengorbankan profesionalisme.',
            ],
            [
                'name' => 'Formal Loafer Dark Navy',
                'description' => 'Loafer kulit dengan warna navy gelap, nyaman digunakan sepanjang hari dengan tampilan yang tetap formal.',
                'price' => 320000.00,
                'image' => 'placeholder-formal-4.jpg',
                'stock' => 12,
                'materials' => ['Kulit Lembut', 'Sol Karet', 'Memory Foam Insole'],
                'philosophy' => 'Kenyamanan tanpa kompromi. Loafer yang membuat Anda tetap percaya diri sepanjang hari.',
            ],
            [
                'name' => 'Formal Monk Strap Black',
                'description' => 'Monk strap dengan desain dua tali, kombinasi sempurna antara formal dan casual yang versatile.',
                'price' => 345000.00,
                'image' => 'placeholder-formal-5.jpg',
                'stock' => 7,
                'materials' => ['Kulit Premium', 'Buckle Stainless', 'Reinforced Sole'],
                'philosophy' => 'Desain yang timeless. Monk strap adalah pilihan yang sophisticated untuk pria modern.',
            ],
            [
                'name' => 'Formal Brogues Tan Light',
                'description' => 'Brogues dengan perforasi detail dan warna tan muda, menambah tekstur pada gaya formal Anda.',
                'price' => 355000.00,
                'image' => 'placeholder-formal-6.jpg',
                'stock' => 6,
                'materials' => ['Suede Tan', 'Sol Kulit', 'Detail Perforasi'],
                'philosophy' => 'Tekstur yang menarik. Setiap detail dirancang untuk memberikan dimensi pada outfit Anda.',
            ],
            [
                'name' => 'Formal Wholecut Ebony',
                'description' => 'Wholecut dari satu potongan kulit dengan finishing smooth, desain minimalis yang sangat elegan.',
                'price' => 380000.00,
                'image' => 'placeholder-formal-7.jpg',
                'stock' => 4,
                'materials' => ['Kulit Ebony Premium', 'Sol Kulit Asli', 'Seamless Design'],
                'philosophy' => 'Kesederhanaan yang sophisticated. One piece of leather, countless compliments.',
            ],
            [
                'name' => 'Formal Blucher Charcoal',
                'description' => 'Blucher dengan warna charcoal abu-abu, cocok untuk acara semi-formal dengan sentuhan casual yang halus.',
                'price' => 335000.00,
                'image' => 'placeholder-formal-8.jpg',
                'stock' => 9,
                'materials' => ['Kulit Charcoal', 'Sol Fleksibel', 'Eyelet Detail'],
                'philosophy' => 'Fleksibilitas gaya. Blucher yang beradaptasi dari formal hingga casual dengan sempurna.',
            ],
            [
                'name' => 'Formal Chelsea Espresso',
                'description' => 'Chelsea boot dengan warna espresso gelap, modern dan sophisticated untuk acara formal maupun kasual.',
                'price' => 370000.00,
                'image' => 'placeholder-formal-9.jpg',
                'stock' => 5,
                'materials' => ['Kulit Espresso', 'Elastic Panel', 'Heel Counter Reinforced'],
                'philosophy' => 'Modernitas dalam kesederhanaan. Chelsea yang cocok untuk setiap kesempatan Anda.',
            ],
        ];

        foreach ($formalShoes as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, [
                    'category_id' => $category->id,
                    'materials' => $shoe['materials'],
                ])
            );
        }

        $this->command->info('✅ 9 Formal placeholders created');
    }

    /**
     * Create 9 casual shoe placeholders
     */
    private function createCasualPlaceholders(Category $category): void
    {
        $casualShoes = [
            [
                'name' => 'Casual Sneaker Canvas White',
                'description' => 'Sneaker kanvas putih yang timeless, cocok dipadu dengan berbagai outfit casual sehari-hari.',
                'price' => 200000.00,
                'image' => 'placeholder-casual-1.jpg',
                'stock' => 20,
                'materials' => ['Kanvas Premium', 'Sol Karet', 'Kain Breathable'],
                'philosophy' => 'Kesederhanaan yang universal. Sneaker putih yang tidak pernah ketinggalan zaman.',
            ],
            [
                'name' => 'Casual Slip-on Khaki Comfort',
                'description' => 'Slip-on warna khaki dengan desain nyaman, perfect untuk aktivitas casual sehari-hari tanpa ribet dikunci.',
                'price' => 220000.00,
                'image' => 'placeholder-casual-2.jpg',
                'stock' => 18,
                'materials' => ['Kanvas Khaki', 'Comfortable Insole', 'Flexible Sole'],
                'philosophy' => 'Kemudahan adalah kunci. Slip-on yang tidak mengorbankan gaya demi kenyamanan.',
            ],
            [
                'name' => 'Casual Runner Mesh Black',
                'description' => 'Runner dengan mesh breathable warna hitam, sangat nyaman untuk jogging atau aktivitas outdoor ringan.',
                'price' => 280000.00,
                'image' => 'placeholder-casual-3.jpg',
                'stock' => 15,
                'materials' => ['Mesh Breathable', 'Foam Cushion', 'Karet Tread'],
                'philosophy' => 'Performa dan gaya. Runner yang mengutamakan kenyamanan untuk aktivitas Anda.',
            ],
            [
                'name' => 'Casual Loafer Suede Tan',
                'description' => 'Loafer suede warna tan yang lembut, sempurna untuk acara semi-formal atau casual hangout.',
                'price' => 260000.00,
                'image' => 'placeholder-casual-4.jpg',
                'stock' => 12,
                'materials' => ['Suede Tan', 'Comfortable Padding', 'Flexible Sole'],
                'philosophy' => 'Nyaman dan stylish. Loafer yang cocok untuk pria yang menghargai kualitas.',
            ],
            [
                'name' => 'Casual Oxford Mint Green',
                'description' => 'Oxford warna hijau mint yang segar dan ceria, sangat cocok untuk tampilan casual yang eye-catching.',
                'price' => 250000.00,
                'image' => 'placeholder-casual-5.jpg',
                'stock' => 8,
                'materials' => ['Kanvas Mint', 'Sol Karet', 'Comfortable Insole'],
                'philosophy' => 'Warna yang membangkitkan semangat. Oxford casual yang berani tampil beda.',
            ],
            [
                'name' => 'Casual Boat Shoe Navy Blue',
                'description' => 'Boat shoe klasik warna navy blue dengan tekstur yang nyaman, cocok untuk gaya santai bertaraf tinggi.',
                'price' => 270000.00,
                'image' => 'placeholder-casual-6.jpg',
                'stock' => 11,
                'materials' => ['Kanvas Navy', 'Rubber Sole', 'Soft Insole'],
                'philosophy' => 'Gaya pantai yang refined. Boat shoe untuk mereka yang menghargai kenyamanan.',
            ],
            [
                'name' => 'Casual Chukka Leather Tan',
                'description' => 'Chukka dengan bahan kulit tan yang tebal, desain chukka klasik untuk gaya casual yang sophisticated.',
                'price' => 290000.00,
                'image' => 'placeholder-casual-7.jpg',
                'stock' => 7,
                'materials' => ['Kulit Tan', 'Crepe Rubber Sole', 'Leather Lining'],
                'philosophy' => 'Tekstur yang berbicara. Chukka yang menunjukkan apresiasi pada material berkualitas.',
            ],
            [
                'name' => 'Casual Espadrille Olive Green',
                'description' => 'Espadrille dengan warna olive green dan jute rope sole, sangat cocok untuk musim panas dan gaya casual.',
                'price' => 210000.00,
                'image' => 'placeholder-casual-8.jpg',
                'stock' => 16,
                'materials' => ['Kanvas Olive', 'Jute Rope', 'Flexible Sole'],
                'philosophy' => 'Kesegaran musiman. Espadrille yang membawa Anda ke mood santai dan rileks.',
            ],
            [
                'name' => 'Casual Moccasin Brown Suede',
                'description' => 'Moccasin suede coklat yang lembut dan hangat, sempurna untuk kenyamanan maksimal casual.',
                'price' => 240000.00,
                'image' => 'placeholder-casual-9.jpg',
                'stock' => 14,
                'materials' => ['Suede Brown', 'Soft Padding', 'Non-slip Sole'],
                'philosophy' => 'Kelembutan yang menyenangkan. Moccasin untuk mereka yang memprioritaskan kenyamanan.',
            ],
        ];

        foreach ($casualShoes as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, [
                    'category_id' => $category->id,
                    'materials' => $shoe['materials'],
                ])
            );
        }

        $this->command->info('✅ 9 Casual placeholders created');
    }

    /**
     * Create 9 boots placeholders
     */
    private function createBootsPlaceholders(Category $category): void
    {
        $boots = [
            [
                'name' => 'Boots Combat Black Heavy',
                'description' => 'Combat boots hitam dengan desain berat dan kokoh, sangat tahan lama untuk berbagai kondisi.',
                'price' => 420000.00,
                'image' => 'placeholder-boots-1.jpg',
                'stock' => 6,
                'materials' => ['Kulit Hitam', 'Sol Karet Tebal', 'Steel Laces'],
                'philosophy' => 'Kekuatan dan durabilitas. Boots combat yang dibangun untuk ketangguhan.',
            ],
            [
                'name' => 'Boots Western Tan Leather',
                'description' => 'Western boots warna tan dengan desain klasik western, menambah karakter pada gaya casual Anda.',
                'price' => 450000.00,
                'image' => 'placeholder-boots-2.jpg',
                'stock' => 4,
                'materials' => ['Kulit Tan', 'Cowboy Heel', 'Stitched Detail'],
                'philosophy' => 'Karakter yang kuat. Western boots untuk mereka yang percaya diri dengan gaya unik.',
            ],
            [
                'name' => 'Boots Chelsea Brown Suede',
                'description' => 'Chelsea boots suede coklat dengan elastic panel, modern dan versatile untuk berbagai kesempatan.',
                'price' => 390000.00,
                'image' => 'placeholder-boots-3.jpg',
                'stock' => 8,
                'materials' => ['Suede Coklat', 'Elastic Panel', 'Leather Sole'],
                'philosophy' => 'Modernitas yang elegan. Chelsea boots yang cocok untuk pria urban.',
            ],
            [
                'name' => 'Boots Motorcycle Black Spikes',
                'description' => 'Motorcycle boots hitam dengan detail spike, desain yang edgy dan rebellious untuk yang berani tampil beda.',
                'price' => 480000.00,
                'image' => 'placeholder-boots-4.jpg',
                'stock' => 3,
                'materials' => ['Kulit Hitam', 'Metal Spikes', 'Protective Sole'],
                'philosophy' => 'Keberanian untuk bersikap. Boots yang mengekspresikan kepribadian yang kuat.',
            ],
            [
                'name' => 'Boots Hiking Tan Rugged',
                'description' => 'Hiking boots tan dengan desain rugged, sangat cocok untuk petualangan outdoor dan hiking.',
                'price' => 440000.00,
                'image' => 'placeholder-boots-5.jpg',
                'stock' => 7,
                'materials' => ['Kulit Tan', 'Grip Sole', 'Waterproof Treatment'],
                'philosophy' => 'Petualangan menanti. Boots yang siap menemani eksplorasi Anda.',
            ],
            [
                'name' => 'Boots Chukka Khaki Canvas',
                'description' => 'Chukka boots dengan kanvas khaki, gaya casual-formal yang sempurna untuk berbagai acara.',
                'price' => 360000.00,
                'image' => 'placeholder-boots-6.jpg',
                'stock' => 9,
                'materials' => ['Kanvas Khaki', 'Crepe Sole', 'Canvas Lining'],
                'philosophy' => 'Fleksibilitas gaya. Boots yang beradaptasi dengan berbagai kesempatan.',
            ],
            [
                'name' => 'Boots Lace-up Black Formal',
                'description' => 'Lace-up boots hitam dengan desain formal, cocok untuk acara upacara atau formal yang lebih casual.',
                'price' => 400000.00,
                'image' => 'placeholder-boots-7.jpg',
                'stock' => 5,
                'materials' => ['Kulit Hitam Premium', 'Formal Laces', 'Reinforced Heel'],
                'philosophy' => 'Formalitas dengan edge. Boots yang menambah karakter pada penampilan formal.',
            ],
            [
                'name' => 'Boots Side Zip Brown Casual',
                'description' => 'Boots dengan side zip warna coklat, desain praktis yang stylish untuk penggunaan casual sehari-hari.',
                'price' => 370000.00,
                'image' => 'placeholder-boots-8.jpg',
                'stock' => 10,
                'materials' => ['Kulit Coklat', 'Metal Zipper', 'Comfortable Insole'],
                'philosophy' => 'Kepraktisan dengan gaya. Side zip boots untuk kehidupan modern yang aktif.',
            ],
            [
                'name' => 'Boots Platform Black Trendy',
                'description' => 'Platform boots hitam dengan sole tebal, desain trendy yang memberikan height dan presence.',
                'price' => 410000.00,
                'image' => 'placeholder-boots-9.jpg',
                'stock' => 6,
                'materials' => ['Kulit Hitam', 'Platform Sole', 'Trendy Design'],
                'philosophy' => 'Tren yang sustainable. Platform boots yang tetap relevan untuk generasi mendatang.',
            ],
        ];

        foreach ($boots as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, [
                    'category_id' => $category->id,
                    'materials' => $shoe['materials'],
                ])
            );
        }

        $this->command->info('✅ 9 Boots placeholders created');
    }
}
