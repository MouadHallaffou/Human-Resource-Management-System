<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Changez à `false` si vous souhaitez ajouter une logique d'autorisation
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'recruitment_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'status' => 'required|in:actif,inactif',
            'role_id' => 'required|integer|exists:roles,id',
            'department_id' => 'required|integer|exists:departements,id',
            'contract_id' => 'nullable|integer|exists:contracts,id',
            'job_id' => 'required|integer|exists:joobs,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'grade' => 'nullable|in:debutant,junior,senior,expert', 
        ];
    }
}
