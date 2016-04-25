<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends CrudController
{

	/**
	 * The model that this controller is responsible for
	 *
	 * @var string
	 */
	protected $model = 'App\User';

	/**
	 * Validation rules for creating and updating a project
	 *
	 * @var [type]
	 */
	protected $validationRules = [
		'name' => 'required|max:255',
		'password' => 'required|max:255',
		'client_id' => 'required|exists:clients,id'
	];

}
