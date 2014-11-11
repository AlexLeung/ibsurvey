@extends('layouts.default')

@section('body')
	@parent
	<h4>Here is a list of Schools that use ibsurvey.com:</h4>
	@if(count($schoolNames))
		<ol>
			@foreach($schoolNames as $schoolName)
				<li><a href="schools/{{$schoolName}}">{{$schoolName}}</a></li>
			@endforeach
		</ol>
	@else
		<br>There are no schools using this site.
	@endif
@stop