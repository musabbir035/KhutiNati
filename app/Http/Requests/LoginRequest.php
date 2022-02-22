<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => ['required', 'string', function ($attribute, $value, $fail) {
                $user = User::withTrashed()->where('email', $value)->orWhere('mobile', $value)->first();
                if (!$user) {
                    $fail(trans('validation.custom.username.not_found'));
                }
                if ($user && $user->deleted_at) {
                    $fail(trans('validation.custom.username.deactivated'));
                }
            }],
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => trans('validation.custom.username.required'),
            'password.required' => trans('validation.custom.password.required'),
        ];
    }
}
