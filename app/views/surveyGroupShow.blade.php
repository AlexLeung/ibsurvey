@extends('layouts.default')
@section('head')
	
@stop
@section('body')
	@if(!isset($state))
		{{ Form::open(array('method' => 'get')) }}
		{{ Form::label('password', 'Password: ') }}
		{{ Form::password('password', '', array()) }}
		{{ Form::input('submit', 'passwordSubmit', 'Go To Survey') }}
		@if(isset($error))
			<br>
			<div class="error">
				{{ $error }}
			</div>
		@endif
	@elseif($state == "error")
		<div class="error">
			{{ $error }}
		</div>
	@elseif($state == "options")
		Before you proceed to the survey, would you like to:
		<br>
		{{ Form::open(array('method' => 'put')) }}
		{{ Form::input('submit', 'signIn', 'Sign In To Existing Account') }}
		{{ Form::input('submit', 'createAccount', 'Create New Account') }}
		{{ Form::input('submit', 'anonymous', 'Remain Anonymous') }}
		{{ Form::close() }}
		<br>
		(Completing your survey while signed in allows you to save progress on your survey.)
	@elseif($state == "survey")
		{{ $message }}
		{{ Form::open() }}
		<ol>
		@foreach($questionStore as $question)
			@if(in_array($groupName, $question[1]))
				<li>
				{{ $question[3] }}
				1{{ Form::checkbox("{$question[2]}Rate1") }}
				2{{ Form::checkbox("{$question[2]}Rate2") }}
				3{{ Form::checkbox("{$question[2]}Rate3") }}
				4{{ Form::checkbox("{$question[2]}Rate4") }}
				5{{ Form::checkbox("{$question[2]}Rate5") }}
				</li>
			@endif
		@endforeach
		</ol>
		<br>
		{{ Form::submit('Save Answers') }}
		{{ Form::close() }}
	@endif
@stop