<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Represents a freelancer's client
 */
class Client extends Model
{

	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $table = 'clients';

 /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'user_id', 'contact_name', 'description', 'address', 'phone', 'email'];

  /**
   * Get the user this client belongs to
   *
   * @return App\User
   */
  public function user() {
  	return $this->belongsTo('App\User');
  }

  /**
   * Get the projects that belong to this client
   *
   * @return [type] [description]
   */
  public function projects() {
      return $this->hasMany('App\Project');
  }

}