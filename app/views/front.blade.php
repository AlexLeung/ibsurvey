@extends('layouts.default')
@section('head')
	<meta charset="UTF-8">
	<style>
		body {
			text-align:center;
			color: #999;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
@stop
@section('body')
	@parent
	<br><br><br><br><h1>Welcome to IBSURVEY.COM!</h1>
	<h5>Where ib schools can launch surveys at affordable prices.</h5>
	<br><br><br><a href="schools">List of Schools</a>
@stop
