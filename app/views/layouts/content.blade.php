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
	width: 8px;
	height: 100%;
	float: left;
	position: absolute;
}
.bar-left-wrapper > div:first-of-type+div {
	padding: 10px 20px;
}
.bar-left-wrapper:not(:first-of-type) {
	margin-top: 10px;
}
.bar-left-wrapper ul {
	margin: 0;
	padding-top: 5px;
	padding-left: 20px;
	padding-bottom: 0;
	padding-right: 0;
	font-size: 19px;
}
.bar-left-wrapper a {
	text-decoration: none;
	color: #4a4a4a;
}
.bar-left-wrapper a:hover {
	color: #303030;
}
.bar-left-wrapper:last-of-type a {
	color: #ff5469;
	font-weight: bold;
}
.bar-left-wrapper span {
	font-weight: bold;
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
					<ul>
						<li>{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Create Full Profile (letting you save progress)") }}</li>
					</ul>
				@else
					<span>{{ Auth::user()->name }}</span>
					<ul>
						<li>{{ link_to(URL::route('passwordGet', array('intended' => Request::path())), "Change Password") }}</li>
						<li>{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Update Account Details") }}</li>
					</ul>
				@endif
				</div>
			</div>
			<div class="bar-left-wrapper">
				<div style="background-color: #ff5469;"></div>
				<div>{{ link_to(URL::route('logout', array('intended' => Request::path())), "Log-Out") }}</div>
			</div>
		@else
			<div class="bar-left-wrapper">
				<div style="background-color: #ff5469;"></div>
				<div>{{ link_to(URL::route('loginGet', array('intended' => Request::path())), "Login") }}</div>
			</div>
		@endif
		</div>
		@yield('sidebar')
	</div>
@stop