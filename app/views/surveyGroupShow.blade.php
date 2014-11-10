@extends('layouts.default')
@section('head')
<script type="text/javascript">
<!--
function determineBrowser() {
	
	navigator.sayswho= (function(){
	    var ua= navigator.userAgent, tem, 
	    M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
	    if(/trident/i.test(M[1])){
	        tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
	        return 'IE';
	    }
	    if(M[1]=== 'Chrome'){
	        tem= ua.match(/\bOPR\/(\d+)/)
	        if(tem!= null) return 'Opera '+tem[1];
	    }
	    return M[1];
	})();
	
	document.getElementById("tableColumn").className = navigator.sayswho;
}
//-->
</script>
{{ HTML::style('files/css/table.css') }}
@stop
@section('body')
	@parent
	@if(!isset($state))
		{{ Form::open(array('method' => 'get')) }}
		{{ Form::label('password', 'Password: ') }}
		{{ Form::password('password', '', array()) }}
		{{ Form::input('submit', 'passwordSubmit', 'Go To Survey') }}
		@if(isset($error))
			<br>
			<div class="error">
				{{ $error }}
			</div>
		@endif
	@elseif($state == "error")
		<div class="error">
			{{ $error }}
		</div>
	@elseif($state == "options")
		Before you proceed to the survey, would you like to:
		<br>
		{{ Form::open(array('method' => 'put')) }}
		{{ Form::input('submit', 'createAccount', 'Create Full Profile') }}
		 or 
		{{ Form::input('submit', 'anonymous', 'Remain Anonymous') }}
		{{ Form::close() }}
		<br>
		(Completing your survey while signed into a full profile allows you to save progress on your survey, then come back to it later via the "Log in" link.)
	@elseif($state == "survey")
		{{ $message }}
		<br>
		You must submit your answers before {{ $closeTime }}, when this survey closes (Save your progress frequently!).
		<div id="tableColumn">
		<script type="text/javascript">determineBrowser();</script>
		{{ Form::open() }}
		<br>
		<h3>Complete this table by grading each aspect on a scale from 1 to 5 (5 meaning implemented very well).</h3>
		<table class="mainEvaluation">
		<tbody>
		<?php
			include app_path().'/Views/tableTop.html'; 
			$questionNumber = 0; 
		?>
		@foreach($questionStore as $question)
			@if(in_array($groupName, $question[1]))
				<?php ++$questionNumber; ?>
				<tr><td><table><tbody><tr>
				<td class="tableMark"><p>{{ "$questionNumber."}}</p></td>
				<td class="questionText"><p>{{ $question[3] }}</p></td>
				</tr></tbody></table></td>
				<td><table><tbody><tr class="tableColumnRadios">
				@for ($i = 0; $i < 5; ++$i)
					<td><input type="radio" name="{{$question[2]}}" id="{{$question[2]}}#{{$i}}" value="{{$i}}"
					@if(isset($answers[$question[2]]) && $answers[$question[2]] == "$i")
					checked
					@endif
					>
					<label for="{{$question[2]}}#{{$i}}">
					<div><div></div></div></label></td>
				@endfor
				</tr></tbody></table></td></tr>
			@endif
		@endforeach
		</tbody>
		</table>
		{{ Form::submit('Save/Submit Answers') }}
		{{ Form::close() }}
		</div>
	@endif
@stop