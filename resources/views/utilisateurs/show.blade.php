@extends('template')
@section('content')
<div class="container mt-5">
    <h1>Détails de l'Utilisateur</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $utilisateur->nom_user }} {{ $utilisateur->prenom_user }}</h5>
            <p class="card-text"><strong>Login:</strong> {{ $utilisateur->login_user }}</p>
            <p class="card-text"><strong>Téléphone:</strong> {{ $utilisateur->tel_user }}</p>
            <p class="card-text"><strong>Sexe:</strong> {{ $utilisateur->sexe_user }}</p>
            <p class="card-text"><strong>Rôle:</strong> {{ $utilisateur->role_user }}</p>
            <p class="card-text"><strong>État:</strong> {{ $utilisateur->etat_user }}</p>
            <a href="{{ route('web.utilisateurs.edit', $utilisateur->code_user) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('web.utilisateurs.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>  
    </div>
</div>
@endsection