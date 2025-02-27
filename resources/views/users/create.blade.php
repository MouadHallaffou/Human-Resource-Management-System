@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-6 w-96">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Créer un nouvel utilisateur</h2>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <!-- Nom -->
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nom :</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('name') border-red-500 @enderror"
                    placeholder="Entrez le nom" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('email') border-red-500 @enderror"
                    placeholder="Entrez l'email" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Téléphone -->
            <div class="mb-5">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Téléphone :</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('phone') border-red-500 @enderror"
                    placeholder="Entrez le téléphone">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date de naissance -->
            <div class="mb-5">
                <label for="birthday" class="block mb-2 text-sm font-medium text-gray-700">Date de naissance :</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('birthday') border-red-500 @enderror">
                @error('birthday')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Adresse -->
            <div class="mb-5">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Adresse :</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('address') border-red-500 @enderror"
                    placeholder="Entrez l'adresse">
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date de recrutement -->
            <div class="mb-5">
                <label for="recruitment_date" class="block mb-2 text-sm font-medium text-gray-700">Date de recrutement :</label>
                <input type="date" name="recruitment_date" id="recruitment_date" value="{{ old('recruitment_date') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('recruitment_date') border-red-500 @enderror">
                @error('recruitment_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Salaire -->
            <div class="mb-5">
                <label for="salary" class="block mb-2 text-sm font-medium text-gray-700">Salaire :</label>
                <input type="number" name="salary" id="salary" value="{{ old('salary') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('salary') border-red-500 @enderror"
                    placeholder="Entrez le salaire">
                @error('salary')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Statut -->
            <div class="mb-5">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Statut :</label>
                <input type="text" name="status" id="status" value="{{ old('status') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('status') border-red-500 @enderror"
                    placeholder="Entrez le statut">
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rôle (liste déroulante) -->
            <div class="mb-5">
                <label for="role_id" class="block mb-2 text-sm font-medium text-gray-700">Rôle :</label>
                <select name="role_id" id="role_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('role_id') border-red-500 @enderror" required>
                    <option value="">Sélectionnez un rôle</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Département (liste déroulante) -->
            <div class="mb-5">
                <label for="department_id" class="block mb-2 text-sm font-medium text-gray-700">Département :</label>
                <select name="department_id" id="department_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('department_id') border-red-500 @enderror" required>
                    <option value="">Sélectionnez un département</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contrat (liste déroulante) -->
            <div class="mb-5">
                <label for="contract_id" class="block mb-2 text-sm font-medium text-gray-700">Contrat :</label>
                <select name="contract_id" id="contract_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('contract_id') border-red-500 @enderror" required>
                    <option value="">Sélectionnez un contrat</option>
                    @foreach ($contracts as $contract)
                        <option value="{{ $contract->id }}" {{ old('contract_id') == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                    @endforeach
                </select>
                @error('contract_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="flex space-x-6">
                <button type="submit"
                    class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                    Créer
                </button>
                <a href="{{ route('users.index') }}"
                    class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection