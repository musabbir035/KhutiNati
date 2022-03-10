<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponCodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'code' => 'required|string|max:255|unique:coupon_codes,code',
            'discount_percentage' => 'required|integer|between:1,99',
            'maximum_discount' => 'nullable|integer|min:1',
            'validity_start' => 'required|date_format:Y-m-d\TH:i',
            'validity_end' => 'required|date_format:Y-m-d\TH:i'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['code'] = 'required|string|max:255||unique:coupon_codes,code,' . $this->coupon->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'code.required' => trans('validation.custom.code.required'),
            'code.min' => trans('validation.custom.code.max'),
            'code.unique' => trans('validation.custom.code.unique'),
            'discount_percentage.required' => trans('validation.custom.discount_percentage.required'),
            'discount_percentage.integer' => trans('validation.custom.discount_percentage.integer'),
            'discount_percentage.between' => trans('validation.custom.discount_percentage.between'),
            'maximum_discount.integer' => trans('validation.custom.maximum_discount.integer'),
            'maximum_discount.min' => trans('validation.custom.maximum_discount.min'),
            'validity_start.required' => trans('validation.custom.validity_start.required'),
            'validity_end.required' => trans('validation.custom.validity_end.required')
        ];
    }
}
