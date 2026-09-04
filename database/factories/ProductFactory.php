<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = 'Tambour chamanique '.fake()->numberBetween(35, 50).' cm';

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title.'-'.fake()->unique()->numberBetween(1, 100000)),
            'description' => fake()->paragraphs(2, true),
            'price' => fake()->numberBetween(15000, 45000),
            'diameter_cm' => fake()->numberBetween(35, 50),
            'skin_type' => fake()->randomElement(['Peau de cheval', 'Peau de cerf', 'Peau de chèvre']),
            'wood_type' => fake()->randomElement(['Frêne', 'Bouleau', 'Tilleul']),
            'weight_grams' => fake()->numberBetween(800, 1800),
            'stock' => 1,
            'is_custom_order' => false,
            'published_at' => now(),
        ];
    }
}
