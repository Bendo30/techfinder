<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Techfinder</title>
    {{-- Charge Bootstrap via Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   <div class="container" align="center">
      <h3 class="mt-4">Bienvenue chez Techfinder</h3>
      <p class="mb-4">Veuillez vous connecter pour accéder à votre compte.</p>
      <form action="{{ route('web.auth.login') }}" method="POST">
         @csrf
         <div class="mb-3">
            <label for="login_user" class="form-label">Login</label>
            <input type="text" class="form-control" id="login_user" name="login_user" required>
         </div>
         <div class="mb-3">
            <label for="password_user" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password_user" name="password_user" required>
         </div>
         <button type="submit" class="btn btn-primary">Se connecter</button>
      </form>

   </div>

   <script src="/resources/js/all.js"></script>
</body>
</html>