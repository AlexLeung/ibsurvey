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
Route::get('/reset', function() {
	$alex = User::where('email', '=', 'alex.l.leung@gmail.com')->first();
	$alex->password = Hash::make('yolo');
	$alex->failedAttempts = 0;
	$alex->save();
});

date_default_timezone_set('America/Los_Angeles');

Route::get('/', 'HomeController@showWelcome');
Route::get('/schools', ['as' => 'schoolIndex', 'uses' => 'SchoolsController@index']);
Route::get('/schools/{schoolName}', 'SurveysController@index');
Route::get('/schools/{schoolName}/{surveyName}', 'SurveysController@show');
Route::post('/schools/{schoolName}/{surveyName}', 'SurveysController@update');
Route::get('/schools/{schoolName}/{surveyName}/{groupName}', 'GroupsController@show');
Route::put('/schools/{schoolName}/{surveyName}/{groupName}', 'GroupsController@selectOption');
Route::post('/schools/{schoolName}/{surveyName}/{groupName}', 'GroupsController@store');

Route::get('/register', ['as' => 'register', 'uses' => function() {
	echo 'comming soon!';
	echo "<br><a href='/'>&lt;&lt; back</a>";
}]);

//Account Routes.
Route::get('account', array('as' => 'accountGet', 'uses' => 'AccountsController@accountGet'));
Route::post('account', array('as' => 'accountPost', 'uses' => 'AccountsController@accountPost'));
Route::get('account/delete', array('as' => 'deleteGet', 'uses' => 'AccountsController@deleteGet'));
Route::post('account/delete', array('as' => 'deletePost', 'uses' => 'AccountsController@deletePost'));
Route::get('account/login', array('as' => 'loginGet', 'uses' => 'AccountsController@loginGet'));
Route::post('account/login', array('as' => 'loginPost', 'uses' => 'AccountsController@loginPost'));
Route::get('account/unlock', array('as' => 'unlock', 'uses' => 'AccountsController@unlock'));
Route::get('account/logout', array('as' => 'logout', 'uses' => 'AccountsController@logout'));
Route::get('account/password', array('as' => 'passwordGet', 'uses' => 'AccountsController@changePasswordGet'));
Route::post('account/password', array('as' => 'passwordPost', 'uses' => 'AccountsController@changePasswordPost'));