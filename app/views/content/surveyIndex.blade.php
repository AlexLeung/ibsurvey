@extends('layouts.content')
<?php $isAdmin = Auth::check() && Auth::user()->group->name == "Admin"; ?>
@section('head')
@parent
<style>
@if($isAdmin)
	#column1
	{
		float: left;
		width: 	50%;
	}
	#column2
	{
		float: left;
		width: 45%;
		height: 100%;
		border-left: 1px solid black;
	}
	#column2 a, #coulmn2 a:visited
	{
		font-size: 14px;
		text-decoration: none;
		color: blue;
	}
	
	#column2 ul li ul li {
		font-size: 20px;
	}
	#column2 ul li ul li a{
		font-size: 12px;
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
	#column2 ul 
	{
		list-style: none;
		margin-left: 20px;
		padding-left: 1em;
		text-indent: -1em;
	}
@endif
</style>
@stop
@section('content')
<div id="column1">
{{ $school->name }}'s surveys:
<ul>
@foreach ($surveyNames as $surveyName)
	<li><a href="/schools/{{ $school->name }}/{{ $surveyName }}">{{ $surveyName }}</a></li>
@endforeach
</ul>
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
				@if($user->failedAttempts > 6)
					&nbsp&nbsp&nbsp
					{{ link_to(URL::route('unlock', array('intended' => Request::path(), 'unlock' => $user->id)), "Unlock") }}
				@endif
			</span></li>
		@endforeach
		</ul>
		</li>
	@endforeach
	</ul>
	<script type="text/javascript">
	$(".Collapsable").click(function (e) {
		if(e.pageX < $(this).offset().left + 10 )
		{
			if($(this).hasClass('down'))
				$(this).removeClass('down').addClass('up');
			else if($(this).hasClass('up'))
				$(this).removeClass('up').addClass('down');
	        $(this).parent().children().toggle();
	        $(this).toggle();
		}
    });
    $(".Collapsable").mousemove(function (e) {
		if($(this).hasClass('up') || $(this).hasClass('down'))
		{
			if(e.pageX < $(this).offset().left + 10)
				$(this).css('cursor', 'pointer');
			else
				$(this).css('cursor', 'auto');
		}
    });
	</script>
	</div>
@endif
@stop