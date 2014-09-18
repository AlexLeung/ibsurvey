<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('domain'=>'test.ibsurvey.com'), function(){
	Route::get('/', function()
	{
		echo 'testing the custom domain';
	});
});

Route::get('/', function()
{
	echo "Testing testing. 123456";
	return View::make('hello');
});

Route::get('/schools', function()
{
	$posts = DB::table('posts')->get();
	dd($posts);
});
Route::get('/dbAdd/{title?}', function($title = "")
{
	if(DB::insert('insert into posts (title, body) values(?, ?)', array("$title", "Yet another test post body.")))
	{
		echo 'the command has succeeded';
	}
	else 
	{
		echo 'the command has failed.';
	}
});