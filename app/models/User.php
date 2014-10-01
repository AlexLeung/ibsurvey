<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	/*Table Stats
	$table->increments('id');
	$table->string('name');
	$table->string('email')->unique();
	$table->integer('group_id');
	$table->string('password', 60);
	$table->rememberToken();
	$table->timestamps();
	*/
	
	protected $guarded = array('id', 'password', 'remember_token', 'created_at', 'updated_at');
	
	public $timestamps = true;
	
	public function answers()
	{
		return $this->hasMany('Answer');
	}
	
	public function group()
	{
		return $this->belongsTo('Group');
	}

}
