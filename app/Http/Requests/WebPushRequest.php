<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebPushRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'endpoint' => 'required',
            'keys.auth' => 'required',
            'keys.p256dh' => 'required'
        ];
    }
}
