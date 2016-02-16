@extends('templates.base')

@section('content')
<div class="container">
	<div class="medium-8 columns">
        {!! Form::open(['route' => ['infraction.store'], 'method' => 'POST','class'=>'form']) !!}  
            @include('partials.infraction')
		{!! Form::close() !!}

	</div>    


</div>

@endsection