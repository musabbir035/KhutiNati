<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:sellers',
            'mobile' => 'nullable|max:11|regex:/(01)[1-9]{9}/|unique:sellers',
            'address' => 'nullable|string|max:255',
            'image' => 'sometimes|nullable|mimes:png,jpg,webp|max:1024'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['mobile'] = [
                'required',
                'string',
                'max:11',
                'regex:/(01)[0-9]{9}/',
                'unique:sellers,mobile,' . $this->seller
            ];
            $rules['email'] = [
                'nullable',
                'email',
                'unique:sellers,email,' . $this->seller
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.custom.name.required'),
            'mobile.max' => trans('validation.custom.mobile.valid'),
            'mobile.regex' => trans('validation.custom.mobile.valid'),
            'image.mimes' => trans('validation.custom.image.mimes'),
            'image.max' => trans('validation.custom.image.max')
        ];
    }
}
