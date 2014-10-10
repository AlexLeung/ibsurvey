<!doctype html>
<html>
<head>
<style type="text/css">
.error
{
	background-color: red;
	max-width: 40%;
	padding: 5px, 5px, 5px, 5px;
	border: 2px solid;
	border-radius: 5px;
	border-color: orange;	
	color: tan;
	text-align: center;
}
</style>
@yield('head')
</head>
<body>
@section('body')
	<div style="text-align: right; padding-right: 20px; border-bottom: 1px black solid;">
		@if(Auth::check())
			| {{ Auth::user()->email }} |&nbsp&nbsp&nbsp
			{{ Auth::user()->name }}'s Account:
			&nbsp&nbsp&nbsp
			{{ link_to(URL::route('passwordGet', array('intended' => Request::path())), "Change Password") }}
			&nbsp&nbsp&nbsp
			{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Update Account") }}
			&nbsp&nbsp&nbsp
			{{ link_to(URL::route('logout', array('QS' => Request::path())), "Log out") }}
		@else
			{{ link_to(URL::route('loginGet', array('QS' => Request::path())), "Log in") }}
		@endif
	</div>
@show
</body>
</html>