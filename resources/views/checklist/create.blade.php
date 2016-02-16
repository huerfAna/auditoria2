@extends('templates.base')

@section('content')
	<div class="container">
		<div class="medium-8">
		{!! Form::open(['route' => ['checklist.store'], 'method'=>'POST','class'=>'form'])!!}
			
			{!! Form::hidden('chk_company',$company) !!}			
			<div class="medium-2 columns">
			{!! Form::label('Documento') !!}			
			</div>
			<div class="medium-10 columns">
		    {!! Form::select('chk_document',$documents) !!}	
		    </div>
		    <div class="medium-2 columns">
		    {!! Form::label('Operación') !!}
		    </div>
		    <div class="medium-10 columns">
		    {!! Form::select('chk_opera',[1 => 'Importación',2 => 'Exportación']) !!}
		    </div>
		    <div class="medium-2 columns">
		    {!! Form::label('Transporte') !!}
		   	</div>
		   	<div class="medium-10 columns">
		    {!! Form::select('chk_transport', $transport) !!}
		    </div>
		    <div class="medium-8 checkbox">                    
		   		<input type="checkbox" name="chk_required" id="requerido" value="1">
	         	<label for="requerido">Requerido</label>
		    </div>
		    <button type="submit" class="btn btn-danger round"><i class="icon icon-notepad20"></i></button>
		{!! Form::close() !!}
		</div>
		<br>
		<table>
			<thead>
				<th>Documento</th>
				<th>Operación</th>
				<th>Transporte E/S</th>
				<th>Requerido</th>	
				<th></th>		
			</thead>
			<tbody>
				@foreach($check as $chk)
				<tr>
					<td>{{ $chk->doc_nombre}}</td>
					@if($chk->chk_opera == 1)
					<td>IMP</td>
					@else
					<td>EXP</td>
					@endif
					<td>{{ $chk->tra_medio }}</td>
					@if($chk->chk_required == 1)
					<td>OK</td>
					@else
					<td></td>
					@endif
					<td>
						{!! Form::open(['method' => 'DELETE','route' => ['checklist.destroy', $chk->id]]) !!}
                            {!! Form::button('<i class="icon icon-trash1">Eliminar</i>', array('style'=>'border:none','type'=>'submit')) !!}
                        {!! Form::close() !!} 
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
@endsection
