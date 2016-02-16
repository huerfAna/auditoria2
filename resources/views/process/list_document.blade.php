@extends('templates.base')

@section('content')
		<ul class="collection">
			@foreach($document as $doc)	
			<li class="">
				<item-collection>
					<?php
        				$result = \DB::connection('users')->table('opauimg')->where('pk_referencia',$referen)->where('imgtipodoc',$doc->chk_document)->first();
        			?>
					<a href="">{{ $doc->chk_document }}</a>					
					<p>		
						@if($doc->chk_required != 1 && $result == '')
							{!! Form::checkbox('exp_status'.$doc->id, 0, false) !!}No se requiere<br>
						@endif				
        				@if($result != '')
        					{!! Form::checkbox('exp_status'.$doc->id, 1, true) !!}Digital
        					{{ $result->imgNameFile }}
        				@else
        					{!! Form::checkbox('exp_status'.$doc->id, 0, false) !!}Digital
        					{!! Form::file('file') !!}
        				@endif
        				<br>
						{!! Form::checkbox('exp_status'.$doc->id, '0') !!}Fisico<br>
						
					</p>
					<p></p>
				</item-collection>
			</li>
			@endforeach
		</ul>	
		{!! Form::open(['route' => ['expedientes.update',$referen], 'method'=>'PATCH', 'id' => 'form'])!!}
		
		{!! Form::submit('Guardar') !!}				
		{!! Form::close() !!}
	
@endsection
