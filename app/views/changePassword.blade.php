@extends('layouts.default')
@section('body')
	{{ Form::open(array('route' => array('passwordPost', 'intended' => $intended, 'groupId' => !$group ? -1 : $group->id))) }}
	@if(!is_null($group))
		Changing Password For Group: {{ $group->name }}
		<br>
	@endif
	{{ Form::label('newPass', 'New Password: ') }}
	{{ Form::password('newPass', '', array()) }}
	@if($errors->get('newPass'))
		<br>
		<div class="error">
			{{ $errors->first('newPass') }}
		</div>
	@endif
	<br>
	{{ Form::label('rePass', 'Re-type Password: ') }}
	{{ Form::password('rePass', '', array()) }}
	@if($errors->get('rePass'))
		<br>
		<div class="error">
			{{ $errors->first('rePass') }}
		</div>
	@endif
	@if(!is_null($group))
		<br>
		{{ Form::label('groupPassword', 'Current Group Password: ') }}
		{{ Form::password('groupPassword', '', array()) }}
		@if($errors->get('groupPassword'))
			<br>
			<div class="error">
				{{ $errors->first('groupPassword') }}
			</div>
		@elseif(Session::has('groupPassError'))
			<br>
			<div class="error">
				{{ Session::get('groupPassError') }}
			</div>
		@endif
		<br>
		<br>
		{{ Form::label('password', 'Your Password: ') }}
	@else
		<br>
		<br>
		{{ Form::label('password', 'Your Current Password: ') }}
	@endif
	{{ Form::password('password', '', array()) }}
	@if($errors->get('password'))
		<br>
		<div class="error">
			{{ $errors->first('password') }}
		</div>
	@elseif(Session::has('passwordError'))
		<br>
		<div class="error">
			{{ Session::get('passwordError') }}
		</div>
	@endif
	{{ Form::submit('Change Password') }}
@stop