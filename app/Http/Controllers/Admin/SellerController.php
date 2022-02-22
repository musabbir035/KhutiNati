<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Product;
use App\Models\Seller;
use App\Service\SellerService;
use App\Service\Service;
use Exception;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function create()
    {
        return view('admin.seller.create');
    }

    public function store(SellerRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $seller = Seller::create($request->validated());
                if ($request->hasFile('image')) {
                    $seller->image = Service::uploadImage($request->file('image'), $seller->id, 'images/sellers');
                    $seller->save();
                }
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => 'Something went wrong'
            ]);
        }

        return redirect()->route('admin.sellers.create')->with([
            'message' => 'Seller added',
            'code' => 200
        ]);
    }

    public function show($id)
    {
        return view('admin.seller.show', [
            'seller' => Seller::withCount('products')->findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('admin.seller.edit', ['seller' => Seller::findOrFail($id)]);
    }

    public function update(SellerRequest $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $seller = Seller::findOrFail($id);

                if ($request->hasFile('image')) {
                    $imageName = Service::updateImage($request->file('image'), $seller->id, $seller->image, 'images/sellers');
                    $seller->update($request->safe()->except('image') + [
                        'image' => $imageName
                    ]);
                } else {
                    $seller->update($request->validated());
                }
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => 'Something went wrong'
            ]);
        }

        return redirect()->route('admin.sellers.index')->with([
            'message' => 'Seller updated',
            'code' => 200
        ]);
    }

    public function destroy($id)
    {
        $delOparation = SellerService::deleteSeller($id);

        if ($delOparation['code'] == 200) {
            return redirect()->route('admin.sellers.index')->with($delOparation);
        }

        return back()->with($delOparation);
    }
}
