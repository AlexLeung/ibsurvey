<?php
use Monolog\Handler\NullHandler;
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
date_default_timezone_set('America/Los_Angeles');

Route::get('/', 'HomeController@showWelcome');
Route::get('/schools', 'SchoolsController@index');
Route::get('/schools/{schoolName}', 'SurveysController@index');
Route::get('/schools/{schoolName}/{surveyName}', 'SurveysController@show');
Route::post('/schools/{schoolName}/{surveyName}', 'SurveysController@update');
Route::get('/schools/{schoolName}/{surveyName}/{groupName}', 'GroupsController@show');
Route::put('/schools/{schoolName}/{surveyName}/{groupName}', 'GroupsController@selectOption');
Route::post('/schools/{schoolName}/{surveyName}/{groupName}', 'GroupsController@store');
Route::get('signup', array('as' => 'signupGet', 'uses' => 'AccountsController@signupGet'));
Route::post('/signup', array('as' => 'signupPost', 'uses' => 'AccountsController@signupPost'));
Route::get('/login', array('as' => 'loginGet', 'uses' => 'AccountsController@loginGet'));
Route::post('/login', array('as' => 'loginPost', 'uses' => 'AccountsController@loginPost'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'AccountsController@logout'));
Route::get('/password', 'AccountsController@changePassword');

Route::get('/test', function()
{
	$group = Group::where('name', '=', 'Teacher')->first();
	$group->password = Hash::make('teacherPass');
	$group->save();
});

Route::get('/dev', function()
{
	return View::make('devform');
});
Route::post('/dev', 'DevTestController@devEdit');
Route::get('dev/fast', 'DevTestController@quickUser');