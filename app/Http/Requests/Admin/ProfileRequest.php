<?php namespace App\Http\Requests\Admin;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest {

    public function rules()
    {
        $loginUser = Auth::user();

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$loginUser->id,
            'image' => 'mimes:jpeg,jpg,png|dimensions:width=300,height=300',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Please enter the name',
            'email.required'  => 'Please enter the email',
            'email.unique'  => 'The email has already been taken',
            'password.required'  => 'Please enter the password'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
