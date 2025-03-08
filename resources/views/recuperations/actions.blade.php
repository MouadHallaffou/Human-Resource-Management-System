@extends('layouts.app')

@section('content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6 bg-gray-900 min-h-screen">
    <h1 class="text-3xl font-bold text-gray-100 mb-6 text-center">Demandes de récupération en attente</h1>

    @if ($recuperations->isEmpty())
        <p class="text-gray-100 text-center">Aucune demande de récupération en attente.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
                <thead class="text-xs text-gray-100 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Employé</th>
                        <th scope="col" class="px-6 py-3">Date de récupération</th>
                        <th scope="col" class="px-6 py-3">Jours demandés</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recuperations as $recuperation)
                    <tr class="odd:bg-gray-800 odd:dark:bg-gray-900 even:bg-gray-700 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $recuperation->user->name }}</td>
                        <td class="px-6 py-4">{{ $recuperation->date_recuperation }}</td>
                        <td class="px-6 py-4">{{ $recuperation->jours_demandes }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('recuperations.approve', $recuperation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                    Approuver
                                </button>
                            </form>
                            <form action="{{ route('recuperations.reject', $recuperation->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                    Rejeter
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection