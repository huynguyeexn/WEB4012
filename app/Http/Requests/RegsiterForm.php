<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegsiterForm extends FormRequest
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
            //
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*()_+-=]).*$/',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Bạn phải nhập tên.",
            'name.string' => "Tên phải là chữ cái.",
            'name.min' => "Tên phải từ 3 ký tự.",
            'email.required' => "Bạn phải nhập email.",
            'email.email' => "Email bạn nhập không đúng định dạng.",
            'email.unique' => "Email đã tồn tại.",
            'password.required' => "Bạn phải nhập mật khẩu.",
            'password.confirmed' => "Xác nhận mật khẩu không khớp.",
            'password.min' => "Mật khẩu phải lớn hơn 8 ký tự, có chứa kí tự viêt HOA, có chứa kí tự số, và ký tự đặc biệt",
            'password.regex' => "Mật khẩu phải lớn hơn 8 ký tự, có chứa kí tự viêt HOA, có chứa kí tự số, và ký tự đặc biệt",
        ];
    }
}
