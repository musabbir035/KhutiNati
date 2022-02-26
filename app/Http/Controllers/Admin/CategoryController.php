<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Service\CategoryService;
use App\Service\Service;
use Exception;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.category.create', [
            'categories' => Category::orWhereDoesntHave('products')->get()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $Category = Category::create([
                    'name' => $request->input('name'),
                    'parent_id' => $request->input('parent_id'),
                    'slug' => $this->generateSlug($request->input('name'), new Category())
                ]);

                if ($request->hasFile('image')) {
                    $Category->image = Service::uploadImage($request->file('image'), $Category->id, 'images/categories');
                    $Category->save();
                }
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => $e->getMessage()
            ]);
        }

        return redirect()->route('admin.categories.create')->with([
            'title' => 'Success',
            'message' => 'Category added.',
            'code' => 200
        ]);
    }

    public function show(Category $category)
    {
        return view('admin.category.show', [
            'category' => $category,
            'products_count' => $category->products->count()
        ]);
    }

    public function edit($id)
    {
        return view('admin.category.edit', [
            'category' => Category::findOrFail($id),
            'categories' => Category::orWhereDoesntHave('products')->get()
        ]);
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $newName = $request->input('name');
                $category = Category::findOrFail($id);
                $slug = $category->name == $newName
                    ? $category->slug
                    : $this->generateSlug($newName, new Category(), $id);

                if ($request->hasFile('image')) {
                    $imageName = Service::updateImage($request->file('image'), $id, $category->image, 'images/categories');
                    $category->update($request->safe()->except('image') + [
                        'image' => $imageName,
                        'slug' => $slug
                    ]);
                } else {
                    $category->update($request->validated() + [
                        'slug' => $slug
                    ]);
                }
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => 'Something went wrong.'
            ]);
        }

        return redirect()->route('admin.categories.show', ['category' => $id])->with([
            'title' => 'Success',
            'message' => 'Category updated.',
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        $delOparation = CategoryService::deleteCategory($id);

        if ($delOparation['code'] == 200) {
            return redirect()->route('admin.categories.index')->with($delOparation);
        }

        return back()->with($delOparation);
    }
}
