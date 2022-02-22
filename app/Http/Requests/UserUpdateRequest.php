<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Super admin & customers with their own account
        if ((in_array(Auth::user()->role, [User::$SUPERADMIN, User::$CUSTOMER]) && Auth::id() == $this->user->id)) {
            return [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
                'mobile' => 'required|max:11|unique:users,mobile,' . $this->user->id,
            ];
        }
        // Super admin with any admin's account
        if (Auth::user()->role == User::$SUPERADMIN && Auth::id() != $this->user->id && $this->user->role != User::$CUSTOMER) {
            return [
                'name' => 'required|string|max:255',
            ];
        }
        // Admins with their own account
        if (Auth::user()->role == User::$ADMIN && Auth::id() == $this->user->id) {
            return [
                'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
                'mobile' => 'required|max:11|unique:users,mobile,' . $this->user->id,
            ];
        }

        return [];
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
        ];
    }
}
