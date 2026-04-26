<?php

use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\UserCompetenceController;
use Illuminate\Support\Facades\Route;


Route::get('competences/search', [CompetenceController::class, 'search']);//va créer la route de recherche
Route::apiResource('competences', CompetenceController::class);//va créer les routes post, put, get, delete

Route::get('interventions/search', [InterventionController::class, 'search']);//va créer la route de recherche
Route::apiResource('interventions', InterventionController::class);

Route::get('utilisateurs/search', [UtilisateursController::class, 'search']);//va créer la route de recherche
Route::apiResource('utilisateurs', UtilisateursController::class);

// Routes personnalisées pour user-competence (clé composite)
Route::get('user-competence', [UserCompetenceController::class, 'index']);
Route::post('user-competence', [UserCompetenceController::class, 'store']);
Route::get('user-competence/{code_user}/{code_comp}', [UserCompetenceController::class, 'show']);
Route::put('user-competence/{code_user}/{code_comp}', [UserCompetenceController::class, 'update']);
Route::delete('user-competence/{code_user}/{code_comp}', [UserCompetenceController::class, 'destroy']);

// Routes pour l'authentification JWT
Route::prefix('jwt')->group(function () {
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'jwtRegister']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'jwtLogin']);
});

Route::middleware('auth:jwt')->group(function () {
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'jwtLogout']);
    Route::get('me', [App\Http\Controllers\Api\AuthController::class, 'jwtMe']);
});

// Routes pour l'authentification Sanctum
Route::prefix('sanctum')->group(function () {
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'sanctumRegister']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'sanctumLogin']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'sanctumLogout']);
    Route::get('me', [App\Http\Controllers\Api\AuthController::class, 'sanctumMe']);
});