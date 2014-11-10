@extends('layouts.default')
@section('head')

@stop
@section('body')
<?php 
	$hadRecaptcha = Session::has('needsRecaptcha') && Session::get('needsRecaptcha');
?>
@if(isset($intended))
	{{ Form::open(array('route' => array('loginPost', 'intended' => $intended, 'hadRecaptcha' => $hadRecaptcha))) }}
@else
	{{ Form::open() }}
@endif
{{ Form::label('email', 'Email: ') }}
{{ Form::text('email', '', array()) }}
<br>
{{ Form::label('password', 'Password: ') }}
{{ Form::password('password', '', array()) }}
@if(Session::has('authError'))
	<div class = "error" >
		{{ Session::get('authError') }}
	</div>
@endif
@if($hadRecaptcha)
	<br>
	{{ Form::captcha(array('theme' => 'blackglass')) }}
	<br>
	<div class="error">
		<?php 
			$recaptchaError = count($errors->get('recaptcha response')) ? 
				$errors->first('recaptcha response') : 
				"Due to a high number of failed attempts to login to this account, recaptcha is required.";
		?>
		{{ $recaptchaError }}
	</div>
@endif
<br>
{{ Form::submit('Log in') }}
{{ Form::close() }}

@stop