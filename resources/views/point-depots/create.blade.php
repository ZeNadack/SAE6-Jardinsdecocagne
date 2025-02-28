@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un nouveau point de dépôt</h1>

    <form action="{{ route('point-depots.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" name="code_postal" id="code_postal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="commentaires">Commentaires</label>
            <textarea name="commentaires" id="commentaires" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" id="latitude" class="form-control" required>
        </div>
        <div class="form-group espace">
            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection