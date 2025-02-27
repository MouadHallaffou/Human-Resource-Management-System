<?php

namespace App\Http\Controllers;

use App\Models\Joobs;
use App\Http\Requests\StoreJoobsRequest;
use App\Http\Requests\UpdateJoobsRequest;

class JoobsController extends Controller
{
    /**
     * Affiche la liste des joobs.
     */
    public function index()
    {
        $joobs = Joobs::latest()->paginate(8); 
        return view('joobs.index', compact('joobs')); 
    }

    /**
     * Affiche le formulaire de création d'un joob.
     */
    public function create()
    {
        return view('joobs.create');
    }

    /**
     * Enregistre un nouveau joob.
     */
    public function store(StoreJoobsRequest $request)
    {
        $validatedData = $request->validated();

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
        return view('joobs.edit', compact('joob')); 
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
    public function destroy(Joobs $joob) // Utilisez $joob au lieu de $joobs
    {
        $joob->delete();

        return redirect()->route('joobs.index') // Assurez-vous que la route est correctement nommée
            ->with('success', 'Joob supprimé avec succès.');
    }

}