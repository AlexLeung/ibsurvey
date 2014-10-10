@extends('layouts.default')
@section('head')

@stop
<?php 
	$isAdmin = Auth::check() && Auth::user()->group->name == "Admin"; 
	//dd($user);
?>
@section('body')
{{ Form::open(array('route' => array('accountPost', 'intended' => $intended, 'id' => $user->id, 'isAdmin' => $isAdmin))) }}
School: {{ Auth::user()->group->school->name }}
<br>
@if($isAdmin)
	{{ Form::label('group', 'Group: ') }}
	@if(isset($user->group_id))
		{{ Form::text('group', $user->group->name , array()) }}
	@else
		{{ Form::text('group', '', array()) }}
	@endif
	@if($errors->get('group'))
		<br>
		<div class="error">
			{{ $errors->first('group') }}
		</div>
	@elseif(Session::has('groupError'))
		<br>
		<div class="error">
			{{ Session::get('groupError') }}
		</div>
	@endif
@else
	Group: {{ $user->group->name }}
@endif
<br>
{{ Form::label('name', 'Name: ') }}
@if($user->name != "Anonymous")
	{{ Form::text('name', $user->name, array()) }}
@else
	{{ Form::text('name', '', array()) }}
@endif
@if($errors->get('name'))
	<br>
	<div class="error">
		{{ $errors->first('name') }}
	</div>
@elseif(Session::has('nameError'))
	<br>
	<div class="error">
		{{ Session::get('nameError') }}
	</div>
@endif
<br>
{{ Form::label('email', 'Email: ') }}
@if(isset($user->email))
	{{ Form::text('email', $user->email, array()) }}
@else
	{{ Form::text('email', '', array()) }}
@endif
@if($errors->get('email'))
	<br>
	<div class="error">
		{{ $errors->first('email') }}
	</div>
@elseif(Session::has('emailError'))
	<br>
	<div class="error">
		{{ Session::get('emailError') }}
	</div>
@endif
<br>
@if($user->name == "Anonymous")
	{{ Form::label('newPass', 'Enter A New Password: ') }}
	{{ Form::password('newPass', '', array()) }}
	@if($errors->get('newPass'))
		<br>
		<div class="error">
			{{ $errors->first('newPass') }}
		</div>
	@endif
	<br>
	{{ Form::label('rePass', 'Retype The Password: ') }}
	{{ Form::password('rePass', '', array()) }}
	@if($errors->get('rePass'))
		<br>
		<div class="error">
			{{ $errors->first('rePass') }}
		</div>
	@endif
@endif
@if($isAdmin || $user->name != "Anonymous")
	<br>
	<br>
	{{ Form::label('password', 'Enter Your Password: ') }}
	{{ Form::password('password', '', array()) }}
	@if($errors->get('password'))
		<br>
		<div class="error">
			{{ $errors->first('password') }}
		</div>
	@elseif(Session::has('authError'))
		<br>
		<div class="error">
			{{ Session::get('authError') }}
		</div>
	@endif
	<br>
	{{ Form::submit('Update Account') }}
@else
	{{ Form::submit('Create Account') }}
@endif
@stop