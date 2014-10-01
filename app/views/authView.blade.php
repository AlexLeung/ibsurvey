@extends('layouts.default')
@section('head')

@stop
@section('body')
@if(isset($intended))
	{{ Form::open(array('route' => array('loginPost', 'intended' => $intended))) }}
@else
	{{ Form::open() }}
@endif
{{ Form::label('email', 'Email: ') }}
{{ Form::text('email', '', array()) }}
@if(count($errors->get('email')))
<div class = "error">
{{ $errors->first('email') }}
</div>
@endif
<br>
{{ Form::label('password', 'Password: ') }}
{{ Form::password('password', '', array()) }}
@if(count($errors->get('password')))
<div class = "error" >
{{ $errors->first('password') }}
</div>
@elseif((string)Session::get('authError'))
<div class = "error" >
{{ (string)Session::get('authError') }}
</div>
@endif
<br>
{{ Form::submit('Log in') }}
{{ Form::close() }}

@stop