<!doctype html>
<?php 

$loggedIn = Auth::check();

?>
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
@if($loggedIn)
	<div style="text-align: right;">
		{{ link_to(URL::route('logout', array('QS' => Request::path())), "Log out") }}
	</div>
@endif
@yield('body')
</body>
</html>