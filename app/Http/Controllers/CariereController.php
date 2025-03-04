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
    public function index()
    {
        $carieres = Cariere::with('user')->get();
        return view('carieres.index', compact('carieres'));
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
            'newPosition' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'date_position' => 'required|date',
        ]);

        Cariere::create($request->all());

        return redirect()->route('carieres.index')->with('success', 'Carrière créée avec succès.');
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
