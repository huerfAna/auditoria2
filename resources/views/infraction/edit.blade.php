@extends('templates.base')

@section('content')
<div class="container">
	<div class="medium-8 columns">
        {!! Form::model($infraccion, ['route' => ['infraction.update', $infraccion->id], 'method' => 'PATCH','class'=>'form']) !!}  
            @include('partials.infraction')
		{!! Form::close() !!}
	</div>    
</div>
@endsection
