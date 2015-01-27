@extends('layouts.default')
@section('head')
	<meta charset="UTF-8">
	<style>
		body {
			text-align:center;
		}
		a.container {
			display: block;
			color: #4a4a4a;
			font-size: 39px;
			text-decoration: none;
			font-weight: 900;
		}
	</style>
@stop
@section('body')
	@parent
	<div class="center" style="height: 320px; margin-top: -160px; width: 600px; margin-left: -300px;">
		<div class="container" style="width: 350px; float: left;">
			<img src="/favicon.png">
		</div>
		<div id="home-right">
		@if($loggedIn)
			{{ link_to(URL::route('schoolIndex'), "Schools", ['class' => 'container', 'style' => 'height: 180px; top: 0; line-height: 180px;']) }}
			<br>
			{{ link_to(URL::route('logout', array('intended' => Request::path())), "Logout", ['class' => 'container', 'style' => 'height: 110px; bottom: 0; line-height: 110px;']) }}
		@else
			{{ link_to(URL::route('register', array('intended' => Request::path())), "Register", ['class' => 'container', 'style' => 'height: 180px; top: 0; line-height: 180px;']) }}
			<br>
			{{ link_to(URL::route('loginGet', array('intended' => Request::path())), "Login", ['class' => 'container', 'style' => 'height: 110px; bottom: 0; line-height: 110px;']) }}
		@endif
		</div>
	</div>
@stop
