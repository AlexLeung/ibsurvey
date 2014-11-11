@extends('layouts.default')

@section('body')
	@parent
	Here is a list of Schools that use ibsurvey.com:
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