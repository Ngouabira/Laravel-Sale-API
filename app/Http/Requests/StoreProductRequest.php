<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>  ['required', 'string', 'unique:products'],
            'price' =>  ['required'],
            'category_id' =>  ['required', 'integer', 'exists:categories,id']
        ];
    }

    public function message()
    {

        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'name.unique' => 'Name must be unique',

            'price.required' => 'Price is required',

            'category_id.required' => 'Category is required',
            'category_id.integer' => 'Category must be integer',
            'category_id.exists' => 'Category must exist',
        ];
    }
}
