@extends('layouts.default')
@section('head')
@parent
@stop
@section('body')
<?php 
	$needsRecaptcha = Session::has('recaptchaRequired') && Session::get('recaptchaRequired');
?>
@if(isset($intended))
	{{ Form::open(['route' => ['loginPost', 'intended' => $intended]]) }}
@else
	{{ Form::open() }}
@endif
<div id="login" class="container center">
	<div class="item">
		e-mail<br>
		{{ Form::text('email', '', array()) }}
	</div>
	<div class="item">
		password<br>
		{{ Form::password('password', '', array()) }}
	</div>
	@if($errors->has('auth'))
		<div class="item error">
			{{ $errors->first('auth') }}
		</div>
	@endif
	@if($needsRecaptcha)
		<div class="item">
			{{ View::make('plugins.recaptcha') }}
		</div>
		@if($errors->has('recaptcha'))
			<div class="item error">
				{{ $errors->first('recaptcha') }}
			</div>
		@endif
	@endif
	<div class="item">
		{{ Form::submit('login') }}
	</div>
</div>
{{ Form::close() }}
<script>
	var finalHeight = 320;
	var marginUp = 15;
	@if($errors->has('auth'))
		finalHeight += 40;
	@endif
	@if($needsRecaptcha)
		finalHeight += 130;
		marginUp -= 5;
	@endif
	$("div#login").css('margin-top', "-"+((finalHeight / 2) | 0)+"px");
	$("div#login").css('height', finalHeight+'px');
	$(".item input[type='submit']").css('margin-top', marginUp+'px');
</script>
@stop