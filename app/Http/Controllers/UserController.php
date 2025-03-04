<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Joobs;
use App\Models\Contract;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Mail\UserCredentialsMail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'department', 'contract', 'joob'])->paginate(10);
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
            'status' => 'required|in:actif,inactif',
            'role_id' => 'required|integer',
            'department_id' => 'required|integer',
            'contract_id' => 'nullable|integer',
            'job_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

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
        ]);

        $role = Role::find($request->role_id);
        $user->assignRole($role);

        // Mail::to($user->email)->send(new UserCredentialsMail($user, $password));

        return redirect()->route('users.index')->with('success', 'Employé ajouté avec succès.');
    }


    public function show(User $user)
    {
        $user->load('roles', 'department', 'contract', 'joob');
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'Admin')->get();
        $departments = Departement::all();
        $contracts = Contract::all();
        $joobs = Joobs::with('department')->get()->groupBy('department_id');

        return view('users.edit', compact('user', 'roles', 'departments', 'contracts', 'joobs'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'recruitment_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'status' => 'required|in:actif,inactif',
            'role_id' => 'required|integer',
            'department_id' => 'required|integer',
            'contract_id' => 'nullable|integer',
            'job_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $user->image;
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('users', 'public');
        }

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
        ]);

        $role = Role::find($request->role_id);
        $user->syncRoles([$role]);

        return redirect()->route('users.index')->with('success', 'Employé mis à jour avec succès.');
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
