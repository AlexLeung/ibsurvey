<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		echo '<br><br><br><br><h1>Welcome to ibsurvey.com!</h1>';
		echo '<h5>Where ib schools can launch surveys at affordable prices.</h5>';
		echo "<br><br><a href=\"schools\">List of Schools</a>";
		return View::make('hello');
	}

}
