<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HierarchieController extends Controller
{
    public function index()
    {
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->first();

        $rhManagers = User::whereHas('roles', function ($query) {
            $query->where('name', 'RH manager');
        })->get();

        $managers = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();

        $employees = User::whereHas('roles', function ($query) {
            $query->where('name', 'employe');
        })->get();

        return view('hierarchie.index', compact('admin', 'rhManagers', 'managers', 'employees'));
    }
}
