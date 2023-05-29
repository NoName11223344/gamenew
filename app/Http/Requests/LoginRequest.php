<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'user_name' => [
                'required',
                'regex:/^[a-z0-9\s]{1,15}$/',
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => "Tên đăng nhập không được để trống.",
            'user_name.regex' => "Tên đăng nhập không hợp lệ.",
            'password.required' => "Mật khẩu không được để trống.",
            'password.regex' => "Mật khẩu không chính xác",
        ];
    }
}
