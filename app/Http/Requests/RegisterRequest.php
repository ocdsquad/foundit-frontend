<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'fullname' => ['required', 'min:4', 'max:100', 'regex:/^[a-zA-Z\\s]*$/'],
            'email' => ['required', 'max:100', 'regex:/^(?=.{1,64}@.{1,255}$)(?:(?![.])[a-zA-Z0-9._%+-]+(?:(?<!\\\\)[.][a-zA-Z0-9-]+)*?)@[a-zA-Z0-9.-]+(?:\\.[a-zA-Z]{2,50})+$/'],
            'phone_number' => ['required', 'regex:/^(62|\\+62|0)8[0-9]{9,13}$/'],
            'username' => ['required', 'min:3', 'max:50', 'regex:/^[a-z0-9.]*$/'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@_#\\-$]).*$/', 'confirmed']
        ];
    }
}
