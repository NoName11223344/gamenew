<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'regex:/^[a-z0-9\s]{8,15}$/',
                'unique:users'
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,15}$/',
                'confirmed'
            ],
            'password_confirmation' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'zalo' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'user_name.*' => "Tên đăng nhập phải là chữ thường không dấu và dài 8-15 ký tự.",
            'password.confirmed' => "Mật khẩu không không giống nhau.",
            'password.regex' => "Mật khẩu phải có 8 - 15 ký tự, không được chứa ký tự đặc biệt và có cả chữ hoa và chữ thường.",
            'password.required' => "Mật khẩu phải có 8 - 15 ký tự, không được chứa ký tự đặc biệt và có cả chữ hoa và chữ thường.",
            'password_confirmation.required' => "Xác nhận mật khẩu không được để trống.",
            'name.required' => "Tên không được để trống.",
            'phone.required' => "Số điện thoại không được để trống.",
            'zalo.required' => "Số điện thoại không được để trống.",
        ];
    }
}
