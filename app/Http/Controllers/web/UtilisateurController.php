<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilisateur_list = Utilisateur::paginate(10); //récupère les enregistrements de la table utilisateurs par page de 10
        return view('utilisateurs.index', compact('utilisateur_list')); //transmet la liste paginée des utilisateurs à la vue 'utilisateurs' pour affichage
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('web.utilisateurs.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nom_user'=>'required|string|max:255',
        'prenom_user'=>'required|string|max:255',
        'login_user'=>'required|string|unique:utilisateurs,login_user',
        'password_user'=>'required|string|min:6|confirmed',
        'tel_user'=>'required|string|max:20',
        'sexe_user'=>'required|in:M,F',
        'role_user'=>'required|in:admin,technicien,client',
        'etat_user'=>'required|in:actif,inactif,suspendu'
        ]);

        Utilisateur::create($request->only(['nom_user', 'prenom_user', 'login_user', 'password_user', 'tel_user', 'sexe_user', 'role_user', 'etat_user']));

        flash()->addSuccess('Utilisateur ajouté avec succès !');

        return redirect()->route('web.utilisateurs.index')->with('success', 'utilisateur cree avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);
        return view('utilisateurs.show', compact('utilisateur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);
        return view('utilisateurs.edit', compact('utilisateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code_user)
    {
        $request->validate([
            'nom_user'=>'required|string|max:255',
            'prenom_user'=>'required|string|max:255',
            'login_user'=>'required|string|unique:utilisateurs,login_user,'.$code_user.',code_user',
            'password_user'=>'nullable|string|min:6|confirmed',
            'tel_user'=>'required|string|max:20',
            'sexe_user'=>'required|in:M,F',
            'role_user'=>'required|in:admin,technicien,client',
            'etat_user'=>'required|in:actif,inactif,suspendu'

        ]);

        $utilisateur = Utilisateur::findOrFail($code_user);
        $utilisateur->update($request->only(['nom_user', 'prenom_user', 'login_user', 'password_user', 'tel_user', 'sexe_user', 'role_user', 'etat_user']));

        flash()->addSuccess('Utilisateur mis à jour avec succès !');

        return redirect()->route('web.utilisateurs.index')->with('success', 'utilisateur mis à jour avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code_user)
    {
        $utilisateur = Utilisateur::findOrFail($code_user);
        $utilisateur->delete();

        flash()->addSuccess('Utilisateur supprimé avec succès !');

        return redirect()->route('web.utilisateurs.index')->with('success', 'utilisateur supprime avec succes');
    }
}
