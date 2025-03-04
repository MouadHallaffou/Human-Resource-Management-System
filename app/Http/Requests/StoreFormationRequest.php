<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormationRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|in:online,offline',
            'certificate' => 'required|boolean', 
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ];
    }

    /**
     * Messages personnalisés pour les règles de validation.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre de la formation est obligatoire.', 
            'description.required' => 'La description de la formation est obligatoire.', 
            'location.required' => 'Le lieu de la formation est obligatoire.',
            'location.in' => 'Le lieu doit être "online" ou "offline".',
            'start_date.required' => 'La date de début est obligatoire.',
            'end_date.required' => 'La date de fin est obligatoire.',
            'end_date.after' => 'La date de fin doit être après la date de début.',
        ];
    }
}
