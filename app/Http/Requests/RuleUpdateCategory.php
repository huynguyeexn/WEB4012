<?php

namespace App\Http\Requests;

use App\Models\Category;
use Clockwork\Request\Request;
use Illuminate\Foundation\Http\FormRequest;

class RuleUpdateCategory extends FormRequest
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
    public function rules(Request $request)
    {
        if ($this->parent_id !== null) {
            $parent = Category::find($this->parent_id);
            $this->slug = $parent->slug . '/' . $this->slug;
        };
        return [
            'name' => 'required|string|min:3|max:20',
            'slug' => "required|string|min:3|unique:categories,slug,$this->slug,slug",
            'parent_id' => 'integer|nullable',
        ];
    }
}
