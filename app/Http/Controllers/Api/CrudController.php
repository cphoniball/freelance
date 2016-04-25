<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use Validator;

use App\Http\Requests;

/**
 * Base class for forming basic CRUD Api controllers
 *
 *
 */
class CrudController extends ApiController
{

	/**
	 * The model that this CRUD controller is responsible for.
	 * Should be set by sub classes
	 *
	 * @var [type]
	 */
	protected $model;

	/**
	 * Rules to validate when creating a resource
   * 'required' rules will be removed when a resource is being updated
   *
	 * @var array
	 */
	protected $validationRules = [];

	/**
	 * Array of methods that should not be assigned for this controller
   *
	 * @var array
	*/
	protected $notAllowed = [];

	/**
	 * Used to call a static method on this controller's model, because for some reason
	 * you cannot do $this->model::methodName();
	 *
	 * @return [type] [description]
	 */
	protected function callModelMethod($method) {
		$args = func_get_args();

		// Remove method name from args
		array_shift($args);

		return call_user_func_array($this->model . '::' . $method, $args);
	}

	/**
	* Get a listing of this resource
	* Should allow querying based on $this->queryKeys
	*
	* @param  Request $request [description]
	* @return [type]           [description]
	*/
	public function get(Request $request)
	{
		$results = $this->callModelMethod('all');

		return $this->respondOk(['data' => $results]);
	}

	/**
	* Get the resource with the given ID
	*
	* @param  Request $request [description]
	* @param  [type]  $id      [description]
	* @return [type]           [description]
	*/
	public function getById(Request $request, $id)
	{
		$result = $this->callModelMethod('find', $id);

		if (!$result) {
			return $this->respondNotFound();
		}

		return $this->respondOk(['data' => $result]);
	}

	/**
	* Create a new instance of this resource
	*
	* @param  Request $request [description]
	* @return [type]           [description]
	*/
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), $this->validationRules);

		if ($validator->fails()) {
			return $this->respondValidationFailed($validator->getMessageBag()->toArray());
		}

		$instance = new $this->model($request->all());
		$instance->save();

		return $this->respondCreated([
			'created' => $instance->toArray()
		]);
	}

	/**
	* Update the given resource
	*
	* @param  Request $request [description]
	* @param  [type]  $id      [description]
	* @return [type]           [description]
	*/
	public function update(Request $request, $id)
	{
		// Remove required rules from validation rules
		$updateRules = array_map(function($rules) {
			$rulesArray = explode('|', $rules);
			$rulesArray = array_filter($rulesArray, function($rule) { return $rule !== 'required'; });
			return implode('|', $rulesArray);
		}, $this->validationRules);

		$validator = Validator::make($request->all(), $updateRules);

		if ($validator->fails()) {
			return $this->respondValidationFailed($validator->getMessageBag()->toArray());
		}

		$instance = $this->callModelMethod('find', $id);

		$instance->update($request->all());

		return $this->respondUpdated();
	}

	/**
	* Delete the given resource
	*
	* @param  Request $request [description]
	* @return [type]           [description]
	*/
	public function delete(Request $request, $id)
	{
		$instance = $this->callModelMethod('find', $id);

		if (!$instance) {
			return $this->respondNotFound($this->model . ' not found.');
		}

		$instance->delete();

		return $this->respondDeleted(['deleted' => $instance->toArray()]);
	}

}
