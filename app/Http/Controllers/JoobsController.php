<?php

namespace App\Http\Controllers;

use App\Models\Joobs;
use App\Models\Departement;
use App\Http\Requests\StoreJoobsRequest;
use App\Http\Requests\UpdateJoobsRequest;

class JoobsController extends Controller
{
    /**
     * Affiche la liste des joobs.
     */
    public function index()
    {
        $joobs = Joobs::with('department')->paginate(10); 
        return view('joobs.index', compact('joobs')); 
    }

    /**
     * Affiche le formulaire de création d'un joob.
     */
    public function create()
    {
        $departments = Departement::all();
        return view('joobs.create', compact('departments'));
    }

    /**
     * Enregistre un nouveau joob.
     */
    public function store(StoreJoobsRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        Joobs::create($validatedData);

        return redirect()->route('joobs.index') 
            ->with('success', 'Joob créé avec succès.');
    }

    /**
     * Affiche les détails d'un joob.
     */
    public function show(Joobs $joob) 
    {
        return view('joobs.show', compact('joob')); 
    }

    /**
     * Affiche le formulaire de modification d'un joob.
     */
    public function edit(Joobs $joob) 
    {
        $departments = Departement::all();
        return view('joobs.edit', compact('joob', 'departments')); 
    }

    /**
     * Met à jour un joob.
     */
    public function update(UpdateJoobsRequest $request, Joobs $joob) 
    {
        $validatedData = $request->validated();

        $joob->update($validatedData);

        return redirect()->route('joobs.index') 
            ->with('success', 'Joob mis à jour avec succès.');
    }

    /**
     * Supprime un joob.
     */
    public function destroy(Joobs $joob) 
    {
        $joob->delete();

        return redirect()->route('joobs.index') 
            ->with('success', 'Joob supprimé avec succès.');
    }

}