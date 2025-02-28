<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abonnement;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('abonnements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'frequence' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);

        Abonnement::create($validatedData);

        return redirect()->route('abonnements.index')->with('success', 'Abonnement créé avec succès.');
    }
}
