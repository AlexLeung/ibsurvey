@extends('layouts.default')
@section('body')
<div class="error">
Due to an abnormally high number of invalid login requests, 
<br>the account you are trying to access has been locked.
<br>
<br>If this is your account, ask an administrator to unlock it for you.
</div>
<br>
{{ link_to($intended, 'back to previous page') }}
@stop