<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="/files/image/ibsurveys.ico">
<title>IB Surveys</title>
<style type="text/css">
@import url(//fonts.googleapis.com/css?family=Lato:700);
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

#header a, #header a:visited
{
	text-decoration:none; 
}

#header
{
	text-align: right; 
	padding-right: 20px; 
	border-bottom: 1px black solid;
	color: #999;
}

body {
	margin:0;
	font-family:'Lato', sans-serif;
}
</style>
@yield('head')
</head>
<body>
@section('body')
	<div id="header">
		@if(Auth::check())
			@if(Auth::user()->name == "Anonymous")
				Anonymous Account:
				&nbsp&nbsp&nbsp
				{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Create Full Profile (letting you save progress)") }}
			@else
				| {{ Auth::user()->email }} |&nbsp&nbsp&nbsp
				{{ Auth::user()->name }}'s Account
				&nbsp&nbsp&nbsp
				{{ link_to(URL::route('passwordGet', array('intended' => Request::path())), "Change Password") }}
				&nbsp&nbsp&nbsp
				{{ link_to(URL::route('accountGet', array('intended' => Request::path())), "Update Account Details") }}
			@endif
			&nbsp&nbsp&nbsp
			{{ link_to(URL::route('logout', array('QS' => Request::path())), "Log out") }}
		@else
			{{ link_to(URL::route('loginGet', array('QS' => Request::path())), "Log in") }}
		@endif
	</div>
@show
</body>
</html>