<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a project, which belongs to both a user and a client
 */
class Project extends Model
{

	/**
	 * Table this model references
	 *
	 * @var string
	 */
	protected $table = 'projects';

 	/**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'user_id', 'client_id', 'name', 'notes'];

  /**
   * Get the user that this project belongs to
   *
   * @return [type] [description]
   */
  public function user() {
  	return $this->belongsTo('App\User');
  }

  /**
   * Get the client this project belongs to
   *
   * @return [type] [description]
   */
  public function client() {
  	return $this->belongsTo('App\Client');
  }

}
