<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class AuthController extends ApiController
{

	/**
	 * Create a new session
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	function create(Request $request) {

	}

	/**
	 * Verify that this request is valid
	 *
	 * @return [type] [description]
	 */
	function verify() {

	}

	/**
	 * Destroy a session
	 *
	 * @return [type] [description]
	 */
	function destroy() {

	}

}
