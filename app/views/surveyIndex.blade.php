@extends('layouts.default')
<?php $isAdmin = Auth::check() && Auth::user()->group->name == "Admin"; ?>
@section('head')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<style>
<!--
@if($isAdmin)
	#container
	{
		height: 100%;
	}
	#column1
	{
		float: left;
		width: 	75%;
	}
	#column2
	{
		float: left;
		width: 20%;
		height: 100%;
		border-left: 1px solid black;
	}
	.clear
	{
		clear: both;
	}
	.up
	{
		background-image: url('/files/image/UpListNode.png');
		background-position: left;
		background-repeat: no-repeat;
	}
	.down
	{
		background-image: url('/files/image/DownListNode.png');
		background-position: left;
		background-repeat: no-repeat;
	}
	ul 
	{
		list-style: none;
		margin-left: 20px;
		padding-left: 1em;
		text-indent: -1em;
	}
@endif
-->
</style>
@stop
@section('body')
@parent
<div id="container">
<div id="column1">
Welcome to the page for {{ $school->name }}.
<br><br>
Here is a list of surveys for this school:
<ol>
@foreach ($surveyNames as $surveyName)
	<li><a href="/schools/{{ $school->name }}/{{ $surveyName }}">{{ $surveyName }}</a></li>
@endforeach
</ol>
</div>
@if($isAdmin)
	<div id="column2">
	<ul>
	@foreach($school->groups as $group)
		<li>
		<span class="Collapsable down">
		&nbsp&nbsp&nbsp{{ $group->name }}
		&nbsp&nbsp&nbsp
		{{ link_to(URL::route('accountGet', array('intended' => Request::path(), 'edit' => -1, 'groupName' => $group->name)), "New Profile") }}
		&nbsp&nbsp&nbsp
		{{ link_to(URL::route('passwordGet', array('intended' => Request::path(), 'group' => $group->id)), "Change Password") }}
		</span>
		<ul>
		@foreach($group->users as $user)
			<li><span class="Collapsable">
				&nbsp&nbsp&nbsp{{ $user->name }}&nbsp&nbsp&nbsp
				{{ link_to(URL::route('accountGet', array('intended' => Request::path(), 'edit' => $user->id)), "Update") }}
				&nbsp&nbsp&nbsp
				{{ link_to(URL::route('deleteGet', array('intended' => Request::path(), 'delete' => $user->id)), "Delete") }}
			</span></li>
		@endforeach
		</ul>
		</li>
	@endforeach
	</ul>
	<script type="text/javascript">
	$(".Collapsable").click(function () {
		if($(this).hasClass('down'))
			$(this).removeClass('down').addClass('up');
		else if($(this).hasClass('up'))
			$(this).removeClass('up').addClass('down');
        $(this).parent().children().toggle();
        $(this).toggle();
    });
	</script>
	</div>
	<div class="clear"></div>
@endif
</div>
@stop