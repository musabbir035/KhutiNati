<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $sellerId = $request->input('seller_id');
        $searchQuery = $request->input('search_query');
        $isOnSale = $request->input('is_on_sale');
        $isFeatured = $request->input('is_featured');

        return response([
            'products' => Product::withFilters(
                $categoryId,
                $searchQuery,
                $sellerId,
                $isOnSale,
                $isFeatured
            )->get()
        ], 200);
    }
}
