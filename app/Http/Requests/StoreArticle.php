<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticle extends FormRequest
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
            'name' => 'required|between:5,100',
            'slug' => [
                'required',
                'regex:/^[-_0-9a-z]+$/i',
                Rule::unique('articles')->ignore($this->get('slug'), 'slug'),
            ],
            'description' => 'required|max:255',
            'text' => 'required',
            'is_published' => 'nullable'
        ];
    }

}
