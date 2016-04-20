<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use App\Freelance\JWT;

class JWTAuthenticate
{

    /**
     * Inject JWT
     *
     * @param JWT $jwt [description]
     */
    public function __construct(JWT $jwt) {
        $this->jwt = $jwt;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !$this->jwt->verifyToken($token)) {
            return response('Invalid or missing JWT.', 401);
        }

        return $next($request);
    }
}
