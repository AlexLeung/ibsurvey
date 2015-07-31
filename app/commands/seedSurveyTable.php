<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class seedSurveyTable extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'seed:survey';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Insert initia; survey to database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$survey = new Survey();
        $survey->name = 'ibSurvey';
        $survey->school_id = 1;
        $survey->save();
        
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
