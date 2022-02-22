<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'sometimes|nullable|mimes:png,jpg,webp|max:1024'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.custom.name.required'),
            'parent_id.exists' => trans('validation.custom.category_id.exists.parent'),
            'image.mimes' => trans('validation.custom.image.mimes'),
            'image.max' => trans('validation.custom.image.max'),
        ];
    }
}
