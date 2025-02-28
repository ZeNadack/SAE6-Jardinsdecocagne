@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le point de dépôt</h1>

        <form action="{{ route('point-depots.update', $pointDepot->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control"
                    value="{{ old('nom', $pointDepot->nom) }}" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control"
                    value="{{ old('adresse', $pointDepot->adresse) }}" required>
            </div>
            <div class="form-group">
                <label for="code_postal">Code Postal</label>
                <input type="text" name="code_postal" id="code_postal" class="form-control"
                    value="{{ old('code_postal', $pointDepot->code_postal) }}" required>
            </div>
            <div class="form-group">
                <label for="ville">Ville</label>
                <input type="text" name="ville" id="ville" class="form-control"
                    value="{{ old('ville', $pointDepot->ville) }}" required>
            </div>
            <div class="form-group">
                <label for="commentaires">Commentaires</label>
                <textarea name="commentaires" id="commentaires" class="form-control">{{ old('commentaires', $pointDepot->commentaires) }}</textarea>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude', $pointDepot->latitude) }}" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude', $pointDepot->longitude) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('point-depots.index') }}" class="btn btn-secondary">Annuler</a>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
@endsection
