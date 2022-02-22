<?php

namespace App\Service;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public static function deleteProduct($id)
    {
        try {
            $product = Product::with('orderPorduct')->findOrFail($id);
            if ($product->orderPorduct->count()) {
                return [
                    'title' => 'Request denied',
                    'message' => 'Cannot delete. This product has been ordered one or more times.',
                    'code' => 405
                ];
            }

            DB::transaction(function () use ($product) {
                if ($product->image && Storage::disk('public')->exists('images/products/' . $product->image)) {
                    Storage::disk('public')->delete('images/products/' . $product->image);
                }
                $product->delete();
            }, 3);

            return [
                'title' => 'Success',
                'message' => 'Product deleted.',
                'code' => 200
            ];
        } catch (Exception $e) {
            return [
                'title' => 'Error',
                'message' => 'Something went wrong.',
                'code' => 500
            ];
        }
    }
}
