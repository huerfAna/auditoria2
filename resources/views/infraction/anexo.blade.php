@extends('templates.base')
@section('content')
	<div class="header-help">
	    <strong>Relación con Anexo22</strong>	  
	    <div class="medium-2" id="btn"></div>  
	    <i class="icon icon-cancel29 help-close"></i>
	</div>
	<div class="body-help">    
	  	{!! Form::open(['route' => ['anexo.store'], 'method' => 'POST']) !!}  
	    @foreach($anexo as $anx)  
	      	<div class="medium-8">
	     		<h3>{{ $anx->a22_name }}</h3>
	     	    <div class="medium-10">
		    		Infración: {!! Form::select('infractions_id',$infra,$anx->infractions_id) !!} 
	    		</div>		    		
		    </div>    			    		
	    @endforeach   		
	    {!! Form::submit('guardar') !!}
	    {!! Form::close() !!} 
	</div>
@extends('templates.base')
@section('content')