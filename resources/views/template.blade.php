

<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Techfinder</title>
        {{-- Charge Bootstrap via Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <div class="container text-center mt-5" align="center">
            <nav class="nav nav-pills nav-justified">
                <a class="nav-link" aria-current="page" href="/web/competences">
                    <i class="fas fa-briefcase"></i> &nbsp; Competences</a>

                <a class="nav-link" href="/web/utilisateurs">
                    <i class="fas fa-users"></i> &nbsp; Utilisateurs</a>

                <a class="nav-link" href="/web/interventions">
                    <i class="fas fa-wrench"></i> &nbsp; Interventions</a>

                <a class="nav-link" href="/web/user-competence">
                    <i class="fas fa-user-check"></i> &nbsp; User-Competence</a>
                <a class="btn btn-primary" href="/web/connexion">
                    <i class="fas fa-sign-in"></i> &nbsp; Connexion</a>
            </nav>
        </div>
        @yield('content')


        <footer>
                <div class="text-center mt-5">
                    <p>&copy; 2026 Techfinder. Tous droits réservés.</p>
                </div>
        </footer>
        @flasher_render

        <script src="/resources/js/all.js"></script>
    </body>
</html>
