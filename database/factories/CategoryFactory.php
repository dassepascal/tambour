<?php

namespace Database\Factories;

use App\Enums\TambourCategoryType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement(['Tambours', 'Accessoires']);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => $name === 'Tambours' ? TambourCategoryType::Tambour : TambourCategoryType::Accessoire,
        ];
    }
}
