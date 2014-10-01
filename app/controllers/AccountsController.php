<?php

use Illuminate\Validation\ValidationServiceProvider;
class AccountsController extends \BaseController {
	
	public function loginPost()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$intended = Input::get('intended');
		$validator = Validator::make(
				array('email' => $email, 'password' => $password),
				array('email' => "required|email|exists:users,email,email,$email", 'password' => "required"));
		if($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->with('intended', $intended)->withInput();
		}
		if(!Auth::attempt(array('email' => $email, 'password' => $password)))
		{
			return Redirect::back()->with('authError', 'The selected password is invalid.')->with('intended', $intended)->withInput();
		}
		return Redirect::to('/login')->with('intended', $intended);
	}
	
	public function loginGet()
	{
		$input = Input::all();
		if(count($input) && $input['QS'])
			return Redirect::to('/login')->with('intended', "{$input['QS']}");
		$intended = Session::get('intended');
		if(Auth::check())
			return Redirect::to("/$intended");
		return View::make('authView')->with('authError', '')->with('intended',$intended);
	}
	
	public function logout()
	{
		$intended = Input::get('QS');
		Auth::logout();
		if($intended)
			return Redirect::to("/$intended");
		else
			return Redirect::to('/');
	}
	
	public function changePasswordGet()
	{
		
	}
	
	public function changePasswordPost()
	{
		
	}
	
	public function signupGet()
	{
		if(Input::has('intended'))
			return Redirect::to(Request::path())->with('intended', Input::get('intended'));
		if(Session::has('intended') && Auth::check())
		{
			$user = Auth::user();
			return View::make('createAccount')->with('user', $user)->with('intended', $intended);
		}	
		else
			return Redirect::to('/');
	}
	
	public function signupPost()
	{
		if(Auth::check())
		{
			$data = Input::all();
			$rules = array('email' => 'requied|email', 'name' => 'required', 'password' => 'required');
			if($data['name'] == "Anonymous")
				return Redirect::back()->withInput()->with('nameError', "One's name cannot be \"Anonymous\".")->with('intended', $data['intended']);
			if(!is_null(User::where('email', '=', $data['email'])->first()))
				return Redirect::back()->withInput()->with('emailError', 'The selected email already exists.')->with('intended', $data['intended']);
			$user = Auth::user();
			if($user->group->name == "Admin")
				$rules['group'] = "required|exists:groups,name,school_id,$user->school->id";//Might only be checking for school id, instead of schoolid and name, which was intended.
			$validator = Validator::make($data, $rules);
			if($validator->fails())
				return Redirect::back()->withInput()->withErrors($validator)->with('intended', $data['intended']);
			if($user->group->name == "Admin")
			{
				$newUser = new User;
				$newUser->name = $data['name'];
				$newUser->email = $data['email'];
				$newUser->password = Hash::make($data['password']);
				$newUser->group = Group::where('name', '=', $data['group'])->where('school_id', '=', $user->school_id)->first();
				$newUser->save();
			}
			else
			{
				$user->name = $data['name'];
				$user->email = $data['email'];
				$user->password = Hash::make($data['password']);
				$user->save();
				dd(Auth::user());
			}
			return Redirect::to("/{$data['intended']}");
		}
		return Redirect::to("/signup")->with('intended', Input::get('intended'));
	}
	
}