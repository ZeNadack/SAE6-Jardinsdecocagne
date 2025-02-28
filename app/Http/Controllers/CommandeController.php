<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\PointDepot;
use App\Models\Commande;
use App\Models\Adherent;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $abonnements = Abonnement::all();
        $pointDepots = PointDepot::all();
        $adherents = Adherent::all();
        $commandes = Commande::with(['adherent', 'abonnement', 'pointDepot'])->get();

        return view('commandes.create', compact('abonnements', 'pointDepots', 'adherents', 'commandes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'adherent_id' => 'required|exists:adherents,id',
            'abonnement_id' => 'required|exists:abonnements,id',
            'point_depot_id' => 'required|exists:point_depots,id',
            'date_livraison' => 'required|date',
        ]);

        Commande::create($validatedData);

        return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
