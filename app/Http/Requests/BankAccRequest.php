<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankAccRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'acc_name' => [
//                'required',
//                'regex:/^[A-Za-z ]+$/'
//            ],
            'acc_no' => 'required|numeric',
            'bank_no' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'acc_name.required' => "Tài khoản không được để trống.",
            'acc_name.regex' => "Tài khoản phải viết hoa và không chứa ký tự đặc biệt.",
            'acc_no.required' => "Số tài khoản không được để trống.",
            'bank_no.required' => "Ngân hàng không được để trống.",
        ];
    }
}
