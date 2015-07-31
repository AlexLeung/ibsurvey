@extends('layouts.content')
<?php $isAdmin = Auth::check() && Auth::user()->group->name == "Admin"; ?>
@section('head')
@parent
<style>
@if($isAdmin)
    #columnWrapper
    {
        padding: 20px 5px 20px;
    }
	#column1
	{
		float: left;
		width: 	35.5%;
        color: #FFFFFF;
    }
    #column1 a
    {
        font-family: Ubuntu-Medium;
        font-size: 30px;
        color: #4A4A4A;
        line-height: 42px;
        text-decoration: none;
    }
	#column2
	{
		float: left;
		width: 45%;
		height: 100%;
        font-size: 28px;
		border-left: 10px solid #4A4A4A;
	}
    #column2 td:not(td:first-of-type)
    {
        padding-left: 20px;
    }
	#column2 a, #coulmn2 a:visited
	{
		font-size: 18px;
		text-decoration: none;
	}
	
	#column2 ul li td {
		font-size: 20px;
	}

	.clear
	{
		clear: both;
	}
    table
    {
        border-collapse: collapse;
        border-spacing: 0;
        table-layout: fixed;
        width: auto;
        margin-top: 10px;
    }
    table td:first-of-type
    {
        width: 170px;
        text-align: right;
    }
    table td
    {
        padding-left: 50px;
        width: 100px;
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
<div class="header">{{ $school->name }}'s surveys:</div>
<div id="columnWrapper">
<div id="column1">
@foreach ($surveyNames as $surveyName)
	<a href="/schools/{{ $school->name }}/{{ $surveyName }}">{{ $surveyName }}</a>
@endforeach
</div>
@if($isAdmin)
	<div id="column2">
	<ul>
	@foreach($school->groups as $group)
		<li>
		<span class="Collapsable down">
		{{ $group->name }}
		{{ link_to(URL::route('accountGet', array('intended' => Request::path(), 'edit' => -1, 'groupName' => $group->name)), "Add Profile", ['class' => 'gray-button']) }}
		{{ link_to(URL::route('passwordGet', array('intended' => Request::path(), 'group' => $group->id)), "Change Password", ['class' => 'gray-button']) }}
		</span>
		<table>
        <tbody>
        @foreach($group->users as $user)
            <tr class="Collapsable">
                <td style='white-space: nowrap;'>{{ $user->name }}</td>
                <td>{{ link_to(URL::route('accountGet', array('intended' => Request::path(), 'edit' => $user->id)), "Update", ['class' => 'redlink']) }}</td>
                <td>{{ link_to(URL::route('deleteGet', array('intended' => Request::path(), 'delete' => $user->id)), "Delete", ['class' => 'redlink']) }}</td>
				@if($user->failedAttempts > 6)
					<td>{ link_to(URL::route('unlock', array('intended' => Request::path(), 'unlock' => $user->id)), "Unlock", ['class' => 'redlink']) }}</td>
				@endif
            </tr>
        @endforeach
        </tbody>
        </table>
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
    </div>
@stop