<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::latest()->paginate(6);
        return view('formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('formations.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormationRequest $request)
    {
        $validatedData = $request->validated();

        $formation = Formation::create($validatedData);

        if ($request->has('users')) {
            $formation->users()->attach($request->users);
        }

        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        return view('formations.show', compact('formation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        $users = User::all();
        return view('formations.edit', compact('formation', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $validatedData = $request->validated();

        $formation->update($validatedData);

        if ($request->has('users')) {
            $formation->users()->sync($request->users);
        } else {
            $formation->users()->detach();
        }

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès.');
    }
}
