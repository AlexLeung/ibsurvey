@extends('layouts.default')
@section('body')
	Deleteing user named {{ $user->name }} from group {{ $user->group->name }}.
	{{ Form::open(array('route' => array('deletePost', 'intended' => $intended, 'delete' => $user->id))) }}
	<br>
	{{ Form::label('password', 'Enter Your Password: ') }}
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
	<br>
	{{ Form::submit('Delete Account') }}
	{{ Form::close() }}
@stop