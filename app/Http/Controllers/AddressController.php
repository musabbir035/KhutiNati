<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index($userId)
    {
        $addresses = Address::where('user_id', $userId)->get();

        return view('', [
            'addresses' => $addresses
        ]);
    }

    public function store(AddressRequest $request)
    {
        $address = Address::create($request->validated());

        return response()->json([
            'address' => $address,
            'message' => 'Address saved.'
        ], 200);
    }
}
