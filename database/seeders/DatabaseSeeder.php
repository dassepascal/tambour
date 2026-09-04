<?php

namespace Database\Seeders;

use App\Enums\TambourCategoryType;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $tambours = Category::create([
            'name' => 'Tambours',
            'slug' => 'tambours',
            'type' => TambourCategoryType::Tambour,
        ]);

        $accessoires = Category::create([
            'name' => 'Accessoires',
            'slug' => 'accessoires',
            'type' => TambourCategoryType::Accessoire,
        ]);

        Product::factory(6)->create(['category_id' => $tambours->id]);
        Product::factory(3)->create(['category_id' => $accessoires->id, 'diameter_cm' => null]);
    }
}
