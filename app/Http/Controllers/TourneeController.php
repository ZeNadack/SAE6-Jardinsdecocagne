<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournee;
use App\Models\PointDepot;

class TourneeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tournees = Tournee::all();

        return view('tournees.index', compact('tournees'));
    }

    public function create()
    {
        $pointDepots = PointDepot::all();

        return view('tournees.create', compact('pointDepots'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identifiant' => 'required|string|max:255',
            'jour_preparation' => 'required|date',
            'jour_livraison' => 'required|date',
            'couleur' => 'required|string|max:255',
            'point_depots' => 'required|array',
            'point_depots.*' => 'exists:point_depots,id',
        ]);

        $tournee = Tournee::create($validatedData);

        foreach ($request->point_depots as $index => $pointDepotId) {
            $tournee->pointDepots()->attach($pointDepotId, ['ordre' => $index + 1]);
        }

        return redirect()->route('tournees.index')->with('success', 'Tournée créée avec succès.');
    }

    public function show($id)
    {
        $tournee = Tournee::with('pointDepots')->findOrFail($id);

        return view('tournees.show', compact('tournee'));
    }

    public function edit($id)
    {
        $tournee = Tournee::with('pointDepots')->findOrFail($id);
        $pointDepots = PointDepot::all();

        return view('tournees.edit', compact('tournee', 'pointDepots'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'identifiant' => 'required|string|max:255',
            'jour_preparation' => 'required|date',
            'jour_livraison' => 'required|date',
            'couleur' => 'required|string|max:255',
        ]);

        $tournee = Tournee::findOrFail($id);
        $tournee->update($validatedData);

        return redirect()->route('tournees.index')->with('success', 'Tournée mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $tournee = Tournee::findOrFail($id);
        $tournee->pointDepots()->detach();
        $tournee->delete();

        return redirect()->route('tournees.index')->with('success', 'Tournée supprimée avec succès.');
    }

}
