<?php

class GroupsController extends \BaseController {

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($schoolName, $surveyName, $groupName)
	{
		if(Input::has('password'))
			return Redirect::to(Request::path())->with('password', Input::get('password'));
		else if(Input::has('passwordSubmit'))
			return Redirect::to(Request::path())->with('emptyError', 1);
		else if(Session::has('emptyError'))
			return View::make('surveyGroupShow')->with('error', 'You must enter a password.');
		//Loading all questions for a particular survey and group.
		$school = School::where('name', '=', $schoolName)->first();
		if(!$school)
			return Redirect::to('/schools');
		$survey = Survey::where('name', '=', $surveyName)->where('school_id', $school->id)->first();
		if(!$survey)
			return Redirect::to("/schools/$schoolName");
		$group = $survey->groups()->where('name', $groupName)->first();
		if(!$group || strtotime($group->pivot->open_time) > time() || strtotime($group->pivot->close_time) < time())
			return Redirect::to("schools/$schoolName/$surveyName");
		$loggedIn = Auth::check();
		if($loggedIn)
		{
			$authName = Auth::user()->group->name;
			if($authName != $groupName)
			{
				$firstAn = "a";
				$secondAn = "a";
				if(strstr("aeiou", strtolower($authName[0])))
					$firstAn = "an";
				if(strstr("aeiou", strtolower($groupName[0])))
					$secondAn = "an";
				return View::make('surveyGroupShow')->with('state', 'error')->with('error', "You are currently logged into $firstAn $authName account, and not $secondAn $groupName account.");
			}
			$questionStore = Survey::parseQuestionStore(file_get_contents(app_path()."/questions/$survey->id.qs"), $school->id, true);
			if(!$questionStore[0])
				throw new Exception("Problem getting question file parsed.");
			return View::make('surveyGroupShow')
				->with('state', 'survey')
				->with('message', "This is the $surveyName survey for all members of the $groupName group.")
				->with('questionStore', $questionStore[1])
				->with('groupName', $group->name);
		}
		else if($groupName == "Admin")
			return View::make('surveyGroupShow')->with('state', 'error')->with('error', 'You must be logged in as an Admin to take the Admin survey.');
		else if(Session::has('password'))
			if(Hash::check(Session::get('password'), $group->password))
				return View::make('surveyGroupShow')->with('state', 'options');
			else
				return View::make('surveyGroupShow')->with('error', 'You entered the wrong password. Try again.');
		else
			return View::make('surveyGroupShow');
	}
	
	
	public function selectOption($schoolName, $surveyName, $groupName)
	{
		if(Input::has('signIn'))
			return Redirect::to('/login?QS='.Request::path());
		for($email = 0; !is_null(User::where('email', '=', "$email")->first()); ++$email);
		$user = new User;
		$user->group_id = Group::where('name', '=', $groupName)->first()->id;
		$user->name = "Anonymous";
		$user->password = "none";
		$user->save();
		Auth::login($user);
		if(Input::has('createAccount'))
			return Redirect::to("/signup?intended=".Request::path());
		return Redirect::to(Request::path());
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Store a filled out survey. This is when the user clicks the submit button.
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
