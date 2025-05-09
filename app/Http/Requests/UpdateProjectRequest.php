<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            "name"=> "required|min:3|max:100",
            "description"=> "nullable",
            "status"=> "required|string|in:active,inactive",
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El campo name es requerido.',
            'name.min' => 'El campo name debe tener al menos 3 caracteres.',
            'name.max' => 'El campo name debe tener como máximo 100 caracteres.',
            'description.required' => 'El campo description es requerido.',
            'status.required' => 'El campo status es requerido.',
            'status.string' => 'El campo status debe ser una cadena de texto.',
            'status.in' => 'El campo status debe tener uno de los siguientes valores: active, inactive.',
        ];
    }
}
