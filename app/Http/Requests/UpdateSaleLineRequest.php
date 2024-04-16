<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSaleLineRequest extends FormRequest
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
            'product_id' =>  ['required', 'integer', 'exists:products,id'],
            'sale_id' =>  ['required', 'integer', 'exists:sale,id'],
        ];
    }

    public function message()
    {

        return [

            'sale_id.required' => 'Sale is required',
            'sale_id.integer' => 'Sale must be integer',
            'sale_id.exists' => 'Sale must exist',

            'product_id.required' => 'Product is required',
            'product_id.integer' => 'Product must be integer',
            'product_id.exists' => 'Product must exist',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], 422));
    }
}
