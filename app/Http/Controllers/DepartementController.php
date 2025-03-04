<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Departement;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departements = Departement::latest()->paginate(8);
        return view('departements.index', compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();
        
        return view('departements.create', compact('companies', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartementRequest $request)
    {
        $validatedData = $request->validated();

        Departement::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'company_id' => $validatedData['company_id'],
            'responsable_id' => $validatedData['responsable_id'],
        ]);

        return redirect()->route('departements.index')
            ->with('success', 'Département créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        $companies = Company::all();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();
        
        return view('departements.edit', compact('departement', 'companies', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $validatedData = $request->validated();

        $departement->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'company_id' => $validatedData['company_id'],
            'responsable_id' => $validatedData['responsable_id'],
        ]);

        return redirect()->route('departements.index')
            ->with('success', 'Département créé avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect()->route('departements.index')
            ->with('success', 'departement supprimée avec succès.');
    }
}
