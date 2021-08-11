<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleUpdateUser extends FormRequest
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
            'email' => "required|email|unique:users,email,$this->email,email",
            'new_password' => 'nullable|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*()_+-=]).*$/',
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
            'new_password.confirmed' => "Xác nhận mật khẩu không khớp.",
            'new_password.min' => "Mật khẩu mới phải lớn hơn 8 ký tự, có chứa kí tự viêt HOA, có chứa kí tự số, và ký tự đặc biệt",
            'new_password.regex' => "Mật khẩu mới phải lớn hơn 8 ký tự, có chứa kí tự viêt HOA, có chứa kí tự số, và ký tự đặc biệt",
        ];
    }
}
