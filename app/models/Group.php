<?php
class Group extends Eloquent
{
	/*Table Stats
	$table->increments('id');
	$table->string('name');
	$table->integer('school_id');
	$table->string('password');
	$table->timestamps();
	*/
	
	protected $guarded = array('id', 'password', 'created_at', 'updated_at');
	
	public $timestamps = true;
	
	public function surveys()
	{
		return $this->belongsToMany('Survey')->withPivot('open_time', 'close_time')->withTimestamps();
	}
	
	public function users()
	{
		return $this->hasMany('User');
	}
	
	public function school()
	{
		return $this->belongsTo('School');
	}
}