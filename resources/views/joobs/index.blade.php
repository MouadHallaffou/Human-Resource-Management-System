@extends('layouts.app')

@section('content')
    <a href="{{ route('joobs.create') }}" class="m-8 text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Créer un job</a>

    {{-- @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
    @endif --}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
        <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
            <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-2">ID</th>
                    <th scope="col" class="px-6 py-2 text-center">Titre</th>
                    <th scope="col" class="px-6 py-2 text-center">Département</th>
                    <th scope="col" class="px-6 py-2 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($joobs as $job)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-2">
                            {{ $job->id }}
                        </th>
                        <td class="px-6 py-2 text-center">
                            {{ $job->title }}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $job->department->name ?? 'Non défini' }}
                        </td>
                        <td class="px-6 py-2 text-center whitespace-nowrap">
                            <a href="{{ route('joobs.edit', $job) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 me-2 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Éditer</a>
                            <form action="{{ route('joobs.destroy', $job) }}" method="POST" style="display:inline;">
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

    {{ $joobs->links() }} <!-- Pagination -->
@endsection