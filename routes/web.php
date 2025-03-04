<?php

use App\Http\Controllers\hierarchie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JoobsController;
use App\Http\Controllers\CariereController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HierarchieController;
use App\Http\Controllers\DepartementController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    
Route::resource('departements', DepartementController::class);
Route::resource('contracts', ContractController::class);
Route::resource('joobs', JoobsController::class);
Route::resource('formations', FormationController::class);
Route::resource('users', UserController::class);
Route::resource('carieres', CariereController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('hierarchie', HierarchieController::class);


require __DIR__.'/auth.php';



















// Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('departements', DepartementController::class);
//     Route::resource('contracts', ContractController::class);
//     Route::resource('joobs', JoobsController::class);
//     Route::resource('formations', FormationController::class);
//     Route::resource('users', UserController::class);
//     Route::resource('carieres', CariereController::class);
//     Route::resource('hierarchie', HierarchieController::class);
// });

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('dashboard');
// require __DIR__.'/auth.php';
