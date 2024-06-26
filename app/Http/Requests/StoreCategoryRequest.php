<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:categories'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function message()
    {

        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'name.unique' => 'Name must be unique',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        return $errors;
        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], 422));
    }
}
