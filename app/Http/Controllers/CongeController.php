<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CongeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $conges = Conge::where('user_id', $user->id)->get();

        // Calcul du solde de congés
        $dateEmbauche = Carbon::parse($user->recruitment_date);
        $aujourdHui = Carbon::today();
        $moisTravail = $dateEmbauche->diffInMonths($aujourdHui);
        $anneesTravail = $dateEmbauche->diffInYears($aujourdHui);

        if ($anneesTravail >= 1) {
            $joursDisponibles = 18 + ($anneesTravail - 1) * 0.5;
        } else {
            $joursDisponibles = $moisTravail * 1.5;
        }

        return view('conges.index', compact('conges', 'joursDisponibles'));
    }


    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {
        $utilisateur = auth()->user();
        $aujourdHui = Carbon::today();

        $dateDebut = Carbon::parse($request->start_date);
        $dateFin = Carbon::parse($request->end_date);

        // Calcul des jours de congé en excluant les weekends
        $totalJours = $dateDebut->diffInDaysFiltered(function ($date) {
            return !$date->isWeekend(); // Exclure weekend
        }, $dateFin);

        $request->validate([
            'start_date' => 'required|date|after_or_equal:' . $aujourdHui->addWeek(),
            'end_date' => 'required|date|after:start_date',
            'cause' => 'nullable|string',
        ]);

        // Calcul des jours de congé disponibles
        $dateEmbauche = Carbon::parse($utilisateur->recruitment_date);
        $moisTravail = $dateEmbauche->diffInMonths($aujourdHui);
        $anneesTravail = $dateEmbauche->diffInYears($aujourdHui);

        if ($anneesTravail >= 1) {
            $joursDisponibles = 18 + ($anneesTravail - 1) * 0.5;
        } else {
            $joursDisponibles = $moisTravail * 1.5;
        }

        // Vérifier si le nombre de jours demandés dépasse le solde disponible
        if ($totalJours > $joursDisponibles) {
            return redirect()->route('conges.create')->with('error_conge', 'La durée de votre demande dépasse votre solde de congés disponible : ' . intval($joursDisponibles) . ' jours');
        }

        // Définir les statuts de validation
        if ($utilisateur->hasRole('Manager')) {
            $statutManager = 'approved';
        } else {
            $statutManager = 'pending';
        }

        $statutRhManager = 'pending';
        $statutDemandeur = 'pending';

        // Créer la demande de congé
        Conge::create([
            'user_id' => $utilisateur->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $totalJours,
            'status_manager' => $statutManager,
            'status_rh_manager' => $statutRhManager,
            'status_demandeur' => $statutDemandeur,
            'cause' => $request->cause,
        ]);

        return redirect()->route('conges.index')->with('success', 'Demande de congé soumise avec succès.');
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
            //departement du manager
            $department = $user->department;
            if (!$department) {
                return redirect()->route('conges.index')->with('error', 'Vous n\'êtes pas assigné à un département.');
            }
            //demandes de congé ce département en attente
            $conges = Conge::whereHas('user', function ($query) use ($department) {
                $query->where('department_id', $department->id);
            })->where('status_manager', 'pending')->get();
        }
        // si l'utilisateur : RH Manager
        elseif ($user->hasRole('RH Manager')) {
            // demandes RHs en attente de validation par RH
            $conges = Conge::where('status_rh_manager', 'pending')->get();
        }
        // Sinon, accès refusé
        else {
            return redirect()->route('conges.index')->with('error', 'Vous n\'avez pas les permissions pour accéder à cette page.');
        }

        return view('conges.actions', compact('conges'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conge $conge)
    {
        $conge->delete();

        return redirect()->route('conges.index')
            ->with('success', 'conge supprimée avec succès.');
    }
}
