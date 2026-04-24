<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('connexion');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'login_user' => 'required|string',
            'password_user' => 'required|string',
        ]);

        $user = \App\Models\Utilisateur::where('login_user', $request->login_user)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password_user, $user->password_user)) {
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->regenerate();
            flash()->addSuccess('Connexion réussie !');
            return redirect()->route('web.utilisateurs.index');
        }

        // Échec de l'authentification
        return back()->withErrors([
            'login_user' => 'Les identifiants sont incorrects.',
        ])->onlyInput('login_user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        flash()->addSuccess('Déconnexion réussie !');
        return redirect()->route('web.connexion.index');
    }
}

