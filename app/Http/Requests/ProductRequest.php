<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'unit' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|lt:price',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|integer|between:1,2',
            'inventory' => 'required|integer|min:0',
            'image' => 'sometimes|nullable|mimes:png,jpg,webp|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.custom.name.required'),
            'unit.required' => trans('validation.custom.unit.required'),
            'price.required' => trans('validation.custom.price.required'),
            'price.min' => trans('validation.custom.price.min'),
            'discounted_price.lt' => trans('validation.custom.discounted_price.lt'),
            'category_id.exists' => trans('validation.custom.category_id.exists'),
            'is_featured.integer' => trans('validation.custom.is_featured.*'),
            'is_featured.between' => trans('validation.custom.is_featured.*'),
            'inventory.required' => trans('validation.custom.inventory.required'),
            'inventory.integer' => trans('validation.custom.inventory.integer'),
            'inventory.min' => trans('validation.custom.inventory.min'),
            'image.mimes' => trans('validation.custom.image.mimes'),
            'image.max' => trans('validation.custom.image.max'),
        ];
    }
}
