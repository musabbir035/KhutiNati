<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SellerSeeder extends Seeder
{
    public function run()
    {
        if(!Storage::disk('public')->exists('images/sellers')) {
            Storage::disk('public')->makeDirectory('images/sellers');
        }
        Seller::factory(8)->create();
    }
}
