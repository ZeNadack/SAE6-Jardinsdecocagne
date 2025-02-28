@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la tournée</h1>

    <form action="{{ route('tournees.update', $tournee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="identifiant">Identifiant</label>
            <input type="text" name="identifiant" id="identifiant" class="form-control" value="{{ old('identifiant', $tournee->identifiant) }}" required>
        </div>
        <div class="form-group">
            <label for="jour_preparation">Jour de préparation</label>
            <input type="date" name="jour_preparation" id="jour_preparation" class="form-control" value="{{ old('jour_preparation', $tournee->jour_preparation) }}" required>
        </div>
        <div class="form-group">
            <label for="jour_livraison">Jour de livraison</label>
            <input type="date" name="jour_livraison" id="jour_livraison" class="form-control" value="{{ old('jour_livraison', $tournee->jour_livraison) }}" required>
        </div>
        <div class="form-group">
            <label for="couleur">Couleur</label>
            <input type="color" name="couleur" id="couleur" class="form-control" value="{{ old('couleur', $tournee->couleur) }}" required>
        </div>

        <div class="form-group">
            <label for="point_depots">Points de dépôt</label>
            <select name="point_depots[]" id="point_depots" class="form-control" multiple required>
                @foreach ($pointDepots as $pointDepot)
                    <option value="{{ $pointDepot->id }}" data-latitude="{{ $pointDepot->latitude }}" data-longitude="{{ $pointDepot->longitude }}"
                        {{ in_array($pointDepot->id, $tournee->pointDepots->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $pointDepot->nom }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Maintenez la touche Ctrl (ou Cmd) pour sélectionner plusieurs points de dépôt.</small>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('tournees.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<div id="map" style="height: 400px; margin-top: 20px;"></div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([48.8566, 2.3522], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var points = [];
    var polyline = null;

    document.getElementById('point_depots').addEventListener('change', function() {
        points = [];
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                map.removeLayer(layer);
            }
        });

        Array.from(this.selectedOptions).forEach(function(option) {
            var pointDepotId = option.value;

            var latitude = option.getAttribute('data-latitude');
            var longitude = option.getAttribute('data-longitude');

            if (latitude && longitude) {
                var latlng = L.latLng(parseFloat(latitude), parseFloat(longitude));
                points.push(latlng);
                L.marker(latlng).addTo(map).bindPopup(option.text);
            }
        });

        if (points.length > 1) {
            var color = document.getElementById('couleur').value; // Récupère la couleur sélectionnée
            polyline = L.polyline(points, {color: color}).addTo(map);
        }
    });

    document.getElementById('couleur').addEventListener('change', function() {
        if (polyline) {
            var color = this.value;
            polyline.setStyle({color: color});
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('point_depots');
        Array.from(select.selectedOptions).forEach(function(option) {
            var latitude = option.getAttribute('data-latitude');
            var longitude = option.getAttribute('data-longitude');

            if (latitude && longitude) {
                var latlng = L.latLng(parseFloat(latitude), parseFloat(longitude));
                points.push(latlng);
                L.marker(latlng).addTo(map).bindPopup(option.text);
            }
        });

        if (points.length > 1) {
            var color = document.getElementById('couleur').value;
            polyline = L.polyline(points, {color: color}).addTo(map);
        }
    });
</script>
@endsection