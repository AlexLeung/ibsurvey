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
			return View::make('content.surveyGroupShow')->with('error', 'You must enter a password.');
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
			$user = Auth::user();
			$authName = $user->group->name;
			if($authName != $groupName)
			{
				$firstAn = "a";
				$secondAn = "a";
				if(strstr("aeiou", strtolower($authName[0])))
					$firstAn = "an";
				if(strstr("aeiou", strtolower($groupName[0])))
					$secondAn = "an";
				return View::make('content.surveyGroupShow')->with('state', 'error')->with('error', "You are currently logged into $firstAn $authName account, and not $secondAn $groupName account.");
			}
			if($user->name == "Anonymous" && !Session::has('remainAnon'))
				return View::make('content.surveyGroupShow')->with('state', 'options');
			$questionStore = Survey::parseQuestionStore(File::get(app_path()."/questions/$survey->id.qs"), $school->id, true);
			if(!$questionStore[0])
				throw new Exception("Problem getting question file parsed.");
			$path = app_path()."/answers/$user->id.ans";
			$answers = array();
			if(File::exists($path))
				$answers = json_decode(File::get($path), true)[$user->id];
			//dd($answers);
			return View::make('content.surveyGroupShow')
				->with('answers', $answers)
				->with('state', 'survey')
				->with('message', "This is the $surveyName survey for all members of the $groupName group.")
				->with('questionStore', $questionStore[1])
				->with('groupName', $group->name)
				->with('closeTime', $group->pivot->close_time);
		}
		else if($groupName == "Admin")
			return View::make('content.surveyGroupShow')->with('state', 'error')->with('error', "You must be logged in as an Admin to take the Admin survey.");
		else if(Session::has('password'))
			if(Hash::check(Session::get('password'), $group->password))
				return View::make('content.surveyGroupShow')->with('state', 'options');
			else
				return View::make('content.surveyGroupShow')->with('error', 'You entered the wrong password. Try again.');
		else
			return View::make('content.surveyGroupShow');
	}
	
	
	public function selectOption($schoolName, $surveyName, $groupName)
	{
		if(!Auth::check())
		{
			$user = new User;
			$user->group_id = Group::where('name', '=', $groupName)->first()->id;
			$user->name = "Anonymous";
			$user->password = "none";
			$user->save();
			Auth::login($user);
		}
		if(Input::has('anonymous'))
			return Redirect::to(Request::path())->with('remainAnon', true);
		return Redirect::to("account?intended=".Request::path()); // By this point the submission must have been to create a new account.
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
	public function store($schoolName, $surveyName, $groupName)
	{
		if(Auth::check())
			$user = Auth::user();
		else
			return Redirect::back();
		if($user->group->name != $groupName)
			return Redirect::back();
		$school = School::where('name', '=', $schoolName)->first();
		$survey = $school->surveys()->where('name', $surveyName)->first();
		$group = $survey->groups()->where('name', $groupName)->first();
		if(strtotime($group->pivot->close_time) < time())
			return Redirect::back()->with('state', 'error')->with('error', 'You can no longer edit and save your answers. The survey has closed and your edits have been discarded.');
		//Store a filled out survey. This is when the user clicks the submit button.
		foreach(Input::all() as $origMark => $answer)
			$answers[$origMark] = $answer;
		unset($answers['_token']);
		$path = app_path()."/answers/$user->id.ans";
		if(File::exists($path))
			$answerStore = json_decode(File::get($path), true);	
		$answerStore[$user->id] = $answers;
		File::put($path, json_encode($answerStore));
		return Redirect::back();
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