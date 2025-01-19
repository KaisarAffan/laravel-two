<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah jika diperlukan untuk membatasi akses
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'Name' => 'required|string|max:255|unique:grades,Name', // Validasi untuk kolom 'Name'
            'department_id' => 'required|integer|exists:departments,id', // Validasi untuk 'department_id'
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'Name.required' => 'The grade name is required.',
            'Name.string' => 'The grade name must be a valid string.',
            'Name.max' => 'The grade name must not exceed 255 characters.',
            'department_id.required' => 'The department ID is required.',
            'department_id.integer' => 'The department ID must be a valid integer.',
            'department_id.exists' => 'The selected department ID is invalid.',
        ];
    }
}