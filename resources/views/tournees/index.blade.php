@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="espace">Liste des tournées</h1>

    <a href="{{ route('tournees.create') }}" class="btn btn-primary mb-3">Créer une nouvelle tournée</a>

    @if ($tournees->isEmpty())
        <p>Aucune tournée disponible.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identifiant</th>
                    <th>Jour de préparation</th>
                    <th>Jour de livraison</th>
                    <th>Couleur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tournees as $tournee)
                    <tr>
                        <td>{{ $tournee->id }}</td>
                        <td>{{ $tournee->identifiant }}</td>
                        <td>{{ $tournee->jour_preparation }}</td>
                        <td>{{ $tournee->jour_livraison }}</td>
                        <td style="background-color: {{ $tournee->couleur }};"></td>
                        <td>
                            <a href="{{ route('tournees.show', $tournee->id) }}" class="btn btn-info">Voir</a>
                            <a href="{{ route('tournees.edit', $tournee->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('tournees.destroy', $tournee->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection