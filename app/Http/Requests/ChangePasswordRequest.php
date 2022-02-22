<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_pass' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail(trans('validation.current_password'));
                }
            }],
            'new_pass' => ['required', 'min:8', 'max:255', 'string', function ($attribute, $value, $fail) {
                if (Hash::check($value, Auth::user()->password)) {
                    $fail(trans('validation.custom.new_password.same_as_current'));
                }
            }],
            'new_pass_confirm' => 'required|same:new_pass',
        ];
    }

    public function messages()
    {
        return [
            'current_pass' => trans('validation.custom.current_password.required'),
            'new_pass.required' => trans('validation.custom.new_password.required'),
            'new_pass.min' => trans('validation.custom.password.min'),
            'new_pass.max' => trans('validation.custom.password.max'),
            'new_pass_confirm.required' => trans('validation.custom.new_password_confirm.required'),
            'new_pass_confirm.same' => trans('validation.custom.new_password_confirm.same'),
        ];
    }
}
