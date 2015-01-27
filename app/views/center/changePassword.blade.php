@extends('layouts.default')
@section('body')
	{{ Form::open(array('route' => array('passwordPost', 'intended' => $intended, 'groupId' => !$group ? -1 : $group->id))) }}
	<div class="container center">
	@if(!is_null($group))
		<div class="item">
			changing the {{ $group->name }} group's password
		</div>
	@endif
		<div class="item">
			New Password<br>
			{{ Form::password('newPass', '', array()) }}
		</div>
	@if($errors->has('newPass'))
		<div class="item error">
			{{ $errors->first('newPass') }}
		</div>
	@endif
		<div class="item">
			Re-type Password<br>
			{{ Form::password('rePass', '', array()) }}
		</div>
	@if($errors->has('rePass'))
		<div class="item error">
			{{ $errors->first('rePass') }}
		</div>
	@endif
	@if(!is_null($group))
		<div class="item">
			Current Group Password<br>
			{{ Form::password('groupPassword', '', array()) }}
		</div>
		@if($errors->has('groupPassword'))
			<div class="item error">
				{{ $errors->first('groupPassword') }}
			</div>
		@endif
		<br>
		<div class="item">
			Your Password<br>
	@else
		<br>
		<div class="item">
			Your Current Password<br>
	@endif
			{{ Form::password('password', '', array()) }}
		</div>
	@if($errors->has('password'))
		<div class="item error">
			{{ $errors->first('password') }}
		</div>
	@elseif($errors->has('passwordError'))
		<div class="item error">
			{{ $errors->first('passwordError') }}
		</div>
	@endif
		<div class="item">
			{{ Form::submit('Change Password') }}
		</div>
	</div>
	{{ Form::close() }}
	<script>
		var additionalHeight = 440;
		@if(!is_null($group))
			additionalHeight += 150;
		@endif
		additionalHeight += <?php echo ($errors->count() * 40); ?>;
		margin = (additionalHeight / 2) | 0;
		$(".container").attr('style', 'height: '+additionalHeight+'px; margin-top: -'+margin+'px; width: 350px; margin-left: -175px;');
	</script>
@stop