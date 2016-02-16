@extends('templates.base')
@section('content')
<div class="container">
	@include('partials.notifications')		
	  	{!! Form::open(['route' => ['anexo.store'], 'method' => 'POST', 'class'=>'form']) !!}    	
	  		<button type="submit" class="btn btn-danger round"><i class="icon icon-diskette17"></i></button>
		    @foreach($anexo as $anx)  	      	
		    	<?php
		    		if($anx->a22_rectifiable == '1')
		    			$checked = 'checked';
		    		else
		    			$checked = '';
		    		if($anx->a22_fine == '1')
		    			$checked1 = 'checked';
		    		else
		    			$checked1 = '';

		    	?>
		     		<h3>{{ $anx->a22_name }}</h3>
		     	    <div class="medium-10 ">
		     	    	{!! Form::hidden('id_'.$anx->id,$anx->id) !!}
			    		Infración: {!! Form::select('inf_'.$anx->id,$infra,$anx->infractions_id) !!} 
			    		<div class="medium-8 checkbox">                    
	                    	<input type="checkbox" name="rect_{{ $anx->id}}" id="rect_{{ $anx->id}}" value="1" {{ $checked }}>
	                    	<label for="rect_{{ $anx->id}}">Rectificable</label>                 
		                    <input type="checkbox" name="mult_{{ $anx->id}}" id="mult_{{ $anx->id}}" value="1" {{ $checked1 }}>
	                    	<label for="mult_{{ $anx->id}}">Multable</label>
	                	</div>
		    		</div>		    				    
		    @endforeach   	  
	    {!! Form::close() !!}	
</div>
@endsection