@extends('layouts.content')
<?php 
	$session = Session::get('fields');
	$isAdmin = Auth::check() && Auth::user()->group->name == "Admin";	
?>
@section('content')
@parent
<div class="header">{{$school->name}}'s Survey</div>
@if($isAdmin)
	{{ Form::open() }}
	<h2>{{$survey->name}}</h2>
	{{ Form::input('submit', 'changeName', 'Change Name', ['class' => 'editButton']) }}
	@if($errors->has('name'))
		<div class="error">
			{{ $errors->first('name') }}
		</div>
	@endif
	{{ Form::close() }}
@else
	<h2>{{$survey->name}}</h2>
@endif
<br>
<br>
Groups:
<br>
<ul>
@foreach ($groupStats as $groupStat)
	<li>
	@if($groupStat['active'])
		{{ link_to("schools/$school->name/$survey->name/{$groupStat['group']->name}", $groupStat['group']->name) }}
	@else
		{{ $groupStat['group']->name }}
	@endif
	@if($isAdmin)
		<br>
		{{ Form::label("openTime{$groupStat['group']->name}", 'Survey Opening Time: ') }}
		{{ Form::text("openTime{$groupStat['group']->name}", "{$groupStat['open_time']}", array()) }}
		{{ Form::input("submit", "{$groupStat['group']->name}ChangeOpen", "Change Opening Time") }}
		{{ Form::input("submit", "{$groupStat['group']->name}OpenNow", "Open Survey Now") }}
		@if($errors->get('time') && $session['time'] == "openTime{$groupStat['group']->name}")
			<br>
			<div class="error">
				{{ $errors->first('time') }}
			</div>
		@endif
		<br>
		{{ Form::label("closingTime{$groupStat['group']->name}", 'Survey Closing Time: ') }}
		{{ Form::text("closingTime{$groupStat['group']->name}", "{$groupStat['close_time']}", array()) }}
		{{ Form::input("submit", "{$groupStat['group']->name}ChangeClose", "Change Closing Time") }}
		{{ Form::input("submit", "{$groupStat['group']->name}CloseNow", "Close Survey Now") }}
		@if($errors->get('time') && $session['time'] == "closingTime{$groupStat['group']->name}")
			<br>
			<div class="error">
				{{ $errors->first('time') }}
			</div>
		@endif
	@endif
	</li>
@endforeach
</ul>
@if($isAdmin)
	{{ Form::label('questions', 'Edit Questions: ') }}
	<br>
	{{ Form::textarea('questions', File::exists(app_path()."/questions/$survey->id.qs") ? File::get(app_path()."/questions/$survey->id.qs") : "", array()) }}
	<br>
	@if(isset($session['questions']) && !$session['questions'][0])
		<div class="error">
			{{ $session['questions'][1] }}
		</div>
		<br>
	@endif
	{{ Form::input('submit', 'changeQuestions', 'Update Questions') }}
	{{ Form::close() }}
@endif
@stop