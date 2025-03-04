@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Modifier un contrat</h1>
            <form action="{{ route('contracts.update', $contract->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Champ : Type de contrat -->
                <div class="mb-5">
                    <label for="typeContract" class="block mb-2 text-sm font-medium text-gray-700">Type de contrat</label>
                    <input type="text" name="typeContract" id="typeContract" 
                        value="{{ old('typeContract', $contract->typeContract) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out"
                        placeholder="Entrez le type de contrat (ex: CDI, CDD, Freelance)" 
                        required>
                    @error('typeContract')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ : Document (optionnel) -->
                <div class="mb-5">
                    <label for="document" class="block mb-2 text-sm font-medium text-gray-700">Document (optionnel)</label>
                    <input type="file" name="document" id="document"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out">
                    @if ($contract->document)
                        <p class="mt-2 text-sm text-gray-500">Document actuel :
                            <a href="{{ asset('storage/' . $contract->document) }}" target="_blank"
                                class="text-blue-600 hover:underline">Télécharger</a>
                        </p>
                    @endif
                    @error('document')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ : Date de début -->
                <div class="mb-5">
                    <label for="startDate" class="block mb-2 text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" name="startDate" id="startDate"
                        value="{{ old('startDate', $contract->startDate->format('Y-m-d')) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out"
                        required>
                    @error('startDate')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ : Date de fin (optionnel) -->
                <div class="mb-5">
                    <label for="endDate" class="block mb-2 text-sm font-medium text-gray-700">Date de fin (optionnel)</label>
                    <input type="date" name="endDate" id="endDate"
                        value="{{ old('endDate', $contract->endDate ? $contract->endDate->format('Y-m-d') : '') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out">
                    @error('endDate')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons : Mettre à jour et Annuler -->
                <div class="flex space-x-6">
                    <button type="submit"
                        class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">Mettre à jour</button>
                    <a href="{{ route('contracts.index') }}"
                        class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection