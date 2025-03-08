<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Joobs;
use App\Models\Cariere;
use App\Models\Contract;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Mail\UserCredentialsMail;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // dd($user);
        if ($user->hasRole('Employé')) {
            $users = User::with(['roles', 'department', 'contract', 'joob'])
                ->where('id', $user->id)
                ->paginate(10);
        } else {
            $users = User::with(['roles', 'department', 'contract', 'joob'])->paginate(10);
        }

        return view('users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
        $departments = Departement::all();
        $contracts = Contract::all();
        $joobs = Joobs::with('department')->get()->groupBy('department_id');

        return view('users.create', compact('roles', 'departments', 'joobs', 'contracts'));
    }


    public function store(StoreUserRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
        }

        $password = $request->password;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'recruitment_date' => $request->recruitment_date,
            'salary' => $request->salary,
            'status' => $request->status,
            'department_id' => $request->department_id,
            'contract_id' => $request->contract_id,
            'job_id' => $request->job_id,
            'password' => Hash::make($password),
            'image' => $imagePath,
            'grade' => $request->grade,
            'jours_recuperation' => 0,
        ]);

        if ($user) {
            $department = Departement::find($request->department_id)->name;
            $role = Role::find($request->role_id)->name;
            $contract = Contract::find($request->contract_id)->typeContract;

            Cariere::create([
                'user_id' => $user->id,
                'date_position' => now(),
                'recruitment_date' => $user->recruitment_date,
                'salary' => $user->salary,
                'departement' => $department,
                'role' => $role,
                'contract' => $contract,
                'grade' =>$user->grade,
            ]);
        }

        $role = Role::find($request->role_id);
        $user->assignRole($role);

        // Mail::to($user->email)->send(new UserCredentialsMail($user, $password));
        return redirect()->route('users.index')->with('success', 'Employé ajouté avec succès.');
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'Admin')->get();
        $departments = Departement::all();
        $contracts = Contract::all();
        $joobs = Joobs::with('department')->get()->groupBy('department_id');

        return view('users.edit', compact('user', 'roles', 'departments', 'contracts', 'joobs'));
    }


    public function update(UpdateUserRequest $request, User $user)
{
    // Gestion de l'image
    $imagePath = $user->image;
    if ($request->hasFile('image')) {
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $imagePath = $request->file('image')->store('users', 'public');
    }

    // Mise à jour des informations de l'utilisateur
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'birthday' => $request->birthday,
        'address' => $request->address,
        'recruitment_date' => $request->recruitment_date,
        'salary' => $request->salary,
        'status' => $request->status,
        'department_id' => $request->department_id,
        'contract_id' => $request->contract_id,
        'job_id' => $request->job_id,
        'image' => $imagePath,
        'grade' => $request->grade,
        'jours_recuperation' => $request->jours_recuperation, 
    ]);

    // Attribuer le rôle à l'utilisateur
    $role = Role::find($request->role_id);
    $user->syncRoles([$role]);

    // Récupérer les nouvelles informations pour la table cariere
    $department = Departement::find($request->department_id)->name;
    $roleName = Role::find($request->role_id)->name;
    $contract = Contract::find($request->contract_id)->typeContract;

    // Créer une nouvelle entrée dans la table cariere
    Cariere::create([
        'user_id' => $user->id,
        'date_position' => now(), 
        'recruitment_date' => $user->recruitment_date,
        'salary' => $user->salary,
        'departement' => $department,
        'role' => $roleName,
        'contract' => $contract,
        'grade' =>$user->grade,
    ]);

    return redirect()->route('users.index')->with('success', 'Employé mis à jour avec succès.');
}


    public function show(User $user)
    {
        // $user->load('roles', 'department', 'contract', 'joob');
        // return view('users.show');
    }


    public function destroy(User $user)
    {
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Employé supprimé avec succès.');
    }
}
