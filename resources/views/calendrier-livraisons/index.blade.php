@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="espace">Liste des calendriers de livraison</h1>

        <a href="{{ route('calendrier-livraisons.create') }}" class="btn btn-primary mb-3">Créer un nouveau calendrier</a>

        @if ($calendrierLivraisons->isEmpty())
            <p>Aucun calendrier de livraison disponible.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tournée</th>
                        <th>Date de livraison</th>
                        <th>Fréquence</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calendrierLivraisons as $calendrier)
                        <tr>
                            <td>{{ $calendrier->id }}</td>
                            <td>{{ $calendrier->tournee->identifiant }}</td>
                            <td>{{ $calendrier->date_livraison }}</td>
                            <td>{{ $calendrier->frequence }}</td>
                            <td>
                                <a href="{{ route('calendrier-livraisons.edit', $calendrier->id) }}"
                                    class="btn btn-warning">Modifier</a>
                                <form action="{{ route('calendrier-livraisons.destroy', $calendrier->id) }}" method="POST"
                                    style="display:inline;">
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
