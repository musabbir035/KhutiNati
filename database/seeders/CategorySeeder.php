<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $sellers = Seller::all();

        Category::factory(10)->create()->each(
            function ($category) use ($sellers) {
                for ($i = 0; $i <= 5; $i++) {
                    Product::factory([
                        'category_id' => $category->id,
                        'seller_id' => 1 == 1 ? $sellers->random(1)->first()->id : null
                    ])->create();
                }
            }
        );
    }
}
