<?php
class AccountsController extends \BaseController {
	
	public function loginPost()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$intended = Input::get('intended');
		$user = User::where('email', '=', $email)->first();
		$errors = [];
		$recaptchaRequired = false;
		if(!$user)
			$errors['auth'] = 'email or password is invalid';
		else if($user->failedAttempts > 6)
			return Redirect::to(Request::path())->with('intended', $intended)
												->with('locked', true);
		else if($user->failedAttempts > 3)
		{
			$recaptchaRequired = true;
			if(!Input::has('g-recaptcha-response'))
				$errors['recaptcha'] = "failed login attempts: $user->failedAttempts";
			else
			{
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$query_string = 'secret=6Lfwm_wSAAAAABeIj7iJh9x7ecfxQy2cgvU5rnC1&response='.Input::get('g-recaptcha-response');
				$result = file_get_contents("$url?$query_string");
				$result = json_decode($result);
				if(!$result->success)
					$errors['recaptcha'] = 'recaptcha incorrectly solved';
			}
		}
		else if(!Hash::check($password, $user->password))
		{
			$user->failedAttempts++;
			$user->save();
			$errors['auth'] = 'email or password is invalid';
		}
		if(count($errors))
			return Redirect::back()
				->with('intended', $intended)
				->with('recaptchaRequired', $recaptchaRequired)
				->withErrors($errors)
				->withInput();
		$user->failedAttempts = 0;
		$user->save();	
		Auth::login($user);
		return Redirect::to(Request::path())->with('intended', $intended);
	}
	
	public function loginGet()
	{
		$input = Input::all();
		if(count($input) && $input['intended'])
		{
			if(isset($input['locked']))
				return Redirect::to(Request::path())->with('intended', $input['intended'])->with('locked', $input['locked']);
			return Redirect::to(Request::path())->with('intended', $input['intended']);
		}
		$intended = Session::get('intended');
		if(Auth::check())
			return Redirect::to($intended);
		if(Session::has('locked'))
			return View::make('center.locked')->with('intended', $intended);
		return View::make('center.authView')->with('intended',$intended);
	}
	
	public function unlock()
	{
		$intended = Input::get('intended');
		$user = User::find(Input::get('unlock'));
		if(!is_null($user) && Auth::check() && Auth::user()->group->name == "Admin")
		{
			$user->failedAttempts = 0;
			$user->save();
		}
		return Redirect::to($intended);
	}
	
	public function logout()
	{
		$intended = Input::get('intended');
		Auth::logout();
		return Redirect::to($intended);
	}
	
	public function changePasswordGet()
	{
		if(Input::has('intended'))
			return Redirect::to(Request::path())
				->with('intended', Input::get('intended'))
				->with('group', Input::has('group') ? Input::get('group') : -1);
		if(Session::has('intended') && Session::has('group') && Auth::check())
		{
			$intended = Session::get('intended');
			$groupId = Session::get('group');
			$group = null;
			if(Auth::user()->group->name == "Admin" && is_numeric($groupId) && $groupId != -1)
				$group = Group::find($groupId);
			return View::make('center.changePassword')->with('intended', $intended)->with('group', $group);
		}
		return Redirect::to('/');
	}
	
	public function changePasswordPost()
	{
		$data = Input::all();
		if(Auth::check())
		{
			$rules = array('newPass' => 'required', 'rePass' => 'required|same:newPass', 'password' => 'required');
			$messages = ['newPass.required' => 'a new password is required',
						 'rePass.same' => 'both passwords must match',
						 'rePass.required' => 'both passwords must match',
						 'password.required' => 'your password is required'];
			$user = Auth::user();
			$editingGroup = $data['groupId'] != -1 && $user->group->name == "Admin" && $user->group->school->groups->contains($data['groupId']);	
			if($editingGroup)
			{
				$rules['groupPassword'] = 'required';
				$messages['groupPassword.required'] = "the group's password is required";
			}
			else 
				$data['groupId'] = -1;
			$validator = Validator::make($data, $rules, $messages);
			if($validator->fails())
				return Redirect::back()
					->with('intended', $data['intended'])
					->withErrors($validator)
					->with('group', $data['groupId']);
			if(!Hash::check($data['password'], $user->password))
				return Redirect::back()
					->with('intended', $data['intended'])
					->withErrors(['password' => 'you entered an invalid password'])
					->with('group', $data['groupId']);
			if($editingGroup)
			{
				$group = Group::find($data['groupId']);
				if(!Hash::check($data['groupPassword'], $group->password))
					return Redirect::back()
						->with('intended', $data['intended'])
						->withErrors(['groupPassword' => "the group's password was invalid"])
						->with('group', $data['groupId']);
				$group->password = Hash::make($data['newPass']);
				$group->save();
			}
			else
			{
				$user->password = Hash::make($data['newPass']);
				$user->save();
			}
		}
		return Redirect::to($data['intended']);
	}
	
	public function accountGet()
	{
		if(Input::has('intended'))
			return Redirect::to(Request::path())
				->with('intended', Input::get('intended'))
				->with('edit', Input::has('edit') ? Input::get('edit') : 'None')
				->with('groupName', Input::has('groupName') ? Input::get('groupName') : 0);
		if(Session::has('intended') && Session::has('edit') && Auth::check())
		{
			$edit = Session::get('edit');
			if(is_numeric($edit))
			{
				if($edit == -1)
				{
					$group =  Auth::user()->group->school->groups()->where('name', Session::get('groupName'))->first();
					$user = new User;
					if(!is_null($group))
						$user->group_id = $group->id;
					$user->name = "Anonymous";
					$user->id = -1;
				}
				else
				{
					$user = User::find($edit);
					if(!$user)
						return Redirect::back();
				}
			}
			else
				$user = Auth::user();
			return View::make('center.updateAccount')
				->with('user', $user)
				->with('intended', Session::get('intended'));
		}	
		else
			return Redirect::to('/');
	}
	
	public function accountPost()
	{
		$data = Input::all();
		$isAdmin = $data['isAdmin'];
		if(Auth::check() && (Auth::user()->group->name == "Admin") == $isAdmin)
		{
			$rules = array('email' => 'required|email', 'name' => 'required|alpha');
			$id = $data['id'];
			if($id == -1)
			{
				$user = new User;
				$user->name = "Anonymous";
				$user->email = "none";
			}
			else
				$user = User::find($id);
			if($user->name == "Anonymous")
			{
				$rules['newPass'] = 'required';
				$rules['rePass'] = 'required|same:newPass';
			}
			if($isAdmin || $user->name != "Anonymous")
				$rules['password'] = 'required';
			if($isAdmin)
				$rules['group'] = "required";
			$validator = Validator::make($data, $rules);
			if($validator->fails())
				return Redirect::back()
					->withInput()
					->withErrors($validator)
					->with('intended', $data['intended'])
					->with('edit', $id);
			$emailUser = User::where('email', '=', $data['email'])->first();
			if(!is_null($emailUser) && $emailUser->id != $user->id)
				return Redirect::back()
					->withError(['email' => 'the entered email already exists'])
					->with('edit', $id)
					->with('intended', $data['intended'])
					->withInput();
			if($isAdmin || $user->name != "Anonymous")
			{
				if(!Auth::attempt(array('id' => Auth::user()->id, 'password' => $data['password'])))
					return Redirect::back()
						->withErrors(['password' => 'you entered invalid password'])
						->with('intended', $data['intended'])
						->with('edit', $id)
						->withInput();
			}
			if($data['name'] == "Anonymous")
				return Redirect::back()
					->withInput()
					->with('edit', $id)
					->withErrors(['name' => "one's name cannot be \"Anonymous\""])
					->with('intended', $data['intended']);
			if($isAdmin)
			{
				$group = Group::where('name', '=', $data['group'])->where('school_id', '=', Auth::user()->group->school->id)->first();
				if(!$group)
					return Redirect::back()
						->withErrors(['group', 'the entered group does not exist'])
						->with('intended', $data['intended'])
						->with('edit', $id)
						->withInput();
				$user->group_id = $group->id;
			}
			if($user->name == "Anonymous")
				$user->password = Hash::make($data['newPass']);
			$user->name = $data['name'];
			$user->email = $data['email'];
			$user->save();
			return Redirect::to($data['intended']);
		}
		return Redirect::to($data['intended']);
	}
	
	public function deleteGet()
	{
		if(Input::has('intended') && Input::has('delete'))
			return Redirect::to(Request::path())
				->with('intended', Input::get('intended'))
				->with('delete', Input::get('delete'));
		if(Auth::check() && Auth::user()->group->name == "Admin" && Session::has('intended') && Session::has('delete'))
		{
			$intended = Session::get('intended');
			$delete = Session::get('delete');
			if(is_numeric($delete))
			{
				$user = User::find($delete);
				if(!is_null($user))
				{
					return View::make('center.deleteAccount')
						->with('user', $user)
						->with('intended', $intended);	
				}
			}
		}
		return Redirect::to('/');
	}
	
	public function deletePost()
	{
		$data = Input::all();
		if(Auth::check() && Auth::user()->group->name == "Admin")
		{
			$validator = Validator::make($data, ['password' => 'required'], ['password.required' => 'your password is required']);
			if($validator->fails())
				return Redirect::back()
					->withErrors($validator)
					->with('intended', $data['intended'])
					->with('delete', $data['delete']);
			if(!Hash::check($data['password'], Auth::user()->password))
				return Redirect::back()
					->withErrors(['password' => 'you entered an invalid password'])
					->with('intended', $data['intended'])
					->with('delete', $data['delete']);
			$user = User::find($data['delete']);
			if(!is_null($user))
			{
				$path = app_path()."/answers/{$user->id}.ans";
				if(File::exists($path))
					File::delete($path);
				$user->delete();
			}
		}
		return Redirect::to($data['intended']);
	}
	
}