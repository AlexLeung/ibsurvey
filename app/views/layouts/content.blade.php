@extends('layouts.default')
@section('head')
<style>
.container {
	padding: 20px;
}
#content {
	top: 40px;
	left: 40px;
	width: calc(100% - 500px);
	position: absolute;
}
#sidebar {
	top: 40px;
	right: 40px;
	position: fixed;
}
#sidebar .container {
	width: 300px;
	margin-top: 40px;
}
.bar-left-wrapper {
	position: relative;
	color: #4a4a4a;
}
.bar-left-wrapper > div:first-of-type {
	width: 10px;
	height: 100%;
	float: left;
	position: absolute;
}
.bar-left-wrapper > div:first-of-type+div {
	padding: 10px 20px;
}
.bar-left-wrapper a {
	text-decoration: none;
	background: #838383;
	font-weight: 200;
	padding: 5px;
	margin-top: 5px;
	font-size: 19px;
	color: white;
}
.bar-left-wrapper a:hover {
	background: #696969;
}
.bar-left-wrapper a:active {
	background: #4f4f4f;
}
.bar-left-wrapper span {
	font-weight: bold;
}
.bar-left-wrapper span~div {
	margin-top: 8px;
}
.bar-left-wrapper+div {
	margin-top: 12px;
}
</style>
@stop
@section('body')
	<div class="container" id="content">
		@yield('content')
	</div>
	<div id="sidebar">
		<div class="container" style="margin-top: 0;">
		@if(Auth::check())
			<div class="bar-left-wrapper">
				<div style="background-color: #4a4a4a;"></div>
				<div>
				@if(Auth::user()->name == "Anonymous")
					<span>Anonymous Account</span>
					<div>{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Create Full Profile (letting you save progress)") }}</div>
				@else
					<span>{{ Auth::user()->name }}</span>
					<div>{{ link_to(URL::route('passwordGet', array('intended' => Request::path())), "Change Password") }}</div>
					<div>{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Update Account Details") }}</div>
				@endif
				</div>
			</div>
			<div>{{ link_to(URL::route('logout', ['intended' => Request::path()]), "Log-Out", ['class' => 'lightRed']) }}</div>
		@else
			<div>{{ link_to(URL::route('loginGet', ['intended' => Request::path()]), "Login", ['class' => 'lightRed']) }}</div>
		@endif
		</div>
		@yield('sidebar')
	</div>
@stop