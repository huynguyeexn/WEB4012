<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleCreateTag extends FormRequest
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
            'name' => 'required|string|unique:tags,name|min:3|max:50',
            'slug' => 'required|string|unique:tags,slug|min:3',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập :attribute.',
            'name.min' => ':attribute quá ngắn (dưới 3 ký tự).',
            'name.max' => ':attribute quá dài (trên 20 ký tự).',
            'name.unique' => ':attribute đã tồn tại.',
            'slug.required' => 'Bạn cần nhập :attribute.',
            'slug.min' => ':attribute quá ngắn (dưới 3 ký tự).',
            'slug.unique' => ':attribute đã tồn tại.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên thẻ',
            'slug' => 'Đường dẫn',
        ];
    }
}
