@extends('layouts.default')
@section('body')
<div class="center container" style="width: 350px; margin-left: -195px; height: 350px; margin-top: -195px; padding: 20px; text-align: left;">
	<p>Due to an abnormally high number of invalid login requests, the account you are trying to access has been locked.</p>
	<p>If this is your account, ask an administrator to unlock it for you.</p>
	{{ link_to($intended, 'back to previous page') }}
</div>
@stop