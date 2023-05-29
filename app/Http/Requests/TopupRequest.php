<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopupRequest extends FormRequest
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
            'acc_no' => 'required',
            'amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'acc_no.required' => "Số tài khoản không được để trống",
            'amount.required' => "Số tiền không được để trống",
            'amount.numeric' => "Số tiền phải là một chữ số",
        ];
    }
}
