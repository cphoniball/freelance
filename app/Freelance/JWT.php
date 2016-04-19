<?php

namespace App\Freelance;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
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
	 * Set secret string
	 *
	 * @param string $secret [description]
	 */
	public function setSecret($secret)
	{
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
		return $this;
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
	public function verifyToken($tokenString)
	{
		if (!isset($this->secret)) {
			throw new Exception('No JWT secret set to validate with.');
		}

	  $token = $this->parser->parse((string) $tokenString);

    // Validate
    $valid = $token->validate($this->validator);

    // Verify
    $verified = $token->verify($this->signer, $this->secret);

    return $valid && $verified;
	}

}