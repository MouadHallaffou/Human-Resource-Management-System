@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-6  w-full max-w-4xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Ajouter une formation</h1>
        <form action="{{ route('formations.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Titre de la formation</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('title') border-red-500 @enderror" placeholder="Entrez le titre de la formation" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description de la formation</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('description') border-red-500 @enderror" placeholder="Entrez la description de la formation" required>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-700">Lieu</label>
                <select name="location" id="location"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('location') border-red-500 @enderror"
                    required>
                    <option value="online" {{ old('location') == 'online' ? 'selected' : '' }}>En ligne</option>
                    <option value="offline" {{ old('location') == 'offline' ? 'selected' : '' }}>En présentiel</option>
                </select>
                @error('location')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="certificate" class="block mb-2 text-sm font-medium text-gray-700">Certificat</label>
                <input type="hidden" name="certificate" value="0"> 
                <input type="checkbox" name="certificate" id="certificate" class="mr-2" value="1">
                <span class="text-gray-900">Oui</span>
                @error('certificate')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="users" class="block mb-2 text-sm font-medium text-gray-700">Assigner des utilisateurs</label>
                <select name="users[]" id="users" multiple
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('users') border-red-500 @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('users')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-700">Date de début</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('start_date') border-red-500 @enderror"
                    required>
                @error('start_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('end_date') border-red-500 @enderror"
                    required>
                @error('end_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-6">
                <button type="submit"
                    class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                    Enregistrer
                </button>
                <a href="{{ route('formations.index') }}"
                    class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
