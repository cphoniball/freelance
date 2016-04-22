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
     * Get the projects that belong to this user
     *
     * @return [type] [description]
     */
    public function projects() {
        return $this->hasMany('App\Project');
    }

}
