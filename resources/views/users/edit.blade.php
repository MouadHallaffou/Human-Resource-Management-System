@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Modifier l'utilisateur</h2>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Ligne 1 : Nom et Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Nom -->
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nom :</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('name') border-red-500 @enderror"
                            placeholder="Entrez le nom" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email :</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('email') border-red-500 @enderror"
                            placeholder="Entrez l'email" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ligne 2 : Image et Téléphone -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Image -->
                    <div>
                        <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Image :</label>
                        <input type="file" name="image" id="image"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('image') border-red-500 @enderror">
                        @if ($user->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Image actuelle"
                                    class="w-20 h-20 rounded-lg">
                                <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                            </div>
                        @endif
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Téléphone :</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('phone') border-red-500 @enderror"
                            placeholder="Entrez le téléphone">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ligne 3 : Date de naissance et Adresse -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Date de naissance -->
                    <div>
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-700">Date de naissance
                            :</label>
                        <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('birthday') border-red-500 @enderror">
                        @error('birthday')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Adresse -->
                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Adresse :</label>
                        <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('address') border-red-500 @enderror"
                            placeholder="Entrez l'adresse">
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ligne 4 : Date de recrutement et Salaire -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Date de recrutement -->
                    <div>
                        <label for="recruitment_date" class="block mb-2 text-sm font-medium text-gray-700">Date de
                            recrutement :</label>
                        <input type="date" name="recruitment_date" id="recruitment_date"
                            value="{{ old('recruitment_date', $user->recruitment_date) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('recruitment_date') border-red-500 @enderror">
                        @error('recruitment_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Salaire -->
                    <div>
                        <label for="salary" class="block mb-2 text-sm font-medium text-gray-700">Salaire :</label>
                        <input type="number" name="salary" id="salary" value="{{ old('salary', $user->salary) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('salary') border-red-500 @enderror"
                            placeholder="Entrez le salaire">
                        @error('salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ligne 5 : Statut et Rôle -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Statut -->
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Statut :</label>
                        <select name="status" id="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('status') border-red-500 @enderror">
                            <option value="">Sélectionnez un statut</option>
                            <option value="actif" {{ old('status', $user->status) == 'actif' ? 'selected' : '' }}>Actif
                            </option>
                            <option value="inactif" {{ old('status', $user->status) == 'inactif' ? 'selected' : '' }}>
                                Inactif</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rôle -->
                    <div class="mb-5">
                        <label for="role_id" class="block mb-2 text-sm font-medium text-gray-700">Rôle</label>
                        <select name="role_id" id="role_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"
                            required>
                            <option value="">Sélectionnez un rôle</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ (old('role_id') ?? ($user->roles->first()->id ?? '')) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Ligne 6 : Département et Job -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <!-- Département -->
                    <div>
                        <label for="department_id" class="block mb-2 text-sm font-medium text-gray-700">Département
                            :</label>
                        <select name="department_id" id="department_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('department_id') border-red-500 @enderror"
                            required>
                            <option value="">Sélectionnez un département</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job -->
                    <div>
                        <label for="job_id" class="block mb-2 text-sm font-medium text-gray-700">Job :</label>
                        <select name="job_id" id="job_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('job_id') border-red-500 @enderror"
                            required>
                            <option value="">Sélectionnez un job</option>
                            <!-- Les options seront ajoutées dynamiquement via JavaScript -->
                        </select>
                        @error('job_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ligne 7 : Contrat -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <div>
                        <label for="contract_id" class="block mb-2 text-sm font-medium text-gray-700">Contrat :</label>
                        <select name="contract_id" id="contract_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition duration-300 ease-in-out @error('contract_id') border-red-500 @enderror"
                            required>
                            <option value="">Sélectionnez un contrat</option>
                            @foreach ($contracts as $contract)
                                <option value="{{ $contract->id }}"
                                    {{ old('contract_id', $user->contract_id) == $contract->id ? 'selected' : '' }}>
                                    {{ $contract->typeContract }}
                                </option>
                            @endforeach
                        </select>
                        @error('contract_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex space-x-6 justify-end mt-6">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Mettre à jour
                    </button>
                    <a href="{{ route('users.index') }}"
                        class="text-gray-900 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Convertir les jobs groupés en un objet JavaScript
        const jobsByDepartment = @json($joobs);

        // Écouter les changements dans le champ "Département"
        document.getElementById('department_id').addEventListener('change', function() {
            const departmentId = this.value;
            const jobSelect = document.getElementById('job_id');

            // Vider la liste des jobs
            jobSelect.innerHTML = '<option value="">Sélectionnez un job</option>';

            if (departmentId && jobsByDepartment[departmentId]) {
                // Ajouter les jobs du département sélectionné
                jobsByDepartment[departmentId].forEach(job => {
                    const option = document.createElement('option');
                    option.value = job.id;
                    option.textContent = job.title;
                    jobSelect.appendChild(option);
                });

                // Sélectionner le job actuel de l'utilisateur
                const currentJobId = "{{ old('job_id', $user->job_id) }}";
                if (currentJobId) {
                    jobSelect.value = currentJobId;
                }
            }
        });

        // Déclencher l'événement "change" au chargement de la page pour pré-remplir les jobs
        document.addEventListener('DOMContentLoaded', function() {
            const departmentSelect = document.getElementById('department_id');
            if (departmentSelect.value) {
                departmentSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
