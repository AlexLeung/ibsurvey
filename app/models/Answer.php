<?php
class Answer extends Eloquent
{
	
	/*Table Stats
	$table->increments('id');
	$table->integer('user_id');
	$table->integer('survey_id');
	$table->longText('answer_store');
	$table->timestamps();
	*/
	
	protected $guarded = array('id', 'created_at', 'updated_at');
	
	public $timestamps = true;
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function survey()
	{
		return $this->belongsTo('Survey');
	}
}