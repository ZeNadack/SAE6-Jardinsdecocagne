<?php

namespace App\Http\Controllers;

use App\Models\PointDepot;
use Illuminate\Http\Request;

class PointDepotController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pointDepots = PointDepot::all();
        return view('point-depots.index', compact('pointDepots'));
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('point-depots.create');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'ville' => 'required|string|max:255',
            'commentaires' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        PointDepot::create($validatedData);

        return redirect()->route('point-depots.index')->with('success', 'Point de dépôt créé avec succès.');
    }


    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pointDepot = PointDepot::findOrFail($id);

        return view('point-depots.show', compact('pointDepot'));
    }

    public function edit($id)
    {
        $pointDepot = PointDepot::findOrFail($id);
        return view('point-depots.edit', compact('pointDepot'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'ville' => 'required|string|max:255',
            'commentaires' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $pointDepot = PointDepot::findOrFail($id);
        $pointDepot->update($validatedData);

        return redirect()->route('point-depots.index')->with('success', 'Point de dépôt mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $pointDepot = PointDepot::findOrFail($id);
        $pointDepot->delete();

        return redirect()->route('point-depots.index')->with('success', 'Point de dépôt supprimé avec succès.');
    }
}