<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'project_id' => 'required|uuid|exists:projects,id',
            'title' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',
            'status' => 'required|string|in:pending,in_progress,done',
            'priority' => 'required|string|in:low,medium,high',
            'due_date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'project_id.required' => 'El campo project_id es requerido.',
            'project_id.uuid' => 'El campo project_id debe ser un UUID válido.',
            'project_id.exists' => 'El project_id proporcionado no existe.',
            'title.required' => 'El campo title es requerido.',
            'title.string' => 'El campo title debe ser una cadena de texto.',
            'title.min' => 'El campo title debe tener al menos 3 caracteres.',
            'title.max' => 'El campo title debe tener como máximo 100 caracteres.',
            'description.string' => 'El campo description debe ser una cadena de texto.',
            'status.required' => 'El campo status es requerido.',
            'status.string' => 'El campo status debe ser una cadena de texto.',
            'status.in' => 'El campo status debe ser uno de los siguientes: pending, in_progress, done.',
            'priority.required' => 'El campo priority es requerido.',
            'priority.string' => 'El campo priority debe ser una cadena de texto.',
            'priority.in' => 'El campo priority debe ser uno de los siguientes: low, medium, high.',
            'due_date.required' => 'El campo due_date es requerido.',
            'due_date.date' => 'El campo due_date debe ser una fecha válida.',
        ];
    }
}
