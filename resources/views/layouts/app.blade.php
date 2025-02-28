<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardins de Cocagne</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="imgs/logonav.png"/>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('tournees.index') }}">Tournées</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('point-depots.index') }}">Dépôts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('calendrier-livraisons.index') }}">Calendrier</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('commandes.create') }}">Commandes</a></li>
                </div>
            </div>
        </div>
    </nav>
</head>

<body>
    <!-- Contenu de la page -->
    @yield('content')

    <!-- Bootstrap JS et dépendances -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
