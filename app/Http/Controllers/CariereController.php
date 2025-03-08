<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cariere;
use App\Http\Requests\StoreCariereRequest;
use App\Http\Requests\UpdateCariereRequest;

class CariereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Dans CarriereController.php
    public function index($userId)
    {
        $user = User::with(['roles', 'department', 'contract', 'joob', 'carieres', 'formations'])->findOrFail($userId);
        $carieres = $user->carieres()->orderBy('date_position', 'desc')->get();
        $formations = $user->formations()->get();

        return view('users.show', compact('user', 'carieres', 'formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('carieres.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCariereRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_position' => 'required|date',
        ]);

        Cariere::create([
            'user_id' => $request->user_id,
            'position' => $request->title,
            'description' => $request->description,
            'date_position' => $request->date_position,
        ]);

        return redirect()->route('cariere.index', $request->user_id)
            ->with('success', 'Élément ajouté au cursus avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cariere $cariere)
    {
        return view('carieres.show', compact('cariere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cariere $cariere)
    {
        $users = User::all();
        return view('carieres.edit', compact('cariere', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCariereRequest $request, Cariere $cariere)
    {
        $request->validate([
            'newPosition' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'date_position' => 'required|date',
        ]);

        $cariere->update($request->all());

        return redirect()->route('carieres.index')->with('success', 'Carrière mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cariere $cariere)
    {
        $cariere->delete();
        return redirect()->route('carieres.index')->with('success', 'Carrière supprimée avec succès.');
    }
}
