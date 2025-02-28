@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="espace">Liste des dépôts</h1>

    <a href="{{ route('point-depots.create') }}" class="btn btn-primary mb-3">Créer un nouveau dépôt</a>


    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code Postal</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pointDepots as $pointDepot)
                <tr>
                    <td>{{ $pointDepot->id }}</td>
                    <td>{{ $pointDepot->nom }}</td>
                    <td>{{ $pointDepot->adresse }}</td>
                    <td>{{ $pointDepot->code_postal }}</td>
                    <td>{{ $pointDepot->ville }}</td>
                    <td>
                        <a href="{{ route('point-depots.show', $pointDepot->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('point-depots.edit', $pointDepot->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('point-depots.destroy', $pointDepot->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection