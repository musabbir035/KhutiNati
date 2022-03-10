<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponCodeRequest;
use App\Models\CouponCode;

class CouponController extends Controller
{
    public function create()
    {
        return view('admin.coupon-code.create');
    }

    public function store(CouponCodeRequest $request)
    {
        CouponCode::create($request->validated());
        return redirect()->route('admin.coupons.create')->with([
            'title' => 'Success',
            'message' => 'Coupon code added.',
            'code' => 200
        ]);
    }

    public function edit($id)
    {
        return view('admin.coupon-code.edit', [
            'coupon' => CouponCode::find($id)
        ]);
    }

    public function update(CouponCodeRequest $request, CouponCode $coupon)
    {
        $coupon->update($request->validated());
        return redirect()->route('admin.coupons.index')->with([
            'title' => 'Success',
            'message' => 'Coupon code updated.',
            'code' => 200
        ]);
    }
}
