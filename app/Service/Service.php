<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class Service
{
    public static function uploadImage($image, $modelId, $storagePath = 'images')
    {
        $imageName = $image->hashName();
        $imageFinalName = $modelId . $imageName;

        if(!Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->makeDirectory($storagePath);
        }

        Storage::disk('public')->putFileAs($storagePath, $image, $imageFinalName);

        return $imageFinalName;
    }

    public static function updateImage($image, $modelId, $oldImageName = null, $storagePath = 'images')
    {
        // NOTE: When updating the image, if rhe model already has an image,
        // keep the existing image name and only update the extension according
        // to the new image's extension.
        $fileName = $oldImageName
            ? pathinfo($oldImageName, PATHINFO_FILENAME) . '.' . $image->extension()
            : $modelId . $image->hashName();

        // NOTE: If the new image has a different extension,
        // delete existing image and save the new image.
        // But if the extension is same as existing image,
        // then no need to delete (it will be overwriten).
        if ($oldImageName != $fileName && Storage::disk('public')->exists($storagePath . $oldImageName)) {
            Storage::disk('public')->delete($storagePath . $oldImageName);
        }
        if(Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->makeDirectory($storagePath);
        }
        Storage::disk('public')->putFileAs($storagePath, $image, $fileName);
        return $fileName;
    }
}
