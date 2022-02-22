<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($userId)
    {
        return view('main.order.index', [
            'orders' => Order::where('user_id', $userId)->orderBy('date', 'desc')->paginate(15)
        ]);
    }
}
