<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Contract;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCredentialsMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
     /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $roles = Role::all();
        $departments = Departement::all();
        $contracts = Contract::all(); 
        return view('users.create', compact('roles', 'departments', 'contracts'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'recruitment_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'status' => 'nullable|string',
            'role_id' => 'required|integer',
            'department_id' => 'required|integer',
            'formation_id' => 'nullable|integer',
        ]);

        $password = Str::random(10);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'recruitment_date' => $request->recruitment_date,
            'salary' => $request->salary,
            'status' => $request->status,
            'role_id' => $request->role_id,
            'department_id' => $request->department_id,
            'formation_id' => $request->formation_id,
            'password' => Hash::make($password), 
        ]);

        Mail::to($user->email)->send(new UserCredentialsMail($user, $password));

        return redirect()->route('users.index')->with('success', 'Employé ajouté avec succès et email envoyé.');
    }
}


