@extends('layouts.default')
@section('head')

@stop
@section('body')
@parent
{{  Form::open()  }}
{{  Form::label('school', 'School: ')  }}
{{  Form::text('school', '', array())  }}
{{  Form::label('survey', 'Survey: ')  }}
{{  Form::text('survey', '', array())  }}
{{  Form::label('group', 'Group: ')  }}
{{  Form::text('group', '', array())  }}
<br>
<input type="submit" name="btn_insert" value="Insert" />
<input type="submit" name="btn_delete" value="Delete" />
{{  Form::close()  }}

@stop

