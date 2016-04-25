<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;

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

}