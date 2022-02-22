<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $sellerId = $request->input('sellerId');
        $searchQuery = $request->input('searchQuery');
        $isOnSale = $request->input('isOnSale');
        $isFeatured = $request->input('isFeatured');

        return response([
            'products' => Product::withFilters(
                $categoryId,
                $searchQuery,
                $sellerId,
                $isOnSale,
                $isFeatured
            )->get()
        ], 200);

        // return Address::create([
        //     'name' => 'sdasd',
        //     'mobile' => 'asdasdasd',
        //     'address' => 'sadasdas',
        //     'upazila_id' => 1,
        //     'district_id' => 1,
        //     'division_id' => 1,
        //     'user_id' => 1
        // ])->id;
    }
}
