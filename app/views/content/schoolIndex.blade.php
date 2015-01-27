@extends('layouts.content')

@section('content')
	Schools using IB Surveys:
	@if(count($schoolNames))
		<ul>
			@foreach($schoolNames as $schoolName)
				<li><a href="schools/{{$schoolName}}">{{$schoolName}}</a></li>
			@endforeach
		</ul>
	@else
		<br>There are no schools using this site.
	@endif
@stop