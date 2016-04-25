<?php

namespace App\Http\Controllers\Api;

use Hash;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;

use App\Freelance\JWT;

class AuthController extends ApiController
{

	/**
	 * Create a new session
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	function create(Request $request, JWT $jwt)
	{
		$email = $request->input('email');
		$password = $request->input('password');

		$user = User::where('email', $email)->first();

		// Verify user exists
		if (!$user) {
			return $this->respondNotAuthorized([
				'failed' => 'email'
			]);
		}

		// Verify password
		if (!Hash::check($password, $user->password)) {
			return $this->respondNotAuthorized([
				'failed' => 'password'
			]);
		}

		// Create and return a JWT token to the requester
		return $this->respondAuthorized([
			'token' => (string) $jwt->setUser($user)->createToken()
		]);
	}

	/**
	 * Endpoint for external APIs to ensure the validity of their token
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	function verify(Request $request, JWT $jwt) {
		$token = $request->bearerToken();

	  if (!$token || !$jwt->verifyToken($token)) {
	      return $this->respondNotAuthorized();
	  }

	  return $this->respondAuthorized();
	}

	/**
	 * Destroy a session.
	 * Note that this uses JWT authentication, so you can't 'destroy' a session
	 * We accomplish this by updating the signing secret for the given user, so that
	 * previously issued tokens are no longer valid.
	 *
	 * @return [type] [description]
	 */
	function destroy(Request $request)
	{
		$userId = $request->input('user_id');

		// TODO: Finish this method out

	}

}
