@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-6 w-96">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Modifier un job</h1>
        <form action="{{ route('joobs.update', $joob->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Utilisez la méthode PUT pour la mise à jour -->

            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Titre du job</label>
                <input type="text" name="title" id="title" value="{{ $joob->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out" placeholder="Entrez le titre du job" required>
            </div>

            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description du job</label>
                <textarea name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out" placeholder="Entrez la description du job">{{ $joob->description }}</textarea>
            </div>

            <div class="flex space-x-6">
                <button type="submit" class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">Mettre à jour</button>
                <a href="{{ route('joobs.index') }}" class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection