<?php

namespace App\Http\Controllers;

use App\Models\Recuperation;
use App\Http\Requests\StoreRecuperationRequest;
use App\Http\Requests\UpdateRecuperationRequest;
use Illuminate\Auth\Events\Validated;

class RecuperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recuperations = Recuperation::where('user_id', auth()->id())->get();
        return view('recuperations.index', compact('recuperations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $recuperations = Recuperation::where('user_id', auth()->id())->get();
        return view('recuperations.create', compact('recuperations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecuperationRequest $request)
    {
        $user = auth()->user();

        if ($request->jours_demandes > $user->jours_recuperation) {
            return redirect()->route('recuperations.create')->with('error', 'Le nombre de jours demandés dépasse votre solde de récupération disponible.');
        }

        $recuperation = Recuperation::create([
            'user_id' => $user->id,
            'date_recuperation' => $request->date_recuperation,
            'jours_demandes' => $request->jours_demandes,
            'status' => 'pending',
        ]);

        return redirect()->route('recuperations.index')->with('success', 'Demande de récupération soumise avec succès.');
    }

    public function approve($id)
    {
        if (!auth()->user()->hasRole('RH Manager')) {
            return redirect()->route('recuperations.index')->with('error', 'Accès refusé.');
        }

        $recuperation = Recuperation::findOrFail($id);

        $recuperation->update(['status' => 'approved']);

        $user = $recuperation->user;
        $user->jours_recuperation -= $recuperation->jours_demandes;
        $user->save();

        return redirect()->route('recuperations.actions')->with('success', 'Demande de récupération approuvée.');
    }

    public function reject($id)
    {
        if (!auth()->user()->hasRole('RH Manager')) {
            return redirect()->route('recuperations.index')->with('error', 'Accès refusé.');
        }

        $recuperation = Recuperation::findOrFail($id);

        $recuperation->update(['status' => 'rejected']);

        return redirect()->route('recuperations.actions')->with('success', 'Demande de récupération rejetée.');
    }

    public function actions()
    {
        if (!auth()->user()->hasRole('RH Manager')) {
            return redirect()->route('recuperations.index')->with('error', 'Accès refusé.');
        }
        $recuperations = Recuperation::where('status', 'pending')->get();

        return view('recuperations.actions', compact('recuperations'));
    }

    public function cancel($id)
    {
        $recuperation = Recuperation::findOrFail($id);

        if ($recuperation->user_id !== auth()->id()) {
            return redirect()->route('recuperations.index')->with('error', 'Vous n\'êtes pas autorisé à annuler cette demande.');
        }

        if ($recuperation->status !== 'pending') {
            return redirect()->route('recuperations.index')->with('error', 'Seules les demandes en attente peuvent être annulées.');
        }

        $user = $recuperation->user;

        $user->jours_recuperation += $recuperation->jours_demandes;
        $user->save();

        $recuperation->delete();

        return redirect()->route('recuperations.index')->with('success', 'La demande a été annulée avec succès. Vos jours de récupération ont été récupérés.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $recuperation = Recuperation::findOrFail($id);
        if ($recuperation->user_id !== auth()->id()) {
            return redirect()->route('recuperations.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cette demande.');
        }
        if ($recuperation->status !== 'pending') {
            return redirect()->route('recuperations.index')->with('error', 'Seules les demandes en attente peuvent être modifiées.');
        }

        return view('recuperations.edit', compact('recuperation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRecuperationRequest $request, $id)
    {
        $recuperation = Recuperation::findOrFail($id);
        if ($recuperation->user_id !== auth()->id()) {
            return redirect()->route('recuperations.index')->with('error', 'Vous n\'êtes pas autorisé à modifier cette demande.');
        }
        if ($recuperation->status !== 'pending') {
            return redirect()->route('recuperations.index')->with('error', 'Seules les demandes en attente peuvent être modifiées.');
        }
        $data = $request->validated();
        $recuperation->update($data);

        return redirect()->route('recuperations.index')->with('success', 'La demande a été modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recuperation $recuperation)
    {
        //
    }
}