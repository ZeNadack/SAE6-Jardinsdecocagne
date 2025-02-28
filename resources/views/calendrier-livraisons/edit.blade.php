@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le calendrier de livraison</h1>

    <form action="{{ route('calendrier-livraisons.update', $calendrierLivraison->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="tournee_id">Tournée</label>
            <select name="tournee_id" id="tournee_id" class="form-control" required>
                @foreach ($tournees as $tournee)
                    <option value="{{ $tournee->id }}" {{ $calendrierLivraison->tournee_id == $tournee->id ? 'selected' : '' }}>{{ $tournee->identifiant }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="frequence">Fréquence</label>
            <select name="frequence" id="frequence" class="form-control" required>
                <option value="hebdomadaire" {{ $calendrierLivraison->frequence == 'hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                <option value="bimensuel" {{ $calendrierLivraison->frequence == 'bimensuel' ? 'selected' : '' }}>Bimensuel</option>
                <option value="mensuel" {{ $calendrierLivraison->frequence == 'mensuel' ? 'selected' : '' }}>Mensuel</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ $calendrierLivraison->date_debut }}" required>
        </div>

        <div class="form-group">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ $calendrierLivraison->date_fin }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('calendrier-livraisons.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection