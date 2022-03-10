<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:11|min:11',
            'email' => 'sometimes|nullable|email|max:255',
            'address' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'district_id' => 'required|exists:districts,id',
            'division_id' => 'required|exists:divisions,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.custom.name.required'),
            'mobile.required' => trans('validation.custom.mobile.required'),
            'mobile.max' => trans('validation.custom.mobile.valid'),
            'mobile.min' => trans('validation.custom.mobile.valid'),
            'address.required' => trans('validation.custom.address.required'),
            'area_id.exists' => trans('validation.custom.area.exists'),
            'area_id.required' => trans('validation.custom.area.required'),
            'district_id.exists' => trans('validation.custom.district.exists'),
            'district_id.required' => trans('validation.custom.district.required'),
            'division_id.exists' => trans('validation.custom.division.exists'),
            'division_id.required' => trans('validation.custom.division.required'),
        ];
    }
}
