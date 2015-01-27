@extends('layouts.default')
<?php 
	$isAdmin = Auth::check() && Auth::user()->group->name == "Admin"; 
?>
@section('body')
{{ Form::open(array('route' => array('accountPost', 'intended' => $intended, 'id' => $user->id, 'isAdmin' => $isAdmin))) }}
<div class="container center">
	<div class="item">
		School: {{ Auth::user()->group->school->name }}
	</div>
@if($isAdmin)
	<div class="item">
		Group<br>
	@if(isset($user->group_id))
		{{ Form::text('group', $user->group->name , array()) }}
	@else
		{{ Form::text('group', '', array()) }}
	@endif
	@if($errors->has('group'))
		<div class="item error">
			{{ $errors->first('group') }}
		</div>
	@endif
@else
	<div class="item">
		Group: {{ $user->group->name }}
	</div>
@endif
	<div class="item">
		Name<br>
	@if($user->name != "Anonymous")
		{{ Form::text('name', $user->name, array()) }}
	@else
		{{ Form::text('name', '', array()) }}
	@endif
	</div>
@if($errors->has('name'))
	<div class="item error">
		{{ $errors->first('name') }}
	</div>
@endif
	<div class="item">
		Email<br>
	@if(isset($user->email))
		{{ Form::text('email', $user->email, array()) }}
	@else
		{{ Form::text('email', '', array()) }}
	@endif
	</div>
@if($errors->has('email'))
	<div class="error">
		{{ $errors->first('email') }}
	</div>
@endif
@if($user->name == "Anonymous")
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
		Retype The Password<br>
		{{ Form::password('rePass', '', array()) }}
	</div>
@if($errors->has('rePass'))
	<div class="error item">
		{{ $errors->first('rePass') }}
	</div>
@endif
@endif
@if($isAdmin || $user->name != "Anonymous")
	<br>
	<div class="item">
		Your Password<br>
		{{ Form::password('password', '', array()) }}
	</div>
@if($errors->has('password'))
	<div class="error item">
		{{ $errors->first('password') }}
	</div>
@endif
	<div class="item">
		{{ Form::submit('Update Account') }}
	</div>
@else
	<div class="item">
		{{ Form::submit('Create Account') }}
	</div>
@endif
</div>
{{ Form::close() }}
<script>
	var additionalHeight = 560;
	@if($isAdmin)
		additionalHeight += 20;
	@endif
	@if($user->name == "Anonymous")
		additionalHeight += 170;
	@endif
	additionalHeight += <?php echo ($errors->count() * 40); ?>;
	margin = (additionalHeight / 2) | 0;
	var fixedStyle = "width: 400px; margin-left: -200px;";
	$(".container").attr('style', fixedStyle+"height: "+additionalHeight+"px; margin-top: -"+margin+"px;");
</script>
@stop