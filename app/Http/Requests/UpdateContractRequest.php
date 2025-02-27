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
            'typeContract' => 'required|string|in:CDI,CDD,Freelance',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'startDate' => 'required|date',
            'endDate' => 'nullable|date|after:startDate', 
        ];
    }
}
