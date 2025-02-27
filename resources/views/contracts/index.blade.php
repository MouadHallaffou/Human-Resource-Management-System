@extends('layouts.app')

@section('content')
{{-- <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-100 md:text-xl lg:text-2xl dark:text-white p-8">Liste des Contrats</h1> --}}
<a href="{{ route('contracts.create') }}" class="m-8 text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Créer un contrat</a>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
    <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
        <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
                <th scope="col" class="px-6 py-2">ID</th>
                <th scope="col" class="px-6 py-2 text-center">Type de contrat</th>
                <th scope="col" class="px-6 py-2 text-center">Document</th>
                <th scope="col" class="px-6 py-2 text-center">Date de début</th>
                <th scope="col" class="px-6 py-2 text-center">Date de fin</th>
                <th scope="col" class="px-6 py-2 text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contracts as $contract)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-2">
                    {{ $contract->id }}
                </th>
                <td class="px-6 py-2 text-center">
                    {{ $contract->typeContract }}
                </td>
                <td class="px-6 py-2 text-center">
                    @if ($contract->document)
                        <a href="{{ asset('storage/' . $contract->document) }}" target="_blank" class="text-blue-600 hover:underline">Télécharger</a>
                    @else
                        Aucun document
                    @endif
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $contract->startDate->format('d/m/Y') }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $contract->endDate ? $contract->endDate->format('d/m/Y') : 'Non défini' }}
                </td>
                <td class="px-6 py-2 text-center whitespace-nowrap">
                    <a href="{{ route('contracts.edit', $contract) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 me-2 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Éditer</a>
                    <form action="{{ route('contracts.destroy', $contract) }}" method="POST" style="display:inline;">
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

{{ $contracts->links() }}
@endsection