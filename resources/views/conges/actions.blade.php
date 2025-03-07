@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Demandes de congé en attente</h1>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
        <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
                <th scope="col" class="px-6 py-2 text-center">Demandeur</th>
                <th scope="col" class="px-6 py-2 text-center">Date de début</th>
                <th scope="col" class="px-6 py-2 text-center">Date de fin</th>
                <th scope="col" class="px-6 py-2 text-center">Raison</th>
                @if(auth()->user()->hasRole('Manager'))
                <th scope="col" class="px-6 py-2 text-center">Statut Manager</th>
                @endif
                @if(auth()->user()->hasRole('RH Manager'))
                <th scope="col" class="px-6 py-2 text-center">Statut RH Manager</th>
                @endif
                <th scope="col" class="px-6 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conges as $conge)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <td class="px-6 py-2 text-center">{{ $conge->user->name }}</td>
                <td class="px-6 py-2 text-center">{{ $conge->start_date }}</td>
                <td class="px-6 py-2 text-center">{{ $conge->end_date }}</td>
                <td class="px-6 py-2 text-center">{{ substr($conge->cause, 0,10 ) }}...</td>
                @if(auth()->user()->hasRole('Manager'))
                <td class="px-6 py-2 text-center">
                    <span class="px-3 py-1.5 text-sm rounded-full {{ $conge->status_manager === 'approved' ? 'bg-green-100 text-green-800' : ($conge->status_manager === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ $conge->status_manager }}
                    </span>
                </td>
                @endif
                @if(auth()->user()->hasRole('RH Manager'))
                <td class="px-6 py-2 text-center">
                    <span class="px-2 py-1 text-sm rounded-full {{ $conge->status_rh_manager === 'approved' ? 'bg-green-100 text-green-800' : ($conge->status_rh_manager === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ $conge->status_rh_manager }}
                    </span>
                </td>
                @endif
                <td class="px-6 py-2 text-center whitespace-nowrap">
                    
                    {{-- Actions pour le Manager --}}
                    @if(auth()->user()->hasRole('Manager') && $conge->status_manager === 'pending')
                        <form action="{{ route('conges.approve.manager', $conge->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-2 text-center me-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Accepter</button>
                        </form>
                        <form action="{{ route('conges.reject', $conge->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Refuser</button>
                        </form>
                    @endif

                    {{-- Actions pour le RH Manager --}}
                    @if(auth()->user()->hasRole('RH Manager') && $conge->status_rh_manager === 'pending')
                        <form action="{{ route('conges.approve.hr', $conge->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Accepter</button>
                        </form>
                        <form action="{{ route('conges.reject', $conge->id) }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Refuser</button>
                        </form>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- {{ $conges->links() }} --}}

@endsection