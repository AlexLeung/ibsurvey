<?php
class AccountsController extends \BaseController {
	
	public function loginPost()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$intended = Input::get('intended');
		$hadRecaptcha = Input::get('hadRecaptcha');
		$user = User::where('email', '=', $email)->first();
		if(!$user)
			return Redirect::back()
				->with('authError', 'The email or password is invalid.')
				->with('intended', $intended)
				->withInput();
		if($user->failedAttempts > 6)
			return Redirect::to(Request::path())->with('intended', $intended)->with('locked', true);
		if($user->failedAttempts > 3)
		{
			if(!$hadRecaptcha)
				return Redirect::back()->with('intended', $intended)->with('needsRecaptcha', true)->withInput();
			$validator = Validator::make(array('recaptcha response' => Input::get('recaptcha_response_field')),
					array('recaptcha response' => 'required|recaptcha'));
			try 
			{
				if($validator->fails())
					return Redirect::back()->withErrors($validator)->with('intended', $intended)->withInput()->with('needsRecaptcha', true);
			}
			catch(Exception $e)
			{
				return Redirect::to("/");
			}
		}
		if(!Hash::check($password, $user->password))
		{
			$user->failedAttempts++;
			$user->save();
			return Redirect::back()
				->with('authError', 'The email or password is invalid.')
				->with('intended', $intended)
				->withInput()
				->with('needsRecaptcha', $user->failedAttempts > 3);
		}
		$user->failedAttempts = 0;
		$user->save();	
		Auth::login($user);
		return Redirect::to(Request::path())->with('intended', $intended);
	}
	
	public function loginGet()
	{
		$input = Input::all();
		if(count($input) && $input['QS'])
		{
			if(isset($input['locked']))
				return Redirect::to(Request::path())->with('intended', $input['QS'])->with('locked', $input['locked']);
			return Redirect::to(Request::path())->with('intended', $input['QS']);
		}
		$intended = Session::get('intended');
		if(Auth::check())
			return Redirect::to($intended);
		if(Session::has('locked'))
			return View::make('locked')->with('intended', $intended);
		return View::make('authView')->with('intended',$intended);
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
		$intended = Input::get('QS');
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
			return View::make('changePassword')->with('intended', $intended)->with('group', $group);
		}
		return Redirect::to('/');
	}
	
	public function changePasswordPost()
	{
		$data = Input::all();
		if(Auth::check())
		{
			$rules = array('newPass' => 'required', 'rePass' => 'required|same:newPass', 'password' => 'required');
			$user = Auth::user();
			$editingGroup = $data['groupId'] != -1 && $user->group->name == "Admin" && $user->group->school->groups->contains($data['groupId']);	
			if($editingGroup)
				$rules['groupPassword'] = 'required';
			else 
				$data['groupId'] = -1;
			$validator = Validator::make($data, $rules);
			if($validator->fails())
				return Redirect::back()
					->with('intended', $data['intended'])
					->withErrors($validator)
					->with('group', $data['groupId']);
			if(!Hash::check($data['password'], $user->password))
				return Redirect::back()
					->with('intended', $data['intended'])
					->with('passwordError', 'The selected password invalid')
					->with('group', $data['groupId']);
			if($editingGroup)
			{
				$group = Group::find($data['groupId']);
				if(!Hash::check($data['groupPassword'], $group->password))
					return Redirect::back()
						->with('intended', $data['intended'])
						->with('groupPassError', 'The selected password invalid')
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
			return View::make('updateAccount')
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
					->with('emailError', 'The selected email already exists.')
					->with('edit', $id)
					->with('intended', $data['intended'])
					->withInput();
			if($isAdmin || $user->name != "Anonymous")
			{
				if(!Auth::attempt(array('id' => Auth::user()->id, 'password' => $data['password'])))
					return Redirect::back()
						->with('authError', 'The selected password is invalid.')
						->with('intended', $data['intended'])
						->with('edit', $id)
						->withInput();
			}
			if($data['name'] == "Anonymous")
				return Redirect::back()
					->withInput()
					->with('edit', $id)
					->with('nameError', "One's name cannot be \"Anonymous\".")
					->with('intended', $data['intended']);
			if($isAdmin)
			{
				$group = Group::where('name', '=', $data['group'])->where('school_id', '=', Auth::user()->group->school->id)->first();
				if(!$group)
					return Redirect::back()
						->with('groupError', 'The selected group does not exist.')
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
					return View::make('deleteAccount')
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
			$validator = Validator::make($data, array('password' => 'required'));
			if($validator->fails())
				return Redirect::back()
					->withErrors($validator)
					->with('intended', $data['intended'])
					->with('delete', $data['delete']);
			if(!Hash::check($data['password'], Auth::user()->password))
				return Redirect::back()
					->with('passwordError', 'The selected password is invalid')
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