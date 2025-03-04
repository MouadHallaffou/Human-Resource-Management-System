<div>
    <div>
        <!-- Bouton pour ouvrir le formulaire de création -->
        <button wire:click="create" class="m-8 text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-4 me-2 mb-2">
            Créer un job
        </button>
    
        <!-- Tableau des jobs -->
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
                                <button wire:click="edit({{ $job->id }})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 me-2 py-2.5 mb-2">
                                    Éditer
                                </button>
                                <button wire:click="delete({{ $job->id }})" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 font-medium rounded-lg text-sm px-2 py-2 me-2 mb-2">
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <!-- Pagination -->
        {{ $joobs->links() }}
    
        <!-- Modal pour le formulaire de création/édition -->
        @if ($isOpen)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg p-6 w-96">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                        {{ $joobId ? 'Modifier un job' : 'Ajouter un job' }}
                    </h1>
                    <form wire:submit.prevent="{{ $joobId ? 'update' : 'store' }}">
                        <!-- Titre du job -->
                        <div class="mb-5">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Titre du job</label>
                            <input type="text" wire:model="title" id="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                                placeholder="Entrez le titre du job" required>
                            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
    
                        <!-- Description du job -->
                        <div class="mb-5">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700">Description du job</label>
                            <textarea wire:model="description" id="description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                                placeholder="Entrez la description du job" required></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
    
                        <!-- Sélection du département -->
                        <div class="mb-5">
                            <label for="department_id" class="block mb-2 text-sm font-medium text-gray-700">Département</label>
                            <select wire:model="department_id" id="department_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                                required>
                                <option value="">Sélectionnez un département</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
    
                        <!-- Boutons -->
                        <div class="flex space-x-6">
                            <button type="submit" class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                                {{ $joobId ? 'Mettre à jour' : 'Enregistrer' }}
                            </button>
                            <button type="button" wire:click="closeModal" class="text-black bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2 mt-4 me-2 mb-2">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
