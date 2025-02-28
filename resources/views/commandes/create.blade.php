@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="espace">Passer une commande</h1>

        <form action="{{ route('commandes.store') }}" method="POST">
            @csrf

            <div class="card mb-4">
                <div class="card-header">Sélectionnez un adhérent</div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="adherent_id" id="adherent_id" class="form-control" required>
                            @foreach ($adherents as $adherent)
                                <option value="{{ $adherent->id }}">{{ $adherent->nom }} ({{ $adherent->email }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Sélectionnez un abonnement</div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="abonnement_id" id="abonnement_id" class="form-control" required>
                            @foreach ($abonnements as $abonnement)
                                <option value="{{ $abonnement->id }}">{{ $abonnement->nom }}
                                    - {{ $abonnement->prix }} €</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Sélectionnez un un point de dépôt</div>
                <div class="card-body">
                    <div class="form-group">
                        <select name="point_depot_id" id="point_depot_id" class="form-control" required>
                            @foreach ($pointDepots as $pointDepot)
                                <option value="{{ $pointDepot->id }}">{{ $pointDepot->nom }} ({{ $pointDepot->adresse }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Sélectionnez une date de livraison</div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="date" name="date_livraison" id="date_livraison" class="form-control" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Passer la commande</button>
        </form>

        <div class="card mt-4">
            <div class="card-header">Commandes existantes</div>
            <div class="card-body">
                @if ($commandes->isEmpty())
                    <p>Aucune commande enregistrée.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Adhérent</th>
                                <th>Abonnement</th>
                                <th>Point de dépôt</th>
                                <th>Date de livraison</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->adherent->nom }}</td>
                                    <td>{{ $commande->abonnement->nom }}</td>
                                    <td>{{ $commande->pointDepot->nom }}</td>
                                    <td>{{ $commande->date_livraison }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
