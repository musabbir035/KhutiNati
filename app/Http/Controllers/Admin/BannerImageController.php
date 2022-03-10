<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerImageRequest;
use App\Models\BannerImage;
use App\Service\Service;
use Exception;
use Illuminate\Support\Facades\DB;

class BannerImageController extends Controller
{
    public function create()
    {
        return view('admin.banner-image.create');
    }

    public function store(BannerImageRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $bannerImage = BannerImage::create($request->safe()->except(['image']) + [
                    'status' => 1
                ]);
                $bannerImage->image = Service::uploadImage($request->file('image'), $bannerImage->id, 'images/banners');
                $bannerImage->save();
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => $e->getMessage()
            ]);
        }

        return redirect()->route('admin.banner-images.create')->with([
            'title' => 'Success',
            'message' => 'Banner image added.',
            'code' => 200
        ]);
    }

    public function edit(BannerImage $banner_image)
    {
        return view('admin.banner-image.edit', [
            'image' => $banner_image
        ]);
    }

    public function update(BannerImageRequest $request, BannerImage $banner_image)
    {
        if (!$request->has('image') || !$request->file('image')) {
            $banner_image->update($request->safe()->except(['image']));
            return redirect()->route('admin.banner-images.index', ['image' => $banner_image])->with([
                'title' => 'Success',
                'message' => 'Banner image updated.',
                'code' => 200
            ]);
        }

        try {
            DB::transaction(function () use ($request, $banner_image) {
                $oldImageName = $banner_image->image;
                $newImageName = Service::updateImage($request->file('image'), $banner_image->id, $oldImageName, 'images/banners');
                $banner_image->update($request->safe()->except(['image']) + [
                    'image' => $newImageName
                ]);
            }, 3);
        } catch (Exception $e) {
            return back()->withInput($request->input())->with([
                'submit_error' => $e->getMessage()
            ]);
        }

        return redirect()->route('admin.banner-images.index')->with([
            'title' => 'Success',
            'message' => 'Banner image updated.',
            'code' => 200
        ]);
    }
}
