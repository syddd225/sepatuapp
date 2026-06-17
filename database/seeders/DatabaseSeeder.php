<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
        ];

        foreach ($boots as $shoe) {
            Product::firstOrCreate(
                ['name' => $shoe['name']],
                array_merge($shoe, ['category_id' => $category->id])
            );
        }
    }
}
