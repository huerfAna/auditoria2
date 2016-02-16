@extends('templates.base')

@section('content')
	<div class="panel">
		<p class="notification notification-success">Ahora puedes iniciar tu auditoria<span class="target-close"><i class="icon icon-cancel29"></i></span></p>
		<div class="panel-body">
			<p><strong>Fecha Inicial: </strong>{{ $data['par_first'] }}</p>
		    <p><strong>Fecha Final: </strong>{{ $data['par_finish'] }}</p>
		   	<p>
		   	La información se obtendra de: 
		   	@if(isset($data['par_origin']))
		   	<strong>SECENET</strong>

		   	@else
		   	<strong>DATASTAGE</strong>
		   	</p>
		   	<p class="paragraph">
		   		<input type="file">	
		   		<input type="submit">
		   	</p>		   	
		   @endif		   
		</div>	
	</div>   
@endsection
@section('help')
    @include('partials.help-results')
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="{{ asset('js/delete_field.js') }}"></script>
@endsection  