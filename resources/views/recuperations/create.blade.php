@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="bg-gray-800 shadow-md rounded-lg p-6 w-full max-w-5xl">
        <h1 class="text-3xl font-bold text-gray-100 mb-6 text-center">Demande de récupération</h1>
        
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('recuperations.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="date_recuperation" class="block mb-2 text-sm font-medium text-gray-100">Date de récupération</label>
                <input type="date" name="date_recuperation" id="date_recuperation" value="{{ old('date_recuperation') }}"
                    class="bg-gray-700 border border-gray-600 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('date_recuperation') border-red-500 @enderror"
                    required>
                @error('date_recuperation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="jours_demandes" class="block mb-2 text-sm font-medium text-gray-100">Nombre de jours</label>
                <input type="number" name="jours_demandes" id="jours_demandes" value="{{ old('jours_demandes') }}"
                    class="bg-gray-700 border border-gray-600 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('jours_demandes') border-red-500 @enderror"
                    required>
                @error('jours_demandes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-6">
                <button type="submit" name="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Enregistrer
                </button>
                <a href="{{ route('recuperations.index') }}"
                    class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection