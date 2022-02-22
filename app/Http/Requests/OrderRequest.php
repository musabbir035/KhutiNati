<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'addressId' => 'nullable|exists:addresses,id',
            'name' => 'required_without:addressId|string|max:255',
            'mobile' => 'required_without:addressId|string|max:11',
            'address' => 'required_without:addressId|string|max:255',
            'upazila_id' => 'required_without:addressId|exists:upazilas,id',
            'district_id' => 'required_without:addressId|exists:districts,id',
            'division_id' => 'required_without:addressId|exists:divisions,id',
            'orderProducts.*.id' => 'required|exists:products,id',
            'orderProducts.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required_without' => trans('validation.custom.name.required'),
            'mobile.required_without' => trans('validation.custom.mobile.required'),
            'mobile.max' => trans('validation.custom.mobile.valid'),
            'address.required_without' => trans('validation.custom.address.required'),
            'upazila_id.exists' => trans('validation.custom.upazila.exists'),
            'upazila_id.required_without' => trans('validation.custom.upazila.required'),
            'district_id.exists' => trans('validation.custom.district.exists'),
            'district_id.required_without' => trans('validation.custom.district.required'),
            'division_id.exists' => trans('validation.custom.division.exists'),
            'division_id.required_without' => trans('validation.custom.division.required'),
            'orderProducts.*.id.required' => trans('validation.invalid-request'),
            'orderProducts.*.id.exists' => trans('validation.custom.product.quantity'),
        ];
    }
}
