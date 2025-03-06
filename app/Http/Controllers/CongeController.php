<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CongeController extends Controller
{
    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'cause' => 'nullable|string',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $totalDays = $startDate->diffInDays($endDate);

        Conge::create([
            'user_id' => auth()->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalDays,
            'status_manager' => 'pending',
            'status_rh_manager' => 'pending',
            'status_demandeur' => 'pending',
            'cause' => $request->cause,
        ]);

        return redirect()->route('conges.index')->with('success', 'Demande de congé soumise avec succès.');
    }

    
    public function index()
    {
        $user = auth()->user();
        $conges = Conge::where('user_id', $user->id)->get();
        return view('conges.index', compact('conges'));
    }

    // Valider la demande par le manager
    public function approveByManager($id)
    {
        $user = auth()->user();
        $conge = Conge::findOrFail($id);

        if ($user->hasRole('Manager')) {
            $conge->update(['status_manager' => 'approved']);
        }

        $this->updateStatusDemandeur($conge);

        return redirect()->back()->with('success', 'Demande approuvée par le manager.');
    }

    // Valider la demande par le RH manager
    public function approveByHR($id)
    {
        $user = auth()->user();
        $conge = Conge::findOrFail($id);

        if ($user->hasRole('RH Manager')) {
            $conge->update(['status_rh_manager' => 'approved']);
        }

        $this->updateStatusDemandeur($conge);

        return redirect()->back()->with('success', 'Demande approuvée par le RH manager.');
    }

    // Rejeter la demande
    public function reject($id)
    {
        $user = auth()->user();
        $conge = Conge::findOrFail($id);

        if ($user->hasRole('Manager')) {
            $conge->update(['status_manager' => 'rejected']);
        } elseif ($user->hasRole('RH Manager')) {
            $conge->update(['status_rh_manager' => 'rejected']);
        }

        $this->updateStatusDemandeur($conge);

        return redirect()->back()->with('success', 'Demande rejetée.');
    }

    // Mettre à jour le statut final
    private function updateStatusDemandeur($conge)
    {
        $statusManager = $conge->status_manager;
        $statusRH = $conge->status_rh_manager;

        if ($statusManager === 'rejected' || $statusRH === 'rejected') {
            $statusDemandeur = 'rejected';
        } elseif ($statusManager === 'approved' && $statusRH === 'approved') {
            $statusDemandeur = 'approved';
        } else {
            $statusDemandeur = 'pending';
        }

        $conge->update(['status_demandeur' => $statusDemandeur]);
    }


    public function actions()
    {
        $user = auth()->user();

        if ($user->hasRole('Manager')) {
            $conges = Conge::where('status_manager', 'pending')->get();
        } elseif ($user->hasRole('RH Manager')) {
            $conges = Conge::where('status_rh_manager', 'pending')->get();
        } else {
            return redirect()->route('conges.index')->with('error', 'Vous n avez pas les permissions a cette page.');
        }

        return view('conges.actions', compact('conges'));
    }
}
