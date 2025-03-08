@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-auto">
            <!-- Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h1 class="text-xl font-medium text-gray-700">Cariere</h1>
                <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Profile -->
            <div class="flex flex-col items-center py-6">
                <div class="relative">
                    <img src="{{ $user->image ? asset('storage/' . $user->image) : 'https://via.placeholder.com/150' }}"
                        alt="Profile" class="w-20 h-20 rounded-full object-cover">
                </div>
                <h2 class="mt-3 text-lg font-medium text-gray-500">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                <span class="mt-1 text-green-600 text-md">{{ ucfirst($user->status) }}</span>
            </div>

            <!-- Timeline -->
            <div class="px-8 py-4">
                <div class="relative">
                    <div class="absolute h-1 bg-violet-600 top-4 left-0 right-0 z-0"></div>

                    <!-- Timeline Items -->
                    <div class="flex justify-between relative z-10">
                        @php
                            // Collect all timeline items with dates to sort them properly
                            $timelineItems = collect();
                            
                            // Add careers to timeline
                            foreach($carieres as $carriere) {
                                $timelineItems->push([
                                    'date' => \Carbon\Carbon::parse($carriere->date_position),
                                    'type' => 'career',
                                    'title' => $carriere->position,
                                    'description' => $carriere->description,
                                    'is_completed' => true
                                ]);
                            }
                            
                            // Add contract to timeline if exists
                            if($user->contract) {
                                $timelineItems->push([
                                    'date' => \Carbon\Carbon::parse($user->contract->start_date ?? now()),
                                    'type' => 'contract',
                                    'title' => 'Contrat',
                                    'description' => 'Type: ' . $user->contract->typeContract,
                                    'is_completed' => true
                                ]);
                            }
                            
                            // Add formations to timeline
                            foreach($formations as $formation) {
                                $timelineItems->push([
                                    'date' => \Carbon\Carbon::parse($formation->date_formation),
                                    'type' => 'formation',
                                    'title' => $formation->title,
                                    'description' => $formation->is_completed ? 'Terminée' : 'En cours',
                                    'is_completed' => $formation->is_completed
                                ]);
                            }
                            
                            // Add certification if exists
                            if($user->certification_date) {
                                $timelineItems->push([
                                    'date' => \Carbon\Carbon::parse($user->certification_date),
                                    'type' => 'certification',
                                    'title' => 'Certification: ' . $user->certification,
                                    'description' => $user->certification_status ?? 'Actif',
                                    'is_completed' => false
                                ]);
                            }
                            
                            // Sort timeline items by date
                            $timelineItems = $timelineItems->sortBy('date');
                        @endphp

                        @foreach($timelineItems as $item)
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full {{ $item['is_completed'] ? 'bg-violet-600' : 'bg-white border border-gray-300' }} flex items-center justify-center border-2 border-white">
                                    <div class="w-2 h-2 {{ $item['is_completed'] ? 'bg-white' : 'bg-gray-300' }} rounded-full"></div>
                                </div>
                                <span class="text-xs mt-1 text-gray-400">{{ $item['date']->format('d/m/Y') }}</span>
                                <div class="mt-2 text-center w-32">
                                    <p class="text-sm text-gray-600 font-medium">{{ $item['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contract Details -->
            <div id="details" class="px-8 py-6">
                <div class="flex items-center mb-4">
                    <div class="w-6 h-6 bg-violet-600 rounded-full flex items-center justify-center mr-3">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-600">Contrat</h3>
                        <p class="text-sm text-gray-600">Type | {{ $user->contract ? $user->contract->typeContract : '--' }}</p>
                    </div>
                </div>

                <div class="bg-white border rounded-lg overflow-hidden">
                    @foreach($carieres as $carriere)
                        <div class="border-b hover:bg-gray-50">
                            <div class="flex justify-between py-3 px-4 items-center">
                                <div class="flex items-center">
                                    <div class="bg-violet-600 p-2 rounded text-white mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $carriere->title }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($carriere->date_position)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Département section -->
                    <div class="border-b hover:bg-gray-50">
                        <div class="flex justify-between py-3 px-4 items-center">
                            <div class="flex items-center">
                                <div class="bg-violet-600 p-2 rounded text-white mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Département</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600">{{ $user->department ? $user->department->name : '--' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="border-b hover:bg-gray-50">
                        <div class="flex justify-between py-3 px-4 items-center">
                            <div class="flex items-center">
                                <div class="bg-violet-600 p-2 rounded text-white mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Manager</span>
                            </div>
                            <div class="flex items-center">
                                <span
                                    class="text-sm text-gray-600">{{ $user->department && $user->department->manager ? $user->department->manager->name : '--' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 ml-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="border-b hover:bg-gray-50">
                        <div class="flex justify-between py-3 px-4 items-center">
                            <div class="flex items-center">
                                <div class="bg-violet-600 p-2 rounded text-white mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Grade</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600">{{ $user->grade ?? '--' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 ml-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="hover:bg-gray-50">
                        <div class="flex justify-between py-3 px-4 items-center">
                            <div class="flex items-center">
                                <div class="bg-violet-600 p-2 rounded text-white mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Remarques</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add to cursus form -->
            <div id="cursusForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                    <h2 class="text-lg font-medium mb-4">Ajouter un élément au cursus</h2>
                    {{-- {{ route('carieres.store') }} --}}
                    <form action="" method="POST">
                        @csrf
                        {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                Titre
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Description
                            </label>
                            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description"></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="date_position">
                                Date
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_position" type="date" name="date_position" required>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <button class="bg-violet-600 hover:bg-violet-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                                Ajouter
                            </button>
                            <button type="button" id="cancelCursusForm" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end p-4 border-t space-x-4">
                <button id="toggleCursusForm" class="bg-violet-600 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggleCursusForm');
            const cursusForm = document.getElementById('cursusForm');
            const cancelButton = document.getElementById('cancelCursusForm');

            toggleButton.addEventListener('click', function() {
                cursusForm.classList.toggle('hidden');
            });

            cancelButton.addEventListener('click', function() {
                document.querySelector('#cursusForm form').reset();
                cursusForm.classList.add('hidden');
            });
        });
    </script>
    @endpush
@endsection