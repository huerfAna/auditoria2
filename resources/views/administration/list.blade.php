@extends('templates.base')

@section('content')
<div class="container">					
		{!! Form::open(['route' => ['checklist.update',$referen], 'method'=>'PATCH'])!!}
		<ul class="collection form">
		@foreach($document as $doc)	
		<li>
			<item-collection>
					<?php
        				$result = \DB::connection('users')->table('opauimg')->where('pk_referencia',$referen)->where('imgtipodoc',$doc->chk_document)->first();
        			?>
					<a href="">{{ $doc->doc_nombre }}</a>					
					{!! Form::hidden("id_$doc->id",$doc->chk_document) !!}
					<div class="medium-4 checkbox">                    
						@if($doc->chk_required != 1 && $result == '')
							<input type="checkbox" name="exp_digital_{{ $doc->id}}" id="exp_digital_{{ $doc->id}}" value="2">
	                    	<label for="exp_digital_{{ $doc->id}}">No se requiere</label>
						@endif				
        				@if($result != '')
        					<input type="checkbox" name="exp_digital_{{ $doc->id}}" id="exp_digital_{{ $doc->id}}" value="1" checked>
	                    	<label for="exp_digital_{{ $doc->id}}">Digital</label>
        					{{ $result->imgNameFile }}
        				@else        					
        					<input type="checkbox" name="exp_digital_{{ $doc->id}}" id="exp_digital_{{ $doc->id}}" value="1">
	                    	<label for="exp_digital_{{ $doc->id}}">Digital</label>
        					{!! Form::file('file') !!}
        				@endif
        			</div>
        			<div class="medium-4 checkbox">                    
						<input type="checkbox" name="exp_material_{{ $doc->id }}" id="exp_material_{{ $doc->id }}" value="1">
	                    <label for="exp_material_{{ $doc->id }}">Fisico</label>
					</div>
					<p></p>
			</item-collection>
		</li>
		@endforeach
		</ul>					
		{!! Form::submit('Guardar') !!}				
		{!! Form::close() !!}
	
</div>
@endsection
