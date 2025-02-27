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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="hidden md:flex flex-col w-64 bg-gray-800 rounded-2xl">
            <div class="flex flex-col flex-1 overflow-y-auto">
                <nav class="flex flex-col flex-1 overflow-y-auto bg-gradient-to-b from-gray-700 to-blue-500 px-2 py-4 gap-10">
                    <div>
                        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-gray-100 hover:bg-gray-700">
                            <i class="fas fa-tachometer-alt mr-2"></i> 
                            Dashboard
                        </a>
                    </div>
                    <div class="flex flex-col flex-1 gap-3">
                        
                        <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-users mr-2"></i> 
                            Manage Users
                        </a>


                        <a href="{{ route('departements.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-building mr-2"></i> 
                            Manage Departments
                        </a>

                        <a href="{{ route('formations.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-graduation-cap mr-2"></i> 
                            Manage Formations
                        </a>

                        <a href="{{ route('contracts.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-file-contract mr-2"></i>
                            Manage Contracts
                        </a>

                        <a href="{{ route('joobs.index') }}" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-briefcase mr-2"></i> 
                            Manage Jobs
                        </a>

                        <a href="" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-chart-line mr-2"></i> 
                            Progress Bar
                        </a>

                        <a href="" class="flex items-center px-4 py-2 mt-2 text-gray-100 hover:bg-gray-400 hover:bg-opacity-25 rounded-2xl">
                            <i class="fas fa-sitemap mr-2"></i> 
                            Hierarchy
                        </a>
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
                @if(Route::currentRouteName() === 'profile')
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>
</body>
</html>