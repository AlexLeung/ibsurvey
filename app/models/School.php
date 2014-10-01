<?php
class School extends Eloquent
{
	
	/* Table Stats
	$table->increments('id');
	$table->string('name')->unique();
	$table->timestamps();
	*/
	
	protected $guarded = array('id', 'created_at', 'updated_at');
	
	public $timestamps = true;
	
	public function surveys()
	{
		return $this->hasMany('Survey');
	}
	
	public function groups()
	{
		return $this->hasMany('Group');
	}
}