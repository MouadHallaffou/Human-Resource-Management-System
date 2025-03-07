@extends('layouts.app')

@section('content')

<a href="{{ route('conges.create') }}" class="m-8 text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Créer une demande de congé</a>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
    <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
        <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
                <th scope="col" class="px-6 py-2">Nom</th>
                <th scope="col" class="px-6 py-2 text-center">Date de debut</th>
                <th scope="col" class="px-6 py-2 text-center">Date de fin</th>
                <th scope="col" class="px-6 py-2 text-center">Jours disponible</th>
                <th scope="col" class="px-6 py-2 text-center">Raison</th>
                <th scope="col" class="px-6 py-2 text-center">Statut</th>
                <th scope="col" class="px-6 py-2 text-center">actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($conges as $conge)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-2">
                    {{ $conge->user->name }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $conge->start_date }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ $conge->end_date }}
                </td>
                <td class="px-6 py-2 text-center">
                    {{ intval($joursDisponibles) }} jours
                </td>
                <td class="px-6 py-2 text-center">
                    {{ substr($conge->cause, 0, 20) }}...
                </td>
                <td class="px-6 py-2 text-center">
                    <span class="px-3 py-1.5 text-sm rounded-full {{ $conge->status_demandeur === 'approved' ? 'bg-green-100 text-green-800' : ($conge->status_demandeur === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ $conge->status_demandeur }}
                    </span>
                </td>
                <td class="px-6 py-2 text-center whitespace-nowrap">
                    <a href="{{ route('conges.edit', $conge) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 me-2 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edite</a>
                    <form action="{{ route('conges.destroy', $conge) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 font-medium rounded-lg text-sm px-2 py-2 me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Concel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- {{ $conges->links() }} --}}

@endsection