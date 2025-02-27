<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJoobsRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:joobs,title,' . $this->joob->id,
            'description' => 'nullable|string',
        ];
    }

     /**
     * Messages de validation personnalisés.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du job est obligatoire.',
            'title.unique' => 'Ce titre de job existe déjà.',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
