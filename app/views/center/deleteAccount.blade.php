@extends('layouts.default')
@section('body')
	{{ Form::open(array('route' => array('deletePost', 'intended' => $intended, 'delete' => $user->id))) }}
	<div class="center container">
		<div class="item">
			Deleteing {{ $user->name }}<br>from the {{ $user->group->name }} group.
		</div>
		<div class="item">
			Your Password<br>
			{{ Form::password('password', '', array()) }}
		</div>
	@if($errors->has('password'))
		<div class="item error">
			{{ $errors->first('password') }}
		</div>
	@endif
		<div class="item">
			{{ Form::submit('Delete Account') }}	
		</div>
	</div>
	{{ Form::close() }}
	<script>
		var additionalHeight = 280;
		additionalHeight += <?php echo ($errors->count() * 40); ?>;
		margin =  10 + ((additionalHeight / 2) | 0);
		var fixedStyle = "width: 300px; margin-left: -170px; padding: 20px; ";
		$(".container").attr('style', fixedStyle+"height: "+additionalHeight+"px; margin-top: -"+margin+"px;");
	</script>
@stop