<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class seedUsersInitial extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'seed:initial_users';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creates base users in database';

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
		$school = new School();
		$school->name = 'cool school';
		$school->save();

		$group = new Group();
		$group->name = 'Admin';
		$group->school_id = $school->id;
		$group->password = "pass";
		$group->save();

		$user = new User();
		$user->name = 'Alex Leung';
		$user->email = 'alex.l.leung@gmail.com';
		$user->group_id = $group->id;
		$user->password = Hash::make("alexpass");
		$user->save();

		$user = new User();
		$user->name = 'Krishang Swami';
		$user->email = '12butts@gmail.com';
		$user->group_id = $group->id;
		$user->password = Hash::make("krishpass");
		$user->save();
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
