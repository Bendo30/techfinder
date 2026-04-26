<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Utilisateur extends Authenticatable implements JWTSubject
{
    use HasApiTokens, Notifiable, HasFactory;

    /**
     * Get the name of the unique identifier for the user.
     */
    public function username()
    {
        return 'login_user';
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->password_user;
    }

    /**
     * Get the column name for the "remember me" token.
     */
    public function getRememberTokenName()
    {
        return null; // or 'remember_token' if you have it
    }

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

     protected $hidden = [
        'password_user', 'remember_token',
    ];

    protected $table = 'utilisateurs';
    protected $primaryKey = 'code_user';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'code_user',
        'nom_user',
        'prenom_user',
        'login_user',
        'password_user',
        'tel_user',
        'sexe_user',
        'role_user',
        'etat_user',
    ];

    // Hasher le mot de passe avant d'enregistrer
    public function setPasswordUserAttribute($value)
    {
        $this->attributes['password_user'] = Hash::make($value);
    }
    function interventions()
    {
        return $this->hasMany(Intervention::class, 'code_user', 'code_user');
    }


    function competences()
    {

        return $this->belongsToMany(Competence::class, 'user_competence', 'code_user', 'code_comp');
    }

    public function userCompetences()
    {
        return $this->hasMany(UserCompetence::class, 'code_user', 'code_user');
    }
}
