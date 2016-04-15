<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;

class ClientApiController extends ApiController {

	/**
	 * Get a listing of this resource
	 *
	 * @return [type] [description]
	 */
	public function get(Request $request)
	{
		$clients = Client::all();

		return $this->respondOk(['data' => $clients]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		//
	}

	/**
	 * Create a new client
	 *
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:255',
			'contact_name' => 'max:255',
			'email' => 'email'
		]);

		if ($validator->fails()) {
			return $this->respondValidationFailed($validator->getMessageBag()->toArray());
		}

		$client = new Client($request->all());
		$client->user_id = 1;
		$client->save();

		return $this->respondCreated([
			'created' => $client->toArray()
		]);
	}

	public function update()
	{

	}

	public function delete()
	{

	}



}
