<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'mobile' => 'required|unique:users|max:11|regex:/(01)[1-9]{9}/',
            'password' => 'required|min:8|max:255|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.custom.name.required'),
            'email.required' => trans('validation.custom.email.required'),
            'email.unique' => trans('validation.custom.email.unique'),
            'mobile.required' => trans('validation.custom.mobile.required'),
            'mobile.max' =>  trans('validation.custom.mobile.valid'),
            'mobile.regex' => trans('validation.custom.mobile.valid'),
            'mobile.unique' => trans('validation.custom.mobile.unique'),
            'password.required' => trans('validation.custom.password.required'),
            'password.min' => trans('validation.custom.password.min'),
            'password.max' => trans('validation.custom.password.max'),
        ];
    }
}
