<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
   * Don't use timestamps for this model
   *
   * @var boolean
   */
  public $timestamps = false;

  /**
   * Get the user this client belongs to
   *
   * @return App\User
   */
  public function user() {
  	return $this->belongsTo('App\User');
  }

}