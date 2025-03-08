@extends('layouts.app')

@section('content')
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6 bg-gray-900 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-100 mb-6 text-center">Mes demandes de récupération</h1>

        <div class="bg-gray-800 shadow-md rounded-lg p-6 mb-6 flex justify-between">
            <div>
                <p class="text-gray-100">Votre solde de récupération est de : <span
                        class="font-bold text-blue-400">{{ auth()->user()->jours_recuperation }}</span> jours</p>
            </div>
            <div>
                <a href="{{ route('recuperations.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Faire une demande
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
                <thead class="text-xs text-gray-100 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Date de récupération</th>
                        <th scope="col" class="px-6 py-3">Jours demandés</th>
                        <th scope="col" class="px-6 py-3">Statut</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recuperations as $recuperation)
                        <tr
                            class="odd:bg-gray-800 odd:dark:bg-gray-900 even:bg-gray-700 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">{{ $recuperation->date_recuperation }}</td>
                            <td class="px-6 py-4">{{ $recuperation->jours_demandes }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 text-sm rounded-full {{ $recuperation->status === 'approved' ? 'bg-green-100 text-green-800' : ($recuperation->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $recuperation->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($recuperation->status === 'pending')
                                    <form action="{{ route('recuperations.cancel', $recuperation->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                            Annuler
                                        </button>
                                    </form>
                                @endif

                                @if ($recuperation->status === 'pending')
                                    <a href="{{ route('recuperations.edit', $recuperation->id) }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        Modifier
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
