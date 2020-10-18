<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest {

    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'title' => 'max:250',
            'favicon' => 'mimes:jpeg,jpg,png',
            'logo' => 'mimes:jpeg,jpg,png',
            'keywords' => 'max:500',
            'description' => 'max:1000',
            'email' => 'required|email',
            'phone' => 'nullable|regex:/^\+?[^a-zA-Z]{9,}$/',
            'mobile' => 'nullable|regex:/^\+?[^a-zA-Z]{9,}$/'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Please enter the name',
            'email.required'  => 'Please enter the email'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
