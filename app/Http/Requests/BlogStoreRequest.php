<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'category' => 'required|integer|exists:App\Models\Category,id',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'slug' => 'required|string|max:50|unique:App\Models\Blog,slug',
        ];
    }
}
