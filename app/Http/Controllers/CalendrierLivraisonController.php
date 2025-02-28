<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalendrierLivraison;
use App\Models\Tournee;
use App\Models\JourFerie;
use App\Models\SemaineFermeture;
use Carbon\Carbon;

class CalendrierLivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $tournees = Tournee::all();
        $joursFeries = JourFerie::all();
        $semainesFermeture = SemaineFermeture::all();

        return view('calendrier-livraisons.create', compact('tournees', 'joursFeries', 'semainesFermeture'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tournee_id' => 'required|exists:tournees,id',
            'frequence' => 'required|in:hebdomadaire,bimensuel,mensuel',
            'date_livraison' => 'required|date',
        ]);

        $dateLivraison = Carbon::parse($request->date_livraison);

        $estJourFerie = JourFerie::where('date', $dateLivraison->toDateString())->exists();
        if ($estJourFerie) {
            return redirect()->back()
                ->withErrors(['date_livraison' => 'La date de livraison est un jour férié.'])
                ->withInput();
        }

        $estEnFermeture = SemaineFermeture::where('debut_semaine', '<=', $dateLivraison)
            ->where('fin_semaine', '>=', $dateLivraison)
            ->exists();
        if ($estEnFermeture) {
            return redirect()->back()
                ->withErrors(['date_livraison' => 'La date de livraison est dans une semaine de fermeture.'])
                ->withInput();
        }

        CalendrierLivraison::create([
            'tournee_id' => $request->tournee_id,
            'date_livraison' => $dateLivraison,
            'frequence' => $request->frequence,
            'est_livrable' => true,
        ]);

        return redirect()->route('calendrier-livraisons.index')->with('success', 'Calendrier de livraison créé avec succès.');
    }

    private function genererDatesLivraison($dateDebut, $dateFin, $frequence, $joursFeries, $semainesFermeture)
    {
        $datesLivraison = [];
        $currentDate = Carbon::parse($dateDebut);

        while ($currentDate <= Carbon::parse($dateFin)) {
            if (in_array($currentDate->toDateString(), $joursFeries)) {
                $currentDate->addDay();
                continue;
            }

            $estEnFermeture = false;
            foreach ($semainesFermeture as $semaine) {
                if ($currentDate->between($semaine->debut_semaine, $semaine->fin_semaine)) {
                    $estEnFermeture = true;
                    break;
                }
            }
            if ($estEnFermeture) {
                $currentDate->addWeek();
                continue;
            }

            $datesLivraison[] = $currentDate->toDateString();

            switch ($frequence) {
                case 'hebdomadaire':
                    $currentDate->addWeek();
                    break;
                case 'bimensuel':
                    $currentDate->addWeeks(2);
                    break;
                case 'mensuel':
                    $currentDate->addMonth();
                    break;
            }
        }

        return $datesLivraison;
    }

    public function index()
    {
        $calendrierLivraisons = CalendrierLivraison::with('tournee')->get();

        return view('calendrier-livraisons.index', compact('calendrierLivraisons'));
    }

    public function edit($id)
    {
        $calendrierLivraison = CalendrierLivraison::with('tournee')->findOrFail($id);

        $tournees = Tournee::all();

        return view('calendrier-livraisons.edit', compact('calendrierLivraison', 'tournees'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tournee_id' => 'required|exists:tournees,id',
            'frequence' => 'required|in:hebdomadaire,bimensuel,mensuel',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $calendrierLivraison = CalendrierLivraison::findOrFail($id);

        $calendrierLivraison->where('tournee_id', $calendrierLivraison->tournee_id)->delete();

        $joursFeries = JourFerie::pluck('date')->toArray();
        $semainesFermeture = SemaineFermeture::all();

        $datesLivraison = $this->genererDatesLivraison(
            $request->date_debut,
            $request->date_fin,
            $request->frequence,
            $joursFeries,
            $semainesFermeture
        );

        foreach ($datesLivraison as $date) {
            CalendrierLivraison::create([
                'tournee_id' => $calendrierLivraison->tournee_id,
                'date_livraison' => $date,
                'est_livrable' => true,
            ]);
        }

        return redirect()->route('calendrier-livraisons.index')->with('success', 'Calendrier de livraison mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $calendrierLivraison = CalendrierLivraison::findOrFail($id);

        $calendrierLivraison->where('tournee_id', $calendrierLivraison->tournee_id)->delete();

        return redirect()->route('calendrier-livraisons.index')->with('success', 'Calendrier de livraison supprimé avec succès.');
    }
}
