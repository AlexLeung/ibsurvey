<?php
class DevTestController extends \BaseController {
	
	public function quickUser()
	{
		$school = School::firstOrCreate(['name' => 'TestSchool']);
		$group = Group::firstOrCreate(array('name' => 'Admin', 'school_id' => $school->id));
		$user = User::firstOrCreate(array('name' => 'Alex', 'email' => 'alex.l.leung@gmail.com', 'group_id' => $group->id));
		if(!Hash::check('Hello', $user->password))
		{
			$user->password = Hash::make('Hello');
			$user->save();
		}
		$survey = Survey::firstOrCreate(array('name' => 'MainSurvey', 'school_id' => $school->id));
		$group->surveys()->attach($survey->id, array('open_time' => date("Y-m-d H:i:s"), 'close_time' => date("Y-m-d H:i:s")));
		return Redirect::to('/');
	}
	
	public function devEdit()
	{
		$input = Input::all();
		if(!$input['school'])
		{
			echo 'You must input a school.';
			return;	
		}
		if(isset($input['btn_delete']))
		{
			DevTestController::devDelete($input);
			return;
		}
		$school = School::firstOrCreate(array('name' => $input['school']));
		if($input['survey'])
			$survey = Survey::firstOrCreate(array('name' => $input['survey'], 'school_id' => $school->id));
		if($input['group'])
		{
			$group = Group::firstOrCreate(array('name' => $input['group'], 'school_id' => $school->id));
			if($input['group'] != "Admin")
				Group::firstOrCreate(array('name' => 'Admin', 'school_id' => $school->id));
		}
		if($input['group'] && $input['survey'])
		{
			$relationshipExists = true;
			try
			{
				$group->surveys()->where('survey_id', '=', $survey->id)->firstorfail();
			}
			catch(Exception $e)
			{
				$relationshipExists = false;
			}
			if(!$relationshipExists)
				$group->surveys()->attach($survey->id, array('open_time' => time(), 'close_time' => time()));
		}
		echo 'successfull insertion submission';
	}
	
	private static function devDelete($input)
	{
		$school = School::where('name', '=', $input['school'])->first();
		if(!$school)
		{
			echo 'invalid school';
			return;
		}
		$survey;
		if($input['survey'])
		{
			$survey = Survey::where('name', '=', $input['survey'])->where('school_id', '=', $school->id)->first();
			if(!$survey)
			{
				echo 'invalid survey';
				return;
			}
		}
		$group;
		if($input['group'])
		{
			$group = Group::where('name', '=', $input['group'])->where('school_id', '=', $school->id)->first();
			if(!$group)
			{
				echo 'invalid group';
				return;
			}
		}
		//Logic of Deleting.
		if(!$input['survey'] && !$input['group'])//Both empty
		{
			//Delete entire school.
			foreach ($school->surveys as $survey)
			{
				foreach ($survey->answers as $answer)
					$answer->delete();
				foreach ($survey->groups as $group)
				{
					foreach ($group->users as $user)
						$user->delete();
					$survey->groups()->detatch($group->id);
					$group->delete();
				}
				$survey->delete();
			}
			$school->delete();
		}
		else if($input['group'])//Group present
		{
			if($input['survey'])//Survey Also present
			{
				//Just delete the questions and answers for the group/survey combination.
				
				//Go into question and answer stores.
			}
			else
			{
				if($group->name == "Admin")
					throw new Exception("You are not allowed to delete the Admin group from your school");
				foreach($group->surveys as $survey)
					$group->surveys()->detach($survey);
				foreach($school->surveys as $survey)
				{
					if(File::exists(app_path()."/questions/$survey->id.qs"))
					{
						$questionReturn = Survey::parseQuestionStore(File::get(app_path()."/questions/$survey->id.qs"), $school->id, true);
						if($questionReturn[0])
							$questionStore = $questionReturn[1];
						else
							throw new Exception($questionReturn[1]);
						$questions = count($questionStore);
						for ($questionI = 0; $questionI < $questions; ++$questionI)
						{
							if(count($questions[$questionI][1]) == 1 && $questions[$questionI][1][0] == $group->name)
							{
								//Must delete question by moving the remaining questions back one then delete last value.
								for($innerI = $questionI; $innerI < $questions - 1; ++$innerI)
								{
									$questionStore[$innerI] = $questionStore[$innerI+1];
								}
								array_pop($questionStore);
								--$questionI;
								--$questions;
							}
							else
							{
								$groupCount = count($questionStore[$questionI][1]);
								$indexOfGroup = -1;
								for($innerI = 0; $innerI < $groupCount; ++$innerI)
								{
									if($questionStore[$questionI][1][$innerI] == $group->name)
									{
										$indexOfGroup = $innerI;
										break;
									}
								}
								if($indexOfGroup >= 0)
								{
									//Move groupNames after the found index back one to get rid of the current group in this question.
									for($innerI = $indexOfGroup; $innerI < $groupCount - 1; ++$innerI)
									{
										$questionStore[$questionI][1][$innerI] = $questionStore[$questionI][1][$innerI+1];
									}
									array_pop($questionStore[$questionI][1]);
									--$groupCount;
								}
							}
								
						}
					}
				}
				//Delete all users for the group by going into 
			}
		}
		else//Only survey is present
		{
			foreach ($survey->groups as $group)
				$survey->groups()->detatch($group->id);
			foreach ($survey->answers as $answer)
				$answer->delete();
			$survey->delete();
			//Need to delete file for survey questions.
			
		}
		echo 'successful deletion submition';
	}
	
}