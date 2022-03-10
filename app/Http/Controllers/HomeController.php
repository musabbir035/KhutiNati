<?php

namespace App\Http\Controllers;

use App\Models\BannerImage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // dd(BannerImage::where('type', BannerImage::$SLIDER)
        //     ->where('status', BannerImage::$ACTIVE)
        //     ->orderBy('created_at', 'desc')
        //     ->limit(5)->get());
        return view('main.home', [
            //'categories' => Category::doesntHave('parent')->get(),
            'sales' => Product::whereNotNull('discounted_price')->limit(8)->get(),
            'sliderImages' => BannerImage::where('type', BannerImage::$SLIDER)
                ->where('status', BannerImage::$ACTIVE)
                ->orderBy('created_at', 'desc')
                ->limit(5)->get()
        ]);
    }
}
