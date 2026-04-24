<?php

use App\Http\Controllers\web\CompetenceController;
use App\Http\Controllers\web\ConnexionController;
use App\Http\Controllers\web\InterventionController;
use App\Http\Controllers\web\UserCompetenceController;
use App\Http\Controllers\web\UtilisateurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//affichage de la liste des compétences
Route::get('/web/competences', [CompetenceController::class, 'index'])->name('web.competences.index');
Route::post('/web/competences', [CompetenceController::class, 'store'])->name('web.competences.store');
Route::get('/web/competences/create', [CompetenceController::class, 'create'])->name('web.competences.create');
Route::get('/web/competences/{code_comp}', [CompetenceController::class, 'show'])->name('web.competences.show');
Route::get('/web/competences/{code_comp}/edit', [CompetenceController::class, 'edit'])->name('web.competences.edit');
Route::put('/web/competences/{code_comp}', [CompetenceController::class, 'update'])->name('web.competences.update');
Route::delete('/web/competences/{code_comp}', [CompetenceController::class, 'destroy'])->name('web.competences.destroy');

//affichage de la liste des utilisateurs
Route::get('/web/utilisateurs', [UtilisateurController::class, 'index'])->name('web.utilisateurs.index');
Route::post('/web/utilisateurs', [UtilisateurController::class, 'store'])->name('web.utilisateurs.store');
Route::get('/web/utilisateurs/{id}', [UtilisateurController::class, 'show'])->name('web.utilisateurs.show');
Route::get('/web/utilisateurs/create', [UtilisateurController::class, 'create'])->name('web.utilisateurs.create');
Route::get('/web/utilisateurs/{id}/edit', [UtilisateurController::class, 'edit'])->name('web.utilisateurs.edit');
Route::put('/web/utilisateurs/{id}', [UtilisateurController::class, 'update'])->name('web.utilisateurs.update');
Route::delete('/web/utilisateurs/{id}', [UtilisateurController::class, 'destroy'])->name('web.utilisateurs.destroy');

//routes pour la connexion
Route::get('/web/connexion', [ConnexionController::class, 'index'])->name('web.connexion.index');
Route::post('/web/connexion', [ConnexionController::class, 'store'])->name('web.auth.login');
Route::post('/web/deconnexion', [ConnexionController::class, 'logout'])->name('web.auth.logout');

Route::get('/web/interventions', [InterventionController::class, 'index'])->name('web.interventions.index');
Route::get('/web/interventions/create', [InterventionController::class, 'create'])->name('web.interventions.create');
Route::post('/web/interventions', [InterventionController::class, 'store'])->name('web.interventions.store');
Route::get('/web/interventions/{id}', [InterventionController::class, 'show'])->name('web.interventions.show');
Route::get('/web/interventions/{id}/edit', [InterventionController::class, 'edit'])->name('web.interventions.edit');
Route::put('/web/interventions/{id}', [InterventionController::class, 'update'])->name('web.interventions.update');
Route::delete('/web/interventions/{id}', [InterventionController::class, 'destroy'])->name('web.interventions.destroy');


Route::get('/web/user-competence', [UserCompetenceController::class, 'index'])->name('web.user-competence.index');

