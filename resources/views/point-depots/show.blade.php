@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du point de dépôt</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $pointDepot->nom }}</h5>
            <p class="card-text">
                <strong>Adresse :</strong> {{ $pointDepot->adresse }}<br>
                <strong>Code Postal :</strong> {{ $pointDepot->code_postal }}<br>
                <strong>Ville :</strong> {{ $pointDepot->ville }}<br>
                <strong>Commentaires :</strong> {{ $pointDepot->commentaires ?? 'Aucun commentaire' }}
            </p>
            <a href="{{ route('point-depots.edit', $pointDepot->id) }}" class="btn btn-warning">Modifier</a>
            <form action="{{ route('point-depots.destroy', $pointDepot->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            <a href="{{ route('point-depots.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection