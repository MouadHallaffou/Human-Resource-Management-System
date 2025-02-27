<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::latest()->paginate(10); 
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contracts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('documents', 'public');
            $validatedData['document'] = $documentPath;
        }

        Contract::create($validatedData);

        return redirect()->route('contracts.index')
            ->with('success', 'Contrat créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('document')) {
            // Supprimer l'ancien document 
            if ($contract->document) {
                Storage::disk('public')->delete($contract->document);
            }
            $documentPath = $request->file('document')->store('documents', 'public');
            $validatedData['document'] = $documentPath;
        }

        $contract->update($validatedData);

        return redirect()->route('contracts.index')
            ->with('success', 'Contrat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('contracts.index')
            ->with('success', 'Contrat supprimé avec succès.');
    }
}