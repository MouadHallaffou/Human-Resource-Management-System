@extends('layouts.app')

@section('content')
{{-- Titre de la page --}}
<h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-100 md:text-xl lg:text-2xl dark:text-white p-8">Liste des Formations</h1>

{{-- Bouton pour créer une nouvelle formation --}}
<a href="{{ route('formations.create') }}" class="m-8 text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Créer une formation</a>

{{-- Tableau des formations --}}
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
    <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
        <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
                <th scope="col" class="px-6 py-2">ID</th>
                <th scope="col" class="px-6 py-2 text-center">Titre</th>
                {{-- <th scope="col" class="px-6 py-2 text-center">Description</th> --}}
                <th scope="col" class="px-6 py-2 text-center">Lieu</th>
                <th scope="col" class="px-6 py-2 text-center">Certificat</th>
                <th scope="col" class="px-6 py-2 text-center">Date de début</th>
                <th scope="col" class="px-6 py-2 text-center">Date de fin</th>
                <th scope="col" class="px-6 py-2 text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($formations as $formation)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-2">
                    {{ $formation->id }}
                </th>
                <td class="px-6 py-2 text-center">
                    {{ $formation->title }}
                </td>
                {{-- <td class="px-6 py-2 text-center">
                    {{ $formation->description }}
                </td> --}}
                <td class="px-6 py-2 text-center">
                    {{ $formation->location }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $formation->certificate ? 'Oui' : 'Non' }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $formation->start_date }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $formation->end_date}}
                </td>
                <td class="px-6 py-2 text-center whitespace-nowrap">
                    {{-- Bouton pour éditer --}}
                    <a href="{{ route('formations.edit', $formation) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 me-2 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Éditer</a>
                    {{-- Formulaire pour supprimer --}}
                    <form action="{{ route('formations.destroy', $formation) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 font-medium rounded-lg text-sm px-2 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Pagination --}}
{{ $formations->links() }}
@endsection