<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // ──────────────────────────────────────────
    //  JWT Auth
    // ──────────────────────────────────────────

    public function jwtRegister(Request $request)
    {
        $request->validate([
            'nom_user'     => 'required|string|max:255',
            'prenom_user'    => 'required|string|max:255',
            'login_user' => 'required|string|max:255|unique:users',
            'password_user' => 'required|string|min:8|confirmed',
            'tel_user' => 'required|string|max:20',
            'sexe_user' => 'required|in:M,F',
            'role_user' => 'required|in:admin,technicien,client',
            'etat_user' => 'required|in:actif,inactif,suspendu',
        ]);

        $user = User::create([
            'nom_user'     => $request->nom_user,
            'prenom_user'    => $request->prenom_user,
            'login_user' => $request->login_user,
            'password_user' => Hash::make($request->password_user),
            'tel_user' => $request->tel_user,
            'sexe_user' => $request->sexe_user,
            'role_user' => $request->role_user,
            'etat_user' => $request->etat_user,
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token, $user);
    }

    public function jwtLogin(Request $request)
    {
        $credentials = $request->validate([
            'login_user'    => 'required|string',
            'password_user' => 'required|string',
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        return $this->respondWithToken($token, JWTAuth::user());
    }

    public function jwtLogout()
    {
        JWTAuth::logout();
        return response()->json(['message' => 'Déconnecté avec succès']);
    }

    public function jwtRefresh()
    {
        return $this->respondWithToken(JWTAuth::refresh());
    }

    public function jwtMe()
    {
        return response()->json(JWTAuth::user());
    }

    private function respondWithToken($token, $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => JWTAuth::factory()->getTTL() * 60,
            'user'         => $user,
        ]);
    }

    // ──────────────────────────────────────────
    //  Sanctum Auth
    // ──────────────────────────────────────────

    public function sanctumRegister(Request $request)
    {
        $request->validate([
            'nom_user'     => 'required|string|max:255',
            'prenom_user'    => 'required|string|max:255',
            'login_user' => 'required|string|max:255|unique:users',
            'password_user' => 'required|string|min:8|confirmed',
            'tel_user' => 'required|string|max:20',
            'sexe_user' => 'required|in:M,F',
            'role_user' => 'required|in:admin,technicien,client',
            'etat_user' => 'required|in:actif,inactif,suspendu',
        ]);

        $user  = User::create([
            'nom_user'     => $request->nom_user,
            'prenom_user'    => $request->prenom_user,
            'login_user' => $request->login_user,
            'password_user' => Hash::make($request->password_user),
            'tel_user' => $request->tel_user,
            'sexe_user' => $request->sexe_user,
            'role_user' => $request->role_user,
            'etat_user' => $request->etat_user,
        ]);

        $token = $user->createToken('techfinder-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ], 201);
    }

    public function sanctumLogin(Request $request)
    {
        $request->validate([
            'login_user'    => 'required|string',
            'password_user' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('login_user', 'password_user'))) {
            throw ValidationException::withMessages([
                'login_user' => ['Identifiants invalides.'],
            ]);
        }

        $user  = Auth::user();
        $token = $user->createToken('techfinder-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
        ]);
    }

    public function sanctumLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete;
        return response()->json(['message' => 'Déconnecté avec succès']);
    }

    public function sanctumMe(Request $request)
    {
        return response()->json($request->user());
    }
}