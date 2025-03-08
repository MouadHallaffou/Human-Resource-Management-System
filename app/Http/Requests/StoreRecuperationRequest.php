<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecuperationRequest extends FormRequest
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
            'date_recuperation' => 'required|date|after_or_equal:today',
            'jours_demandes' => 'required|integer|min:1|max:30',
        ];
    }

    public function messages(): array
    {
        return [
            'date_recuperation.required' => 'La date de récupération est obligatoire.',
            'jours_demandes.required' => 'Le nombre de jours est obligatoire.',
            'jours_demandes.integer' => 'Le nombre de jours doit être un entier.',
            'jours_demandes.min' => 'Le nombre de jours doit être d\'au moins 1.',
            'jours_demandes.max' => 'Le nombre de jours ne peut pas dépasser 30.',
        ];
    }
    
}
