<?php

namespace App\Freelance;

use App;

use App\User;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * Manages JWT creation and validation logic
 */
class JWT {

	/**
	 * Signer instance
	 *
	 * @var [type]
	 */
	public $signer;

	/**
	 * Builder instance
	 *
	 * @var [type]
	 */
	public $builder;

	/**
	 * Validation data instance
	 *
	 * @var [type]
	 */
	public $validator;

	/**
	 * User that this JWT is being generated/verified for
	 *
	 * @var [type]
	 */
	public $user;

	public function __construct($base_url)
	{
		$this->builder = new Builder();
		$this->signer = new Sha256();
		$this->validator = new ValidationData();
		$this->parser = new Parser();

    $this->validator->setIssuer($base_url);
    $this->validator->setAudience($base_url);

		$this->builder->setIssuer($base_url);
    $this->builder->setAudience($base_url);
	}

	/**
	 * Get the user for this JWT token
	 *
	 * @return [type] [description]
	 */
	public function getUser()
	{
		if (!$this->user || !isset($this->user)) {
			return false;
		}

		return $this->user;
	}

	/**
	 * Set this JWT user
	 *
	 * @param User $user [description]
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
		return $this;
	}

	/**
	 * Get user secret, or static secret if this is a testing environment
	 *
	 * @return [type] [description]
	 */
	public function getSecret() {
    // Use static secret if we are testing
    if (App::environment('local', 'testing', 'development')) {
    	return env('JWT_TEST_SECRET');
    }

    if (!$this->user) {
    	throw new Exception('No user set for JWT authentication.');
    }

    if (!isset($this->user->secret)) {
    	$this->setUserSecret();
    }

		return $this->user->secret;
	}

	/**
	 * Generate a random string to sign a JWT with.
	 * This string should be stored somewhere, as it will be needed to verify the JWT that this string verifies.
	 *
	 * @return [type] [description]
	 */
	public function generateSecret()
	{
		return str_random(64);
	}

	/**
	 * Set user JWT secret, and save to database
	 *
	 * @return  $this
	 */
	public function setUserSecret() {
		if (!isset($this->user)) { return $this; }

		$this->user->secret = $this->generateSecret();
		$this->user->save();

		return $this;
	}

	/**
	 * Generate a new JWT
	 *
	 * @return [type] [description]
	 */
	public function createToken()
	{
		if (!isset($this->user->secret)) {
			$this->setUserSecret();
		}

		$token = $this->builder
	                ->setIssuedAt(time())
	                ->set('user', $this->user->id);

	  // Set expiration if this is not a test environment
		if (!App::environment('local', 'testing', 'development')) {
			$token->setExpiration(time() + 3600);
		}

		return $token->sign($this->signer, $this->getSecret())->getToken();
	}

	/**
	 * Verify a token is valid
	 *
	 * @param  string $tokenString [description]
	 * @return [type]              [description]
	 */
	public function verifyToken($tokenString)
	{
		$token = $this->parser->parse((string) $tokenString);

		$user_id = $token->getClaim('user');
		$user = User::find($user_id);

		// No valid user
		if (!$user || !isset($user->secret)) { return false; }

		$this->user = $user;

    // Validate and verify
    $valid = $token->validate($this->validator);
    $verified = $token->verify($this->signer, $this->getSecret());

    return $valid && $verified;
	}

}