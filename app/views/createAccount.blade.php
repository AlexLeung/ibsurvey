@extends('layouts.default')
@section('head')

@stop
@section('body')
{{ Form::open(array('route' => array('signinPost', 'intended' => $intended))) }}
School: {{ $user->group->school->name }}
<br>
@if($user->group->name == "Admin")
	{{ Form::label('group', 'Group: ') }}
	{{ Form::text('group', '', array()) }}
	@if($errors->get('group'))
		<br>
		<div class="error">
			{{ $errors->first('group') }}
		</div>
	@endif
@else
	Group: {{ $user->group->name }}
@endif
<br>
{{ Form::label('name', 'Name: ') }}
{{ Form::text('name', '', array());
@if($errors->get('name'))
	<br>
	<div class="error">
		{{ $errors->first('name') }}
	</div>
@elseif(isset($nameError))
	<br>
	<div class="error">
		{{ $nameError }}
	</div>
@endif
<br>
{{ Form::label('email', 'Email: ') }}
{{ Form::text('email', '', array()) }}
@if($errors->get('email'))
	<br>
	<div class="error">
		{{ $errors->first('email') }}
	</div>
@elseif(isset($emailError))
	<br>
	<div class="error">
		{{ $emailError }}
	</div>
@endif
<br>
{{ Form::label('password' 'Password: ') }}
{{ Form::password('password', '', array()) }}
{{ Form::submit('Create Account') }}
@stop