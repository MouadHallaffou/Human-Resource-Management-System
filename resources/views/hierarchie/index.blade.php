@extends('layouts.app')

@section('content')

    <body class="bg-gray-50 p-8">
        <div class="container mx-auto max-w-7xl overflow-auto">
            <h1 class="text-2xl font-bold text-center mb-8">Organigramme de l'Entreprise</h1>

            <div class="relative pt-8 pb-16">

                <!-- Admin -->
                @if ($admin)
                    <div class="flex justify-center mb-16">
                        <a href="{{ route('users.show', $admin) }}" class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-red-600 flex items-center justify-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="border border-red-600 bg-white flex items-center justify-center px-2 py-1 rounded-md">
                                <span class="text-sm font-medium text-gray-800 whitespace-nowrap">{{ $admin->name }}</span>
                            </div>
                            <div class="mt-1">
                                <span class="text-xs text-gray-600">Administrateur</span>
                            </div>
                        </a>
                    </div>
                @endif

                <!-- HR Managers -->
                @if ($rhManagers->count())
                    <div class="flex justify-center space-x-64 mb-16">
                        @foreach ($rhManagers as $rh)
                            <a href="{{ route('users.show', $rh) }}" class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-yellow-400 flex items-center justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="border border-yellow-400 bg-white flex items-center justify-center px-2 py-1 rounded-md">
                                    <span
                                        class="text-sm font-medium text-gray-800 whitespace-nowrap">{{ $rh->name }}</span>
                                </div>
                                <div class="mt-1">
                                    <span class="text-xs text-gray-600">Responsable RH</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Managers -->
                @if ($managers->count())
                    <div class="flex justify-between mb-16">
                        @foreach ($managers as $manager)
                            <a href="{{ route('users.show', $manager) }}" class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-blue-600 flex items-center justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="border border-blue-600 bg-white flex items-center justify-center px-2 py-1 rounded-md">
                                    <span
                                        class="text-xs font-medium text-gray-800 whitespace-nowrap">{{ $manager->name }}</span>
                                </div>
                                <div class="mt-1">
                                    <span class="text-xs text-gray-600">Manager</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Employees -->
                @if ($employees->count())
                    <div class="flex justify-between">
                        @foreach ($employees as $employee)
                            <a href="{{ route('users.show', $employee) }}" class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-600 flex items-center justify-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="border border-green-600 bg-white flex items-center justify-center px-2 py-1 rounded-md">
                                    <span
                                        class="text-xs font-medium text-gray-800 whitespace-nowrap">{{ $employee->name }}</span>
                                </div>
                                <div class="mt-1">
                                    <span class="text-xs text-gray-600">Employé</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="text-center text-sm text-gray-800 mt-4">
                Organigramme human resources manage systemes
            </div>
        </div>
    </body>
@endsection