@extends('template')
@section('content')
<div class="container mt-5">
    <h1>Modifier l'Utilisateur</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('web.utilisateurs.update', $utilisateur->code_user) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nom_user" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom_user" name="nom_user" value="{{ $utilisateur->nom_user }}" required>
                </div>
                <div class="mb-3">
                    <label for="prenom_user" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom_user" name="prenom_user" value="{{ $utilisateur->prenom_user }}" required>
                </div>
                <div class="mb-3">
                    <label for="login_user" class="form-label">Login</label>
                    <input type="text" class="form-control" id="login_user" name="login_user" value="{{ $utilisateur->login_user }}" required>
                </div>
                <div class="mb-3">
                    <label for="tel_user" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" id="tel_user" name="tel_user" value="{{ $utilisateur->tel_user }}" required>
                </div>
                <div class="mb-3">
                    <label for="sexe_user" class="form-label">Sexe</label>
                    <select class="form-select" id="sexe_user" name="sexe_user" required>
                        <option value="">Sélectionnez le sexe</option>
                        <option value="Masculin" {{ $utilisateur->sexe_user == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                        <option value="Féminin" {{ $utilisateur->sexe_user == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                        <option value="Autre" {{ $utilisateur->sexe_user == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="role_user" class="form-label">Rôle</label>
                    <input type="text" class="form-control" id="role_user" name="role_user" value="{{ $utilisateur->role_user }}" required>
                </div>
                <div class="mb-3">
                    <label for="etat_user" class="form-label">État</label>
                    <select class="form-select" id="etat_user" name="etat_user" required>
                        <option value="">Sélectionnez l'état</option>
                        <option value="Actif" {{ $utilisateur->etat_user == 'Actif' ? 'selected' : '' }}>Actif</option>
                        <option value="Inactif" {{ $utilisateur->etat_user == 'Inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
                <a href="{{ route('web.utilisateurs.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
@endsection