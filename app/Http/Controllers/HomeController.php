<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('main.home', [
            'categories' => Category::doesntHave('parent')->get(),
            'sales' => Product::whereNotNull('discounted_price')->limit(8)->get()
        ]);
    }
}
