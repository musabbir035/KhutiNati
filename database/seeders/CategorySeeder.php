<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $sellers;

    function __construct()
    {
        $this->sellers = Seller::all();
    }

    public function run()
    {
        // $sellers = Seller::all();

        // Category::factory(10)->create()->each(
        //     function ($category) use ($sellers) {
        //         for ($i = 0; $i <= 5; $i++) {
        //             Product::factory([
        //                 'category_id' => $category->id,
        //                 'seller_id' => 1 == 1 ? $sellers->random(1)->first()->id : null
        //             ])->create();
        //         }
        //     }
        // );

        $categories = [
            [
                'name' => 'Foods',
                'slug' => 'foods',
                'children' => [
                    [
                        'name' => 'Fruits',
                        'slug' => 'fruits'
                    ],
                    [
                        'name' => 'Vegetables',
                        'slug' => 'vegetables'
                    ],
                    [
                        'name' => 'Meat & Fish',
                        'slug' => 'meat-fish',
                        'children' => [
                            [
                                'name' => 'Meat',
                                'slug' => 'meat'
                            ],
                            [
                                'name' => 'Fish',
                                'slug' => 'fish'
                            ],
                            [
                                'name' => 'Dried Fish',
                                'slug' => 'dried-fish'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Culinary',
                        'slug' => 'culinary',
                        'children' => [
                            [
                                'name' => 'Rice',
                                'slug' => 'rice',
                            ],
                            [
                                'name' => 'Pulse & Lentils',
                                'slug' => 'pulse-lentils'
                            ],
                            [
                                'name' => 'Oil',
                                'slug' => 'oil'
                            ],
                            [
                                'name' => 'Spices & Ready Mix',
                                'slug' => 'spices-ready-mix'
                            ],
                            [
                                'name' => 'Pickles',
                                'slug' => 'pickles'
                            ],
                            [
                                'name' => 'Other Ingredients',
                                'slug' => 'other-ingredients'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Dairy',
                        'slug' => 'dairy',
                        'children' => [
                            [
                                'name' => 'Liquid Milk',
                                'slug' => 'liquid-milk'
                            ],
                            [
                                'name' => 'Butter, Cheese & Cream',
                                'slug' => 'butter-cheese-cream'
                            ],
                            [
                                'name' => 'Powder Milk',
                                'slug' => 'powder-milk'
                            ],
                            [
                                'name' => 'Dessert & Yogurt',
                                'slug' => 'dessert-yogurt'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Baking',
                        'slug' => 'baking',
                        'children' => [
                            [
                                'name' => 'Baking Tools',
                                'slug' => 'baking-tools'
                            ],
                            [
                                'name' => 'Flour',
                                'slug' => 'flour'
                            ],
                            [
                                'name' => 'Baking Ingredients',
                                'slug' => 'baking-ingredients'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Bakery & Bread',
                        'slug' => 'bakery-bread',
                        'children' => [
                            [
                                'name' => 'Breads',
                                'slug' => 'breads'
                            ],
                            [
                                'name' => 'Cakes',
                                'slug' => 'cakes'
                            ],
                            [
                                'name' => 'Cookies',
                                'slug' => 'cookies'
                            ],
                            [
                                'name' => 'Dips & Spread',
                                'slug' => 'dips-spread'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Frozen & Canned',
                        'slug' => 'frozen-canned',
                        'children' => [
                            [
                                'name' => 'Ice Cream',
                                'slug' => 'ice-cream'
                            ],
                            [
                                'name' => 'Frozen Snacks',
                                'slug' => 'frozen-snacks'
                            ],
                            [
                                'name' => 'Canned Foods',
                                'slug' => 'canned-foods'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Snacks',
                        'slug' => 'snacks',
                        'children' => [
                            [
                                'name' => 'Noodles',
                                'slug' => 'noodles'
                            ],
                            [
                                'name' => 'Pasta',
                                'slug' => 'pasta'
                            ],
                            [
                                'name' => 'Local Snacks',
                                'slug' => 'local-snacks'
                            ],
                            [
                                'name' => 'Candy & Chocolates',
                                'slug' => 'candy-chocolates'
                            ],
                            [
                                'name' => 'Biscuits',
                                'slug' => 'biscuits'
                            ],
                            [
                                'name' => 'Sauce & Dressing',
                                'slug' => 'sauce-dressing'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Beverages',
                        'slug' => 'beverages',
                        'children' => [
                            [
                                'name' => 'Tea',
                                'slug' => 'tea'
                            ],
                            [
                                'name' => 'Coffee',
                                'slug' => 'coffee'
                            ],
                            [
                                'name' => 'Soft Drinks',
                                'slug' => 'soft-drinks'
                            ],
                            [
                                'name' => 'Juice',
                                'slug' => 'juice'
                            ],
                            [
                                'name' => 'Powder Drinks',
                                'slug' => 'powder-drinks'
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Health & Personal Care',
                'slug' => 'health-personal-care',
                'children' => [
                    [
                        'name' => 'Health Care',
                        'slug' => 'health-care',
                        'children' => [
                            [
                                'name' => 'Food Suppliments',
                                'slug' => 'food-suppliments'
                            ],
                            [
                                'name' => 'First Aid',
                                'slug' => 'first-aid'
                            ],
                            [
                                'name' => 'Antiseptics',
                                'slug' => 'antiseptics'
                            ],
                        ]
                    ],
                    [
                        'name' => 'Personal Care',
                        'slug' => 'personal-care',
                        'children' => [
                            [
                                'name' => 'Hair Care',
                                'slug' => 'hair-care'
                            ],
                            [
                                'name' => 'Skin Care',
                                'slug' => 'skin-care'
                            ],
                            [
                                'name' => 'Oral Care',
                                'slug' => 'oral-care'
                            ],
                            [
                                'name' => 'Women\'s Care',
                                'slug' => 'womens-care'
                            ],
                            [
                                'name' => 'Men\'s Care',
                                'slug' => 'mens-care'
                            ],
                            [
                                'name' => 'Oral Care',
                                'slug' => 'oral-care'
                            ],
                        ]
                    ],
                ]
            ],
            [

                'name' => 'Pet Care',
                'slug' => 'pet-care',
                'children' => [
                    [
                        'name' => 'Cat Food',
                        'slug' => 'cat-food'
                    ],
                    [
                        'name' => 'Dog Food',
                        'slug' => 'dog-food'
                    ],
                    [
                        'name' => 'Other Pet Food',
                        'slug' => 'other-pet-food'
                    ],
                    [
                        'name' => 'Pet Accessories',
                        'slug' => 'pet-accessories'
                    ]
                ]

            ]
        ];
        $this->insertCategory($categories);
    }


    public function insertCategory($categories, $parent_id = NULL)
    {
        foreach ($categories as $cat) {
            $newCategory = new Category();
            $newCategory->name = $cat['name'];
            $newCategory->slug = $cat['slug'];
            if ($parent_id) {
                $newCategory->parent_id = $parent_id;
            }
            $newCategory->save();

            for ($i = 0; $i <= 5; $i++) {
                Product::factory([
                    'category_id' => $newCategory->id,
                    'seller_id' => 1 == 1 ? $this->sellers->random(1)->first()->id : null
                ])->create();
            }

            if (array_key_exists('children', $cat) && count($cat['children']) > 0) {
                $this->insertCategory($cat['children'], $newCategory->id);
            }
        }
    }
}
