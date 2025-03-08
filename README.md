# HRMS (Human Resource Management System)

## Contexte du Projet

L'objectif de ce projet est de développer un module HRMS (Human Resource Management System) pour permettre aux entreprises de gérer efficacement leurs employés, départements, et hiérarchies. Le développement est réalisé sous Laravel 11 en suivant les bonnes pratiques et en utilisant des packages adaptés pour simplifier la gestion des rôles, des documents, des présences, et des notifications.

## Technologies et Outils

- **Framework** : Laravel 11 💻
- **Base de données** : MySQL / PostgreSQL 🗄️
- **Frontend** : Blade + Tailwind CSS 🎨
- **Authentification** : Laravel Breeze / Jetstream 🔑
- **Packages recommandés** :
  - **Spatie Laravel Permissions** : Gestion des rôles et permissions des utilisateurs 🛡️
  - **Yajra Datatables** : Gestion avancée des tableaux de données (optionnel) 📊
  - **Laravel Excel** : Importation/exportation de données 📥
  - **Livewire** : Composants dynamiques sans rechargement de page 🔄
  - **Laravel Media Library** : Gestion des fichiers et documents 📂
  - **Laravel Notifications** : Alertes et notifications pour événements RH 🔔

## Objectifs

- **Gestion des utilisateurs et des entreprises** : Permettre à chaque entreprise de créer un compte et de gérer ses utilisateurs.
- **Gestion des employés avec rôles multiples** : Associer des rôles variés aux utilisateurs pour une gestion flexible.
- **Gestion des départements et hiérarchie** : Structurer les employés dans des départements et définir les relations hiérarchiques.

## Détails Techniques

### Gestion des Utilisateurs et Entreprises

- **Création d'un compte entreprise** : Une entreprise peut s’inscrire, se connecter et gérer ses employés 🏢.
- **Authentification** : Implémenter un système de connexion sécurisé (via Laravel Breeze ou Jetstream) pour les administrateurs et managers 🔐.
- **Gestion des rôles et permissions** : Utiliser Spatie Laravel Permissions pour gérer les rôles comme Admin, Manager, Employé. Chaque rôle aura des permissions spécifiques 👥.
- **Gestion des profils utilisateurs** : Permettre aux utilisateurs de compléter et modifier leur profil (photo, email, téléphone, etc.) 👤.

### Gestion des Employés

- **Création et mise à jour des profils des employés** : Les administrateurs peuvent ajouter, modifier, ou supprimer les employés dans le système, avec des informations comme le nom, prénom, date de naissance, et coordonnées 📋.
- **Suivi de carrière** : Implémenter des fonctionnalités pour suivre les évolutions professionnelles des employés, telles que les augmentations de salaire, promotions, et formations 🎓.
- **Gestion des contrats** : Ajouter des types de contrats (CDI, CDD, Stage, Freelance) et stocker les documents associés via Laravel Media Library 📂.

### Gestion des Départements et Hiérarchie

- **Création de départements** : Permettre de créer et gérer les départements d'une entreprise 🌐.
- **Hiérarchie des employés** : Associer les employés à un département et définir des relations hiérarchiques entre eux 👔.
- **Affichage dynamique** : Utiliser un organigramme pour visualiser la hiérarchie des employés, avec possibilité d’interactions (drag-and-drop, etc.) 🏗️.

## Configuration de l'envoi d'emails

Pour gérer l'envoi des emails, les configurations suivantes ont été ajoutées dans le fichier `.env` :

```env
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mouadhallaffou@gmail.com
MAIL_PASSWORD=qamaehowtmtpohpn
MAIL_FROM_ADDRESS="mouadhallaffou@gmail.com"
MAIL_FROM_NAME="${APP_NAME}".
```

## Routes Utilisées

Les routes de l'application sont définies dans le fichier `web.php`. Voici un aperçu des principales routes :

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\JoobsController;
use App\Http\Controllers\CariereController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HierarchieController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\RecuperationController;

