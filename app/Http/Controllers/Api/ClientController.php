<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;

use App\Freelance\JWT;

class ClientController extends CrudController {

	/**
	 * Model that this controller is responsible for
	 *
	 * @var string
	 */
	protected $model = 'App\Client';

	/**
	 * Validation rules to use when creating or updating a client
	 *
	 * @var [type]
	 */
	protected $validationRules = [
		'name' => 'required|max:255',
		'contact_name' => 'max:255',
		'email' => 'email',
		'user_id' => 'exists:users,id'
	];

	/**
	 * JWT instance for this controller
	 *
	 * @var [type]
	 */
	protected $jwt;

	public function __construct(JWT $jwt) {
		$this->jwt = $jwt;
		$this->callbacks['beforeCreate'][] = [$this, 'setUserIdBeforeCreate'];
	}

	/**
	 * Set the user ID on the client based on current auth
	 *
	 * @param [type] $instance [description]
	 */
	public function setUserIdBeforeCreate($client) {
		$user = $this->jwt->getUser();

		if (!$user) {
			return $client;
		}

		$client->user_id = $user->id;

		return $client;
	}

}