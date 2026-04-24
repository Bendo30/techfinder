@extends('template')
@section('main')
<div class="container mt-5">
    <h1>forumulaire de création de l'Utilisateur</h1>
      <div class="card">
         <div class="card-body">
               <form action="{{ route('web.utilisateurs.store') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                     <label for="nom_user" class="form-label">Nom</label>
                     <input type="text" class="form-control" id="nom_user" name="nom_user" required>
                  </div>
                  <div class="mb-3">
                     <label for="prenom_user" class="form-label">Prénom</label>
                     <input type="text" class="form-control" id="prenom_user" name="prenom_user" required>
                  </div>
                  <div class="mb-3">
                     <label for="login_user" class="form-label">Login</label>
                     <input type="text" class="form-control" id="login_user" name="login_user" required>
                  </div>
                  <div class="mb-3">
                     <label for="tel_user" class="form-label">Téléphone</label>
                     <input type="text" class="form-control" id="tel_user" name="tel_user" required>
                  </div>
                  <div class="mb-3">
                     <label for="sexe_user" class="form-label">Sexe</label>
                     <select class="form-select" id="sexe_user" name="sexe_user" required>
                           <option value="">Sélectionnez le sexe</option>
                           <option value="Masculin">Masculin</option>
                           <option value="Féminin">Féminin</option>
                           <option value="Autre">Autre</option>
                     </select>
                  </div>
                  <div class="mb-3">
                     <label for="role_user" class="form-label">Rôle</label>
                     <input type="text" class="form-control" id="role_user" name="role_user" required>
                  </div>
                  <div class="mb-3">
                     <label for="etat_user" class="form-label">État</label>
                     <input type="text" class="form-control" id="etat_user" name="etat_user" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Créer</button>
               </form>
         </div>
      </div>
</div>