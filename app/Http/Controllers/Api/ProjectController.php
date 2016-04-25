<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectController extends CrudController
{

	/**
	 * The model that this controller is responsible for
	 *
	 * @var string
	 */
	protected $model = 'App\Project';

	/**
	 * Validation rules for creating and updating a project
	 *
	 * @var [type]
	 */
	protected $validationRules = [
		'name' => 'required|max:255',
		'user_id' => 'required|exists:users,id',
		'client_id' => 'required|exists:clients,id'
	];

}
