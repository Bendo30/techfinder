<?php

use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\InteventionController;
use App\Http\Controllers\UtilisateursController;
use App\Http\Controllers\UserCompetenceController;
use Illuminate\Support\Facades\Route;


Route::get('competences/search', [CompetenceController::class, 'search']);//va créer la route de recherche
Route::apiResource('competences', CompetenceController::class);//va créer les routes post, put, get, delete
Route::apiResource('interventions', InteventionController::class);
Route::apiResource('utilisateurs', UtilisateursController::class);
Route::apiResource('user-competence', UserCompetenceController::class);

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