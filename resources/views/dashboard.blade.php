<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('content')

        <body class="bg-gray-50 p-6">
            {{-- <h1 class="text-3xl font-bold text-gray-800 mb-8">Tableau de Bord RH</h1> --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
                <!-- Carte Employés -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-transform duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 font-semibold">Total Employés</h2>
                        <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center text-white">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2 employee-count">{{ $totalEmployees }}</div>
                    <div class="flex items-center text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>12% depuis le mois dernier</span>
                    </div>
                </div>

                <!-- Carte Départements -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-transform duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 font-semibold">Départements</h2>
                        <div class="w-12 h-12 rounded-lg bg-green-500 flex items-center justify-center text-white">
                            <i class="fas fa-building text-xl"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2 department-count">{{ $totalDepartments }}</div>
                    <div class="flex items-center text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>1 depuis le mois dernier</span>
                    </div>
                </div>

                <!-- Carte Postes -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-transform duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 font-semibold">Postes Disponibles</h2>
                        <div class="w-12 h-12 rounded-lg bg-yellow-500 flex items-center justify-center text-white">
                            <i class="fas fa-briefcase text-xl"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2 job-count">{{ $totalJobs }}</div>
                    <div class="flex items-center text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>5% depuis le mois dernier</span>
                    </div>
                </div>

                <!-- Carte Managers -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-transform duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 font-semibold">Managers</h2>
                        <div class="w-12 h-12 rounded-lg bg-red-500 flex items-center justify-center text-white">
                            <i class="fas fa-user-tie text-xl"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2 manager-count">{{ $totalManagers }}</div>
                    <div class="flex items-center text-green-500 text-sm">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>2 depuis le mois dernier</span>
                    </div>
                </div>

                <!-- Carte Formations -->
                <div class="bg-white rounded-xl shadow-md p-6 transition-transform duration-300 hover:-translate-y-1">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 font-semibold">Formations en cours</h2>
                        <div class="w-12 h-12 rounded-lg bg-cyan-500 flex items-center justify-center text-white">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-gray-800 mb-2 training-count">{{ $totalTrainings }}</div>
                    <div class="flex items-center text-red-500 text-sm">
                        <i class="fas fa-arrow-down mr-1"></i>
                        <span>8% depuis le mois dernier</span>
                    </div>
                </div>
            </div>

        </body>

        </html>
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
