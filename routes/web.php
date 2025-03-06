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
        // Route::get('/demandes', [DemandeCongeController::class, 'index'])->name('demandes.index'); 
    });

    Route::middleware(['auth', 'role:Admin'])->group(function () {
        Route::resource('departements', DepartementController::class);
        // Route::get('/demandes', [DemandeCongeController::class, 'index'])->name('demandes.index'); 
    });
    
    Route::middleware(['auth', 'role:Admin|Employé|RH Manager|Manager'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index'); 
        Route::get('/users/{userId}/cariere', [CariereController::class, 'index'])->name('users.cariere');
        Route::get('/hierarchie', [HierarchieController::class, 'index'])->name('hierarchie.index');
    });

    Route::middleware(['auth', 'role:Employé'])->group(function () {
        // Route::get('/demande-conge', [DemandeCongeController::class, 'create'])->name('demande.create'); 
    });
    

    Route::middleware('auth')->group(function () {
        Route::get('/conges', [CongeController::class, 'index'])->name('conges.index');
        Route::get('/conges/create', [CongeController::class, 'create'])->name('conges.create');
        Route::post('/conges', [CongeController::class, 'store'])->name('conges.store');
        Route::post('/conges/{id}/approve-manager', [CongeController::class, 'approveByManager'])->name('conges.approve.manager');
        Route::post('/conges/{id}/approve-hr', [CongeController::class, 'approveByHR'])->name('conges.approve.hr');
        Route::post('/conges/{id}/reject', [CongeController::class, 'reject'])->name('conges.reject');

        Route::get('/conges/actions', [CongeController::class, 'actions'])->name('conges.actions');
    });

require __DIR__ . '/auth.php';
