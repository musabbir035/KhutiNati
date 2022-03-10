<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Division;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($userId)
    {
        return view('main.order.index', [
            'orders' => Order::where('user_id', $userId)->orderBy('date', 'desc')->paginate(15)
        ]);
    }

    public function checkout()
    {
        return view('main.order.checkout', [
            'divisions' => Division::all()
        ]);
    }

    public function storeAddress(AddressRequest $requset)
    {
        // if (Auth::check()) {
        //     $address = Address::create($requset->validated() + [
        //         'user_id' => Auth::id()
        //     ]);
        // } else {
        //     $address = Address::create($requset->validated());
        // }
        return view('main.order.confirm', [
            //'address' => $address
        ]);
    }
}
