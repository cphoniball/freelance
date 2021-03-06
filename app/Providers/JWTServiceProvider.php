<?php

namespace App\Providers;

use App\User;
use App\Freelance\JWT;

use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Ensure a JWT signing string is set on user creation
        User::creating(function($user) {
            if (isset($user->secret)) {
                return;
            }

            $user->secret = str_random(64);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Freelance\JWT', function($app) {
            return new JWT(url('/'));
        });
    }
}
