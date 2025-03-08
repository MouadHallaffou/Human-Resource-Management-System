<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="hidden md:flex flex-col w-50 bg-gray-800 rounded-2xl">
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav
                    class="flex flex-col flex-1 overflow-y-auto bg-gradient-to-b from-gray-700 to-blue-500 px-2 py-4 gap-6">

                    <div>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            @if (auth()->user()->hasRole('Admin'))
                                Dashboard Admin
                            @elseif(auth()->user()->hasRole('Manager'))
                                Dashboard Manager
                            @elseif(auth()->user()->hasRole('RH Manager'))
                                Dashboard RH
                            @elseif(auth()->user()->hasRole('Employé'))
                                Dashboard Employé
                            @else
                                Dashboard
                            @endif
                        </a>
                    </div>

                    <div class="flex flex-col flex-1 gap-3">

                        @can('view-users')
                            <a href="{{ route('users.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-users mr-2"></i>
                                Manage Users
                            </a>
                        @endcan

                        @can('view-departments')
                            <a href="{{ route('departements.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-building mr-2"></i>
                                Manage Departments
                            </a>
                        @endcan

                        @can('view-formations')
                            <a href="{{ route('formations.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Manage Formations
                            </a>
                        @endcan

                        @can('view-contracts')
                            <a href="{{ route('contracts.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-file-contract mr-2"></i>
                                Manage Contracts
                            </a>
                        @endcan

                        @can('view-jobs')
                            <a href="{{ route('joobs.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-briefcase mr-2"></i>
                                Manage Jobs
                            </a>
                        @endcan

                        @can('create-demande-conge')
                            <a href="{{ route('conges.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Demande Conge
                            </a>
                        @endcan

                        @can('view-demandes')
                            <a href="{{ route('conges.actions') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-envelope-open-text mr-2"></i>
                                All demandes
                            </a>
                        @endcan

                        {{-- @can('view-recuperation') --}}
                        @if (auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Employé'))
                            <a href="{{ route('recuperations.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                Demande Recuperation
                            </a>
                        @endif
                        {{-- @endcan --}}

                        {{-- @can('recuperation-rh') --}}
                        @if (auth()->user()->hasRole('RH Manager'))
                            <a href="{{ route('recuperations.actions') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-inbox mr-2"></i>
                                All Recuperations
                            </a>
                        @endif
                        {{-- @endcan --}}

                        @can('view-career')
                            <a href="{{ route('users.cariere', auth()->user()->id) }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-chart-line mr-2"></i>
                                Cariere
                            </a>
                        @endcan

                        @can('view-hierarchy')
                            <a href="{{ route('hierarchie.index') }}"
                                class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                                <i class="fas fa-sitemap mr-2"></i>
                                Hierarchy
                            </a>
                        @endcan

                    </div>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <!-- Navigation -->
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="p-6 bg-gray-100 dark:bg-gray-900">
                @if (Route::currentRouteName() === 'profile')
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>
</body>

</html>
