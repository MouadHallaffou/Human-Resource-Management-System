@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-5xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Modifier la demande de congé</h1>
            
            @if (session('error_conge'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('error_conge') }}</span>
                </div>
            @endif

            <form action="{{ route('conges.update', $conge) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $conge->start_date) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('start_date') border-red-500 @enderror"
                        required>
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-700">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $conge->end_date) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('end_date') border-red-500 @enderror"
                        required>
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="cause" class="block mb-2 text-sm font-medium text-gray-700">Raison</label>
                    <textarea name="cause" id="cause" rows="3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('cause') border-red-500 @enderror"
                        placeholder="Entrez la raison de votre congé">{{ old('cause', $conge->cause) }}</textarea>
                    @error('cause')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-6">
                    <button type="submit"
                        class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                        Modifier
                    </button>
                    <a href="{{ route('conges.index') }}"
                        class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection