@extends('layouts.app')

@section('content')
<a href="{{ route('users.create') }}" class="m-8 text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Créer un utilisateur</a>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
    <table class="min-w-full text-sm text-left rtl:text-right text-gray-100 dark:text-gray-100">
        <thead class="text-xs text-gray-100 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-100">
            <tr>
                <th scope="col" class="px-3 py-2">ID</th>
                <th scope="col" class="px-3 py-2 text-center">Nom</th>
                <th scope="col" class="px-3 py-2 text-center">Profile</th>
                <th scope="col" class="px-3 py-2 text-center">Email</th>
                <th scope="col" class="px-3 py-2 text-center">Téléphone</th>
                <th scope="col" class="px-3 py-2 text-center">Rôle</th>
                <th scope="col" class="px-3 py-2 text-center">Département</th>
                <th scope="col" class="px-3 py-2 text-center">Contrat</th>
                <th scope="col" class="px-3 py-2 text-center">Emplois</th>
                <th scope="col" class="px-3 py-2 text-center">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-3 py-2">
                    {{ $user->id }}
                </th>
                <td class="px-3 py-2 text-center">
                    {{ $user->name }}
                </td>
                <td class="px-3 py-2 text-center">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="profile" class="w-8 h-8 z-0 rounded-full" />
                </td>
                <td class="px-3 py-2 text-center">
                    {{ $user->email }}
                </td>
                <td class="px-3 py-2 text-center">
                    {{ $user->phone }}
                </td class="px-3 py-2 text-center">
                <td>
                    @foreach ($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td class="px-3 py-2 text-center">
                    {{ $user->department->name ?? 'Non défini' }}
                </td>
                <td class="px-3 py-2 text-center">
                    {{ $user->contract->typeContract ?? 'Non défini' }}
                </td>
                <td class="px-3 py-2 text-center">
                    {{ $user->joob->title ?? 'Non défini' }}
                </td>
                <td class="px-3 py-2 text-center whitespace-nowrap">
                    <a href="{{ route('users.cariere', $user->id) }}" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Voir</a>
                    <a href="{{ route('users.edit', $user) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 me-2 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Éditer</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
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

{{ $users->links() }}
@endsection