<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Service\ProductService;
use App\Service\Service;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.product.create', [
            'categories' => Category::orWhereDoesntHave('children')->get(),
            'sellers' => Seller::all()
        ]);
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $product = Product::create($request->validated() + [
                    'slug' => $this->generateSlug($request->input('name'), new Product())
                ]);
                if ($request->hasFile('image')) {
                    $product->image = Service::uploadImage($request->file('image'), $product->id, 'images/products');
                    $product->save();
                }
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => 'Something went wrong.'
            ]);
        }

        return redirect()->route('admin.products.create')->with([
            'title' => 'Success',
            'message' => 'Product added.',
            'code' => 200
        ]);
    }

    public function show($id)
    {
        return view('admin.product.show', ['product' => Product::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view('admin.product.edit', [
            'product' => Product::findOrFail($id),
            'categories' => Category::orWhereDoesntHave('children')->get(),
            'sellers' => Seller::all()
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $product = Product::findOrFail($id);
                $name = $product->name;
                $newName = $request->input('name');

                // NOTE: if name is not changed, update product else
                // generate new slug and then update product
                $slug = $name == $newName
                    ? $product->slug
                    : $this->generateSlug($newName, new Product(), $id);

                if ($request->hasFile('image')) {
                    $imageName = Service::updateImage($request->file('image'), $product->id, $product->image, 'images/products');
                    $product->update($request->safe()->except('image') + [
                        'image' => $imageName,
                        'slug' => $slug
                    ]);
                } else {
                    $product->update($request->validated() + [
                        'slug' => $slug
                    ]);
                }
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => 'Something went wrong.'
            ]);
        }

        return redirect()->route('admin.products.show', ['product' => $id])->with([
            'title' => 'Success',
            'message' => 'Product updated.',
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        $delOparation = ProductService::deleteProduct($id);

        if ($delOparation['code'] == 200) {
            return redirect()->route('admin.products.index')->with($delOparation);
        }

        return back()->with($delOparation);
    }
}
