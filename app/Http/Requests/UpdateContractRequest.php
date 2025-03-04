<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            'typeContract' => 'required|string|in:CDI,CDD,Freelance, Satge',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date|after:startDate', 
        ];
    }

    public function messages(): array
    {
        return [
            'typeContract.required' => 'Le type de contrat est obligatoire.',
            'typeContract.in' => 'Le type de contrat doit être CDI, CDD, Stage ou Freelance.',
            'document.file' => 'Le document doit être un fichier.',
            'document.mimes' => 'Le document doit être au format PDF, DOC ou DOCX.',
            'document.max' => 'Le document ne doit pas dépasser 2 Mo.',
            'startDate.required' => 'La date de début est obligatoire.',
            'startDate.date' => 'La date de début doit être une date valide.',
            'endDate.date' => 'La date de fin doit être une date valide.',
            'endDate.after' => 'La date de fin doit être après la date de début.',
        ];
    }
}
