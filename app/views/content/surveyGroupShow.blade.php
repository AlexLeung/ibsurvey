@extends('layouts.content')
@section('head')
@parent
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
@section('content')
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
		You must submit your answers before {{ $closeTime }}
		<script type="text/javascript">determineBrowser();</script>
		{{ Form::open() }}
		<br>
		<h3>Grade each aspect on a scale from 1 to 5<br>(5 meaning implemented very well)</h3>
		<table class="mainEvaluation">
		<tbody>
		<?php
			include app_path().'/views/components/tableTop.html'; 
			$questionNumber = 0; 
		?>
		@foreach($questionStore as $question)
			@if(in_array($groupName, $question[1]))
				<?php ++$questionNumber; ?>
				<tr><td><table><tbody><tr>
				<td class="tableMark"><p>{{ "$questionNumber."}}</p></td>
				<td class="questionText"><p>{{ $question[3] }}</p></td>
				</tr></tbody></table></td>
				<td class="radioCell"><table><tbody><tr class="tableColumnRadios">
				@for ($i = 0; $i < 5; ++$i)
					<?php $checked = isset($answers[$question[2]]) && $answers[$question[2]] == "$i"; ?>
					<td class="checkable <?php if($checked)echo "checked"; ?>">
						<input type="radio" name="{{$question[2]}}" id="{{$question[2]}}#{{$i}}" value="{{$i}}" <?php if($checked)echo 'checked'; ?>>
					</td>
				@endfor
				</tr></tbody></table></td></tr>
		@endif
		@endforeach
		</tbody>
		</table>
		{{ Form::submit('Save/Submit Answers') }}
		{{ Form::close() }}
		<script>
		$(window).load(function() {
			$(".radioCell > table").each(function() {
				$(this).css('height', ($(this).parent().outerHeight()-2)+"px");
			});
		});
		$(".checkable").click(function() {
			$(this).parent().children().removeClass('checked');
			$(this).addClass('checked');
			$(this).find('input').prop('checked', true);
		});
		</script>
	@endif
@stop