@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-auto">
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

                    <!-- Timeline -->
                    <div class="flex justify-between relative z-10">
                        <!-- Job -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center border-2 border-white">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <span class="text-xs mt-1 text-gray-400">{{ $user->recruitment_date }}</span>
                            <div class="mt-2 text-center w-32">
                                <p class="text-sm text-gray-600 font-medium">
                                    {{ $user->joob ? $user->joob->title : '--' }}</p>
                            </div>
                        </div>

                        <!-- Contract -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-8 h-8 rounded-full bg-violet-600 flex items-center justify-center border-2 border-white">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <span
                                class="text-xs mt-1 text-gray-400">{{ $user->contract->start_date ?? '--' }}</span>
                            <div class="mt-2 text-center w-32">
                                <p class="text-sm text-gray-600 font-medium">Contrat</p>
                                <p class="text-xs text-gray-500">Type:
                                    {{ $user->contract ? $user->contract->typeContract : '--' }}</p>
                            </div>
                        </div>

                        <!-- Certification -->
                        <div class="flex flex-col items-center">
                            <div
                                class="w-8 h-8 rounded-full bg-white border border-gray-300 flex items-center justify-center">
                                <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                            </div>
                            <span class="text-xs mt-1 text-gray-400">{{ $user->certification_date ?? '--' }}</span>
                            <div class="mt-2 text-center w-32">
                                <p class="text-sm text-gray-600 font-medium">Certification:
                                    {{ $user->certification ?? '--' }}</p>
                                <p class="text-xs text-gray-500">Certified</p>
                                <p class="text-xs text-gray-500">Actif</p>
                            </div>
                        </div>
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
                        <p class="text-sm text-gray-600">Type |
                            {{ $user->contract ? $user->contract->typeContract : '--' }}</p>
                    </div>
                </div>

                <div class="bg-white border rounded-lg overflow-hidden">
                    <div class="border-b hover:bg-gray-50">
                        <div class="flex justify-between py-3 px-4 items-center">
                            <div class="flex items-center">
                                <div class="bg-violet-600 p-2 rounded text-white mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Date</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-600">{{ $user->recruitment_date ?? '--' }}</span>
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
                                            d="M10.496 2.132a1 1 0 00-.992 0l-7 4A1 1 0 003 8v7a1 1 0 100 2h14a1 1 0 100-2V8a1 1 0 00.496-1.868l-7-4zM6 9a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1zm3 1a1 1 0 012 0v3a1 1 0 11-2 0v-3zm5-1a1 1 0 00-1 1v3a1 1 0 102 0v-3a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">Département</span>
                            </div>
                            <div class="flex items-center">
                                <span
                                    class="text-sm text-gray-600">{{ $user->department ? $user->department->name : '--' }}</span>
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

            <!-- Cursus Form Section -->
            <div id="cursusFormContainer" class="hidden px-8 py-6 bg-gray-50">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">Créer un Nouveau Cursus</h2>

                    <form action="" method="POST" id="cursusForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="career_type" class="block text-sm font-medium text-gray-700">Type de
                                    Carrière</label>
                                <select name="career_type" id="career_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                    required>
                                    <option value="">Sélectionner un type de carrière</option>
                                    <option value="developpeur">Développeur</option>
                                    <option value="designer">Designer</option>
                                    <option value="manager">Manager</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>

                            <div>
                                <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                                <select name="grade" id="grade"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                    required>
                                    <option value="">Sélectionner un grade</option>
                                    <option value="junior">Junior</option>
                                    <option value="intermediate">Intermédiaire</option>
                                    <option value="senior">Senior</option>
                                    <option value="expert">Expert</option>
                                </select>
                            </div>

                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de
                                    Début</label>
                                <input type="date" name="start_date" id="start_date"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                    required>
                            </div>

                            <div>
                                <label for="certification"
                                    class="block text-sm font-medium text-gray-700">Certification</label>
                                <input type="text" name="certification" id="certification"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                    placeholder="Nom de la certification">
                            </div>

                            <div class="md:col-span-2">
                                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarques</label>
                                <textarea name="remarks" id="remarks" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                    placeholder="Observations ou commentaires supplémentaires"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end space-x-4">
                            <button type="button" id="cancelButton"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                                Annuler
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-violet-600 text-white rounded-md hover:bg-blue-600 transition">
                                Enregistrer
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
            const cursusFormContainer = document.getElementById('cursusFormContainer');
            const form = document.getElementById('cursusForm');
            const cancelButton = document.getElementById('cancelButton');
            const details = document.getElementById('details');

            if (toggleButton && cursusFormContainer && form && cancelButton && details) {
                toggleButton.addEventListener('click', function() {
                    cursusFormContainer.classList.toggle('hidden');
                    details.classList.toggle('hidden');
                });

                cancelButton.addEventListener('click', function() {
                    form.reset();
                    cursusFormContainer.classList.add('hidden');
                    details.classList.remove('hidden');
                });
            } else {
                console.error('Un ou plusieurs éléments nécessaires sont manquants dans le DOM.');
            }
        });
    </script>
    @endpush

@endsection          