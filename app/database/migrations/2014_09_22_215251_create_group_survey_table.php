<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupSurveyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_survey', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id');
			$table->integer('survey_id');
			$table->timestamp('open_time');
			$table->timestamp('close_time');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_survey');
	}

}
