<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100|unique:projects,name',
            'status' => 'required|string|in:active,inactive',
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El campo name es requerido.',
            'name.string' => 'El campo name debe ser una cadena de texto.',
            'name.min' => 'El campo name debe tener al menos 3 caracteres.',
            'name.max' => 'El campo name debe tener como máximo 100 caracteres.',
            'name.unique' => 'El campo name ya existe.',
            'status.required' => 'El campo status es requerido.',
            'status.in' => 'El campo status debe ser uno de los siguientes: active, inactive.',
            'description.string' => 'El campo description debe ser una cadena de texto.',
        ];
    }
}
