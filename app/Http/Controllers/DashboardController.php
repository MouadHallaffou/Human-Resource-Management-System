<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departement;
use App\Models\Joobs;
use App\Models\Formation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = User::whereHas('roles', function ($query) {
            $query->where('name', 'employé');
        })->count();
        $totalDepartments = Departement::count();
        $totalJobs = Joobs::count();
        $totalManagers = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->count();
        $totalTrainings = Formation::count();

        return view('dashboard', compact(
            'totalEmployees',
            'totalDepartments',
            'totalJobs',
            'totalManagers',
            'totalTrainings'
        ));
    }
}
