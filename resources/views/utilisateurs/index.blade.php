@extends('template')  <!-- Si vous utilisez un template de base -->

@section('content')

    <div class="container" align="center">
      <h1 align="center" class="mt-5 mb-5">Liste des Utilisateurs</h1>
      <!--bouton pour ouvrir le modal de la page create-->
      <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
         Ajouter un Utilisateur
      </button>
    <table class="table table-striped">
         <thead>
               <tr>
                  <th>Code</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Login</th>
                  <th>Téléphone</th>
                  <th>Sexe</th>
                  <th>Rôle</th>
                  <th>État</th>
                  <th>Actions</th>
               </tr>
         </thead>
         <tbody>
               @foreach($utilisateur_list as $utilisateur)
               <tr>
                  <td>{{ $utilisateur->code_user }}</td>
                  <td>{{ $utilisateur->nom_user }}</td>
                  <td>{{ $utilisateur->prenom_user }}</td>
                  <td>{{ $utilisateur->login_user }}</td>
                  <td>{{ $utilisateur->tel_user }}</td>
                  <td>{{ $utilisateur->sexe_user }}</td>
                  <td>{{ $utilisateur->role_user }}</td>
                  <td>{{ $utilisateur->etat_user }}</td>
                  <td>
                     <a href="{{ route('web.utilisateurs.show', $utilisateur->code_user) }}" class="btn btn-info btn-sm"><i class="fas fa-eye" style="color: rgb(59, 51, 95)"></i></a>
                     <a href="{{ route('web.utilisateurs.edit', $utilisateur->code_user) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                     <form action="{{ route('web.utilisateurs.destroy', $utilisateur->code_user) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')"><i class="fas fa-remove"></i></button>
                     </form>
                  </td>
               </tr>
               @endforeach
         </tbody>
    </table>
    </div>

<!-- Modal de création d'utilisateur -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Ajouter un nouvel utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" action="{{ route('web.utilisateurs.store') }}" method="POST">
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
                        <label for="password_user" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password_user" name="password_user" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_user_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_user_confirmation" name="password_user_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel_user" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="tel_user" name="tel_user" required>
                    </div>
                    <div class="mb-3">
                        <label for="sexe_user" class="form-label">Sexe</label>
                        <select class="form-select" id="sexe_user" name="sexe_user" required>
                            <option value="">Sélectionnez le sexe</option>
                            <option value="M">Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role_user" class="form-label">Rôle</label>
                        <select class="form-select" id="role_user" name="role_user" required>
                            <option value="">Sélectionnez un rôle</option>
                            <option value="admin">Admin</option>
                            <option value="technicien">Technicien</option>
                            <option value="client">Client</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="etat_user" class="form-label">État</label>
                        <select class="form-select" id="etat_user" name="etat_user" required>
                            <option value="">Sélectionnez un état</option>
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                            <option value="suspendu">Suspendu</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" form="createUserForm" class="btn btn-primary">Créer</button>
            </div>
        </div>
    </div>
</div>
@endsection