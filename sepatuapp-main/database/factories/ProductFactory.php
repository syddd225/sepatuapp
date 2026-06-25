<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 250000, 1500000),
            'image' => 'default-shoe.jpg',
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'stock' => $this->faker->numberBetween(5, 50),
            'materials' => $this->getMaterials(),
            'philosophy' => $this->getPhilosophy(),
            'images_angles' => $this->getImageAngles(),
            'whatsapp_phone' => null, // Use default from config
        ];
    }

    /**
     * Get sample materials for a shoe
     */
    private function getMaterials(): array
    {
        $materialOptions = [
            ['name' => 'Kulit Asli', 'quality' => 'Premium'],
            ['name' => 'Kanvas', 'quality' => 'Natural'],
            ['name' => 'Suede', 'quality' => 'Premium'],
            ['name' => 'Mesh Breathable', 'quality' => 'High-Tech'],
        ];

        return $this->faker->randomElements($materialOptions, $this->faker->numberBetween(2, 3));
    }

    /**
     * Get sample artisan philosophy
     */
    private function getPhilosophy(): string
    {
        $philosophies = [
            'Setiap sepatu dibuat dengan perhatian detail yang tinggi, menggunakan teknik tradisional yang dipadukan dengan inovasi modern.',
            'Kami percaya bahwa kualitas tidak boleh dikompromikan. Setiap jahitan adalah bukti komitmen kami terhadap kesempurnaan.',
            'Sepatu kami dirancang untuk menceritakan kisah kerajinan tangan yang autentik dan dedikasi terhadap seni membuat sepatu.',
            'Kenyamanan dan estetika berjalan beriringan dalam filosofi desain kami. Setiap produk adalah karya seni yang dapat dikenakan.',
        ];

        return $this->faker->randomElement($philosophies);
    }

    /**
     * Get sample image angles
     */
    private function getImageAngles(): array
    {
        return [
            'shoe-angle-2.jpg',
            'shoe-angle-3.jpg',
            'shoe-angle-4.jpg',
        ];
    }
}
