<?php namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest {

    public function rules()
    {
        return [
            'term' => 'required',
            'amount' => 'numeric|min:10000|required'
        ];
    }

    public function messages()
    {
        return [
            'term.required'  => 'Please select the loan term',
            'amount.required'  => 'Please enter the loan amount',
            'amount.numeric'  => 'Please enter correct value'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
