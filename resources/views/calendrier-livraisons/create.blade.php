@extends('layouts.app')

@section('content')
    <div class="container espace">
        <h1>Créer un calendrier de livraison</h1>

        <form action="{{ route('calendrier-livraisons.store') }}" method="POST">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf

            <div class="form-group">
                <label for="tournee_id">Tournée</label>
                <select name="tournee_id" id="tournee_id" class="form-control" required>
                    @foreach ($tournees as $tournee)
                        <option value="{{ $tournee->id }}">{{ $tournee->identifiant }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="frequence">Fréquence</label>
                <select name="frequence" id="frequence" class="form-control" required>
                    <option value="hebdomadaire">Hebdomadaire</option>
                    <option value="bimensuel">Bimensuel</option>
                    <option value="mensuel">Mensuel</option>
                </select>
            </div>

            <div class="form-group espace">
                <label for="date_livraison">Date de livraison</label>
                <input type="date" name="date_livraison" id="date_livraison" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Générer le calendrier</button>
        </form>
    </div>
    <div class="card mb-4">
        <div class="card-header">Jours fériés</div>
        <div class="card-body">
            @if ($joursFeries->isEmpty())
                <p>Aucun jour férié enregistré.</p>
            @else
                <ul>
                    @foreach ($joursFeries as $jourFerie)
                        <li>{{ $jourFerie->date }} : {{ $jourFerie->nom }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Semaines de fermeture</div>
        <div class="card-body">
            @if ($semainesFermeture->isEmpty())
                <p>Aucune semaine de fermeture enregistrée.</p>
            @else
                <ul>
                    @foreach ($semainesFermeture as $semaine)
                        <li>{{ $semaine->debut_semaine }} à {{ $semaine->fin_semaine }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
