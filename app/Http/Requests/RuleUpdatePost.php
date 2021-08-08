<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleUpdatePost extends FormRequest
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
            'title' => 'required|string|max:100',
            'desc' => 'required|string|max:255',
            'content' => 'required|string',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cat_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Bạn cần nhập :attribute.',
            'title.string' => ':attribute phải là ký tự.',
            'title.max' => ':attribute quá dài. (phải ít hơn 100 ký tự)',
            'desc.required' => 'Bạn cần nhập :attribute.',
            'desc.string' => ':attribute phải là ky tự',
            'desc.max' => ':attribute quá dài. (phải ít hơn 255 ký tự)',
            'content.required' => 'Bạn cần nhập :attribute.',
            'content.string' => ':attribute phải là ký tự.',
            'thumb.image' => ':attribute bạn tải lên không phải là hình ảnh.',
            'thumb.nimes' => ':attribute chỉ được tải lên các file jpeg,png,jpg,gif,svg',
            'thumb.max' => ':attribute bạn tải lên quá nặng. (phải nhỏ hơn 2mb)',
            'cat_id.exists' => ':attribute bạn nhập không tồn tại',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'desc' => 'Tóm tắt',
            'content' => 'Nội dung',
            'thumb' => 'Ảnh đại diện',
            'cat_id' => 'Danh mục',
        ];
    }
}
