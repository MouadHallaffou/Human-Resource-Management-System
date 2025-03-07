@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-6  w-full max-w-4xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Modifier un job</h1>
        <form action="{{ route('joobs.update', $joob->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Titre du job -->
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Titre du job</label>
                <input type="text" name="title" id="title" value="{{ old('title', $joob->title) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('title') border-red-500 @enderror"
                    placeholder="Entrez le titre du job" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description du job -->
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description du job</label>
                <textarea name="description" id="description"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('description') border-red-500 @enderror"
                    placeholder="Entrez la description du job">{{ old('description', $joob->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sélection du département -->
            <div class="mb-5">
                <label for="department_id" class="block mb-2 text-sm font-medium text-gray-700">Département</label>
                <select name="department_id" id="department_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('department_id') border-red-500 @enderror"
                    required>
                    <option value="">-- Sélectionnez un département --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $joob->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons -->
            <div class="flex space-x-6">
                <button type="submit" class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">Mettre à jour</button>
                <a href="{{ route('joobs.index') }}" class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection