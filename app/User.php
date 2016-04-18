<?php

namespace App;

use App\Freelance\JWT;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the clients that this user has
     *
     * @return [type] [description]
     */
    public function clients() {
        return $this->hasMany('App\Client');
    }

    /**
     * [setJWTSecret description]
     */
    public function setJWTSecret(JWT $jwt) {
        $this->jwt_sign = $jwt->generateSecret();
    }

    /**
     * Generate a new JWT for this user
     *
     * @return [type] [description]
     */
    public function createJWT(JWT $jwt) {
        // Create signing string if one does not exist
        if (!isset($this->jwt_sign)) {
            $this->setJWTSecret();
            $this->save();
        }

        return $jwt->setSecret($this->jwt_sign)->createToken();
    }

    /**
     * Verify a JWT for this user
     *
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function verifyJWT(JWT $jwt, string $tokenString) {
        return $jwt->setSecret($this->jwt_sign)->verifyToken($tokenString);
    }
}
