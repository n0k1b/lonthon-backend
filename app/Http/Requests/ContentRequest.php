<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|max:60',
            'category'=>'required',
            'subcategory'=>'required',
            'genre'=>'required',
            // 'feature_image'=>'required',
            // 'thumbnail_image'=>'required',
            'summary'=>'required',
            'price'=>'required'
        ];
    }
}
