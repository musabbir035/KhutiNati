<?php

namespace App\Service;

use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public static function deleteCategory($id)
    {
        try {
            $category = Category::with('products')->findOrFail($id);
            if ($category->children->count()) {
                return [
                    'title' => 'Request denied',
                    'message' => 'Cannot delete. This category has one or more child categories.',
                    'code' => 405
                ];
            }
            if ($category->products->count()) {
                return [
                    'title' => 'Request denied',
                    'message' => 'Cannot delete. This category has one or more products.',
                    'code' => 405
                ];
            }

            DB::transaction(function () use ($category) {
                if ($category->image && Storage::disk('public')->exists('images/categories/' . $category->image)) {
                    Storage::disk('public')->delete('images/categories/' . $category->image);
                }
                $category->delete();
            }, 3);

            return [
                'title' => 'Success',
                'message' => 'Category deleted.',
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
