<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to false if you want to restrict this form request.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Nama' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
            'Email' => 'required|email|unique:students,Email',
            'Phone' => 'required|string|unique:students,Phone',
            'Alamat' => 'nullable|string|max:500',
        ];
    }
}