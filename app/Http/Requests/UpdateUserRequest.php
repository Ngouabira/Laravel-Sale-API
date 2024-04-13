<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' =>  ['required', 'string'],
            'name' =>  'required|email|unique:users,name,' . $this->user->id,
            'password' =>  ['required'],
            'role' =>  ['required']
        ];
    }

    public function message()
    {

        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'name.unique' => 'Name must be unique',

            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
            'email.unique' => 'Email must be unique',

            'password.required' => 'Password is required',
            'role.required' => 'Role is required',
        ];
    }
}
