<?php

use App\Models\Departement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JoobsController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\FormationController;
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


require __DIR__.'/auth.php';
