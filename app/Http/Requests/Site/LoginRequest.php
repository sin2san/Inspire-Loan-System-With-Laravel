<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {

    public function rules()
    {
        return [
            'login_email' => 'required|email',
            'login_pass' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'login_email.required' => 'Please enter the email',
            'login_pass.required' => 'Please enter the password'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
