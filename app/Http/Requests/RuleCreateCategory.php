<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class RuleCreateCategory extends FormRequest
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
        if($this->parent_id !== null) {
            $parent = Category::find($this->parent_id);
            $this->slug = $parent->slug.'/'.$this->slug;
        };
        return [
            'name' => 'required|string|min:3|max:20',
            'slug' => 'required|string|unique:categories,slug|min:3',
            'parent_id' => 'integer|nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập :attribute.',
            'name.min' => ':attribute quá ngắn (dưới 3 ký tự).',
            'name.max' => ':attribute quá dài (trên 20 ký tự).',
            'slug.required' => 'Bạn cần nhập :attribute.',
            'slug.min' => ':attribute quá ngắn (dưới 3 ký tự).',
            'slug.unique' => ':attribute đã tồn tại.',
            'parent_id.integer' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'slug' => 'Đường dẫn',
            'parent_id' => 'Danh mục cha',
        ];
    }
}
