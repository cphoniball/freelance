<?php

namespace App\Freelance;

use Lcobucci\JWT\Builder;
use Lcobuccu\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Hmac\Sha256;

/**
 * Manages JWT creation and validation logic
 */
class JWT {

	/**
	 * Secret used to sign/verify JWTs
	 *
	 * @var [type]
	 */
	public $secret;

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

	public function __construct() {
		$this->builder = new Builder();
		$this->signer = new Sha256();
		$this->validator = new ValidationData();
		$this->parser = new Parser();

    $this->validator->setIssuer(url('/'));
    $this->validator->setAudience(url('/');

		$this->builder->setIssuer(url('/'))
    $this->builder->setAudience(url('/'))
	}

	/**
	 * Set secret string
	 *
	 * @param string $secret [description]
	 */
	public function setSecret(string $secret) {
		$this->secret = $secret;
		return $this;
	}

	/**
	 * Set secret string
	 *
	 * @param string $secret [description]
	 */
	public function getSecret() {
		if (!isset($this->secret)) {
			return false;
		}

		return $this->secret;
	}

	/**
	 * Generate a random string to sign a JWT with.
	 * This string should be stored somewhere, as it will be needed to verify the JWT that this string verifies.
	 *
	 * @return [type] [description]
	 */
	public function generateSecret()
	{
		$this->secret = str_random(64);
		return $this->secret;
	}

	/**
	 * Generate a new JWT
	 *
	 * @return [type] [description]
	 */
	public function createToken()
	{
		if (!isset($this->secret)) {
			throw new Exception('No JWT secret set to sign with.');
		}

		return $this->builder
                ->setIssuedAt(time())
                ->setExpiration(time() + 3600)
                ->sign($this->signer, $this->secret)
                ->getToken();
	}

	/**
	 * Verify a token is valid
	 *
	 * @param  string $tokenString [description]
	 * @return [type]              [description]
	 */
	public function verifyToken(string $tokenString)
	{
		if (!isset($this->secret)) {
			throw new Exception('No JWT secret set to validate with.');
		}

	  $token = $this->parser->parse((string) $tokenString);

    // Validate
    $token->validate($this->validator);

    // Verify
    $token->verify($this->signer, $this->secret);
	}

}