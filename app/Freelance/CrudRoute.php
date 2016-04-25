<?php

namespace App\Freelance;

class CrudRoute {

	/**
	 * Register routes for the base CrudController
	 *
	 * @param  string $controllerName [description]
	 * @return [type]                 [description]
	 */
	public static function register($path, $controller) {
		\Route::get($path, $controller . '@get');
		\Route::get($path . '/{id}', $controller . '@getById');
		\Route::post($path, $controller . '@create');
		\Route::patch($path . '/{id}', $controller . '@update');
		\Route::delete($path . '/{id}', $controller . '@delete');
	}

}