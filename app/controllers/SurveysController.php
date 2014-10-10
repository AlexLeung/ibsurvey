<?php

class SurveysController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($schoolName)
	{
		$school = School::where('name', '=', $schoolName)->first();
		if(!$school)
			return Redirect::to('/schools');
		foreach($school->surveys as $survey)
			$surveyNames[] = $survey->name;
		return View::make('surveyIndex')->with('school', $school)->with('surveyNames', $surveyNames);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Survey building form
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($schoolName, $surveyName)
	{
		$school = School::where('name', '=', $schoolName)->first();
		if(!$school)
			return Redirect::to('/schools/');
		$survey= Survey::where('name', '=', $surveyName)->first();
		if(!$survey)
			return Redirect::to("/schools/$schoolName");
		$groupStats = array();
		foreach (Group::all() as $group)
		{
			$possibleLink = $group->surveys()->where('survey_id', $survey->id)->first();
			$active = !is_null($possibleLink);
			$groupInfo = array('group' => $group, 'open_time' => 'no time set', 'close_time' => 'no time set');
			if($active)
			{
				$active = strtotime($possibleLink->pivot->open_time) < time() && strtotime($possibleLink->pivot->close_time) > time();
				if(strtotime($possibleLink->pivot->open_time))
					$groupInfo['open_time'] = $possibleLink->pivot->open_time;
				if(strtotime($possibleLink->pivot->close_time))
					$groupInfo['close_time'] = $possibleLink->pivot->close_time;
			}
			$groupInfo['active'] = $active;
			array_push($groupStats, $groupInfo);
		}
		return View::make('surveyShow')
			->with('school', $school)
			->with('survey', $survey)
			->with('groupStats', $groupStats);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Likely the same form for creating surveys
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($schoolName, $surveyName)
	{
		if(!Auth::check() || Auth::user()->group->name != "Admin")
			return Redirect::back();
		//We need to figure out what kind of post we are getting.
		$school = School::where('name', '=', $schoolName)->first();
		$survey = $school->surveys()->where('name', $surveyName)->first();
		$name = Input::get('name');
		$questions = Input::get('questions');
		$rules = array('name' => 'required|alpha_num');
		$fields['questions'] = NULL;
		$validator;
		if(Input::has('changeName'))
		{
			$fields['name'] = $name;
			$validator = Validator::make($fields, $rules);
			if(!$validator->fails())
			{
				if(is_null($school->surveys()->where('name', $fields['name'])->first()))
				{
					$survey->name = $fields['name'];
					$survey->save();
					return Redirect::to("/schools/$school->name/$survey->name")->withInput(array('questions' => $questions));
				}
				else
					$fields['name'] = "{$fields['name']} already exists under $school->name.";
			}	
		}
		else if(Input::has('changeQuestions'))
		{
			$fields['questions'] = Survey::parseQuestionStore($questions, $school->id);
			if($fields['questions'][0])
				File::put(app_path()."/questions/$survey->id.qs", $questions);
			$validator = Validator::make(array('name' => 'present'), $rules);
		}
		else//Some time change
		{
			$fields = array('time' => 'Default');
			$rules = array('time' => 'required');
			$submitName = '';
			$fieldName = '';
			$group = NULL;
			foreach($school->groups as $potentialGroup)
			{
				if(Input::has("{$potentialGroup->name}ChangeOpen"))
				{
					$submitName = 'ChangeOpen';
					$fieldName = 'openTime';
					$group = $potentialGroup;
					break;
				}
				else if(Input::has("{$potentialGroup->name}OpenNow"))
				{
					$submitName = 'OpenNow';
					$group = $potentialGroup;
					break;
				}
				else if(Input::has("{$potentialGroup->name}ChangeClose"))
				{
					$submitName = 'ChangeClose';
					$fieldName = 'closingTime';
					$group = $potentialGroup;
					break;
				}
				else if(Input::has("{$potentialGroup->name}CloseNow"))
				{
					$submitName = 'CloseNow';
					$group = $potentialGroup;
					break;
				}
			}
			if(strpos($submitName, 'Change') === 0)
			{
				$fields['time'] = Input::get("{$fieldName}{$group->name}");
				$rules['time'] = 'required|date_format:Y-m-d H:i:s';
			}
			else
			{
				$now = date("Y-m-d H:i:s");
				$later = date("Y-m-d H:i:s", time()+(365*24*60*60));
			}
			$validator = Validator::make($fields, $rules);
			if($validator->fails())
				$fields['time'] = "{$fieldName}{$group->name}";
			else
			{
				if(!$group->surveys->contains($survey->id))
					$group->surveys()->attach($survey->id);
				$group = $survey->groups()->where('group_id', $group->id)->first();
				switch ($submitName)
				{
					case 'ChangeOpen':
						$group->pivot->open_time = $fields['time'];
						break;
					case 'ChangeClose':
						$group->pivot->close_time = $fields['time'];
						break;
					case 'OpenNow':
						$group->pivot->open_time = $now;
						$group->pivot->close_time = $later;
						break;
					case 'CloseNow':
						$group->pivot->open_time = $later;
						$group->pivot->close_time = $now;
						break;
					default:
						throw new Exception('Error in submission, not a valid submit type.');
				}
				$group->pivot->save();
			}
		}
		return Redirect::back()->withInput(array('questions' => $questions, 'name' => $name))->withErrors($validator)->with('fields', $fields);
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
