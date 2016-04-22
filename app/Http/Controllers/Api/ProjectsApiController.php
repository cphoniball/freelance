<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;
use App\Client;
use App\User;

class ProjectsApiController extends Controller
{

	/**
	 * Get projects
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function get(Request $request) {

	}

	/**
	 * Get a single project by ID
	 *
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function getById(Request $request, $id) {

	}

	/**
	 * Create a new project
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function create(Request $request) {

	}


}
