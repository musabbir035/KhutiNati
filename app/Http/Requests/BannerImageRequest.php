<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'image' => 'required|mimes:png,jpg,webp|max:1024',
            'title' => 'required|string|max:255',
            'subtext' => 'sometimes|string|max:255',
            'url' => 'sometimes|string',
            'type' => 'required|integer|between:1,2'
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['image'] = ['sometimes', 'nullable', 'mimes:png,jpg,webp', 'max:1024'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'image.required' => trans('validation.custom.image.required'),
            'image.mimes' => trans('validation.custom.image.mimes'),
            'image.max' => trans('validation.custom.image.max'),
            'title.required' => trans('validation.custom.title.required'),
            'type' => trans('validation.custom.type.required')
        ];
    }
}