Route::view('/', 'welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'role:Admin|RH Manager|Manager'])->group(function () {
    Route::resource('contracts', ContractController::class);
    Route::resource('joobs', JoobsController::class);
    Route::resource('formations', FormationController::class);
    Route::resource('users', UserController::class);
    Route::resource('hierarchie', HierarchieController::class);
    Route::get('/users/{userId}/cariere', [CariereController::class, 'index'])->name('users.cariere');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('departements', DepartementController::class);
});

Route::middleware(['auth', 'role:Admin|Employé|RH Manager|Manager'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{userId}/cariere', [CariereController::class, 'index'])->name('users.cariere');
    Route::get('/hierarchie', [HierarchieController::class, 'index'])->name('hierarchie.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
    Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
    Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
    Route::post('/conges/{id}/approve-manager', [CongeController::class, 'approveByManager'])->name('conges.approve.manager');
    Route::post('/conges/{id}/approve-hr', [CongeController::class, 'approveByHR'])->name('conges.approve.hr');
    Route::post('/conges/{id}/reject', [CongeController::class, 'reject'])->name('conges.reject');
    Route::get('/conges/actions', [CongeController::class, 'actions'])->name('conges.actions');
    Route::delete('/conges/{conge}', [CongeController::class, 'destroy'])->name('conges.destroy');
    Route::get('/conges/{conge}/edit', [CongeController::class, 'edit'])->name('conges.edit');
    Route::put('/conges/{conge}', [CongeController::class, 'update'])->name('conges.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/recuperations/actions', [RecuperationController::class, 'actions'])->name('recuperations.actions');
    Route::get('/recuperations/create', [RecuperationController::class, 'create'])->name('recuperations.create');
    Route::post('/recuperations', [RecuperationController::class, 'store'])->name('recuperations.store');
    Route::get('/recuperations', [RecuperationController::class, 'index'])->name('recuperations.index');
    Route::post('/recuperations/{id}/approve', [RecuperationController::class, 'approve'])->name('recuperations.approve');
    Route::post('/recuperations/{id}/reject', [RecuperationController::class, 'reject'])->name('recuperations.reject');
    Route::delete('/recuperations/{id}/cancel', [RecuperationController::class, 'cancel'])->name('recuperations.cancel');
    Route::get('/recuperations/{id}/edit', [RecuperationController::class, 'edit'])->name('recuperations.edit');
    Route::put('/recuperations/{id}', [RecuperationController::class, 'update'])->name('recuperations.update');
});

require __DIR__ . '/auth.php';
```
## Seeders et Factories

### Seeders

Les seeders sont utilisés pour peupler la base de données avec des données de test. Voici un aperçu des seeders utilisés :

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\JoobsSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\DepartementSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(1)->create();

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            CompanySeeder::class,
            DepartementSeeder::class,
            ContractSeeder::class,
            JoobsSeeder::class,
            FormationSeeder::class,
            RolePermissionSeeder::class,
        ]);
    }
}
```

## Factories

### Les factories sont utilisées pour générer des données fictives pour les tests. Voici un aperçu des factories utilisées :

### CompanyFactory :
```php

<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'logo' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
```

### ContractFactory:

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    public function definition(): array
    {
        return [
            'typeContract' => $this->faker->randomElement(['CDI', 'CDD', 'Freelance', 'Stage']),
            'document' => $this->faker->optional()->word, 
            'startDate' => $this->faker->date(),
            'endDate' => $this->faker->date(),
        ];
    }
}
```

### PermissionFactory:

```php
<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'create-employe',
                'edit-employe',
                'delete-employe',
                'view-employe',
                'create-department',
                'edit-department',
                'delete-department',
                'view-department',
                'create-contract',
                'edit-contract',
                'delete-contract',
                'view-contract',
                'approve-leave',
                'reject-leave',
                'manage-payroll',    
                'generate-reports',
            ]),
            'guard_name' => 'web',
        ];
    }
}
```
