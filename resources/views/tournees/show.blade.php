@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails de la tournée</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $tournee->identifiant }}</h5>
                <p class="card-text">
                    <strong>Jour de préparation :</strong> {{ $tournee->jour_preparation }}<br>
                    <strong>Jour de livraison :</strong> {{ $tournee->jour_livraison }}<br>
                    <strong>Couleur :</strong> <span style="color: {{ $tournee->couleur }};">{{ $tournee->couleur }}</span>
                </p>

                <h5>Points de dépôt</h5>
                <ul>
                    @foreach ($tournee->pointDepots as $pointDepot)
                        <li>{{ $pointDepot->nom }} ({{ $pointDepot->adresse }}, {{ $pointDepot->code_postal }}
                            {{ $pointDepot->ville }})</li>
                    @endforeach
                </ul>

                <a href="{{ route('tournees.edit', $tournee->id) }}" class="btn btn-warning">Modifier</a>
                <form action="{{ route('tournees.destroy', $tournee->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                <a href="{{ route('tournees.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </div>

        <div id="map" style="height: 400px; margin-top: 20px;"></div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([48.8566, 2.3522], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var points = [];

        @foreach ($tournee->pointDepots as $pointDepot)
            var latlng = L.latLng({{ $pointDepot->latitude }}, {{ $pointDepot->longitude }});
            points.push(latlng);
            L.marker(latlng).addTo(map).bindPopup("{{ $pointDepot->nom }}");
        @endforeach

        if (points.length > 1) {
            L.polyline(points, {
                color: '{{ $tournee->couleur }}'
            }).addTo(map);
        }
    </script>
@endsection
