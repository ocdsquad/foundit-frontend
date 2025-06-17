<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'description' => ['required', 'string', 'min:20', 'max:255'],
        'chronology' => ['required', 'string', 'min:20', 'max:255'],
        'status' => ['required', 'regex:/^(FRESH|ON_PROGRESS|FOUND)$/'],
        'category_id' => ['required', 'integer', 'min:1'],
        'location' => ['required', 'string', 'min:5', 'max:255'],
        ];
    }
}
