<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // NOTE: Generates unique slug
    public function generateSlug($name, $model, $id = 0)
    {
        $slug = Str::slug($name);
        $slugs = $model->select('slug')
            ->where('id', '!=', $id)
            ->where('slug', 'like', $slug . '%')
            ->get();
        if ($slugs->isEmpty()) {
            return $slug;
        }
        $i = 1;
        foreach ($slugs as $s) {
            $newSlug = $s . '-' . $i;
            if ($s != $newSlug) {
                return $newSlug;
            }
            $i++;
        }
    }
}
