@extends('templates.base')

@section('content')
<div class="container">
	<div class="medium-8">
        {!! Form::open(['route' => 'validation.store', 'id' => 'form'])!!}
            <div class="medium-4">
                {!! Form::label('Campo ') !!}                
            </div>
            <div class="medium-6">
                {!! Form::select('anexo22_id', $campos, session('id'),['id' => 'anx']) !!}
            </div>
            <div class="medium-4">
                {!! Form::label('Atributo') !!}
            </div>
            <div class="medium-6">
                {!! Form::select('attribute_id', $atributo, null,['id' => 'attr']) !!}     
                {!! Form::hidden('val_data',null,['id' => 'data']) !!}
            </div>
                <div class="panel">
                    <div class="panel-body">
                        <strong>Crea tu validacion</strong>                        
                        <br>
                        {!! Form::textarea('val_description',null,['rows' => 2,'placeholder'=>'Descripción']) !!}                
                        <div id="data_1" class="medium-4"></div>
                        <div id="data_2" class="medium-4"></div>                        
                        <div id="data_3" class="medium-6"></div>                                         
                        <div class="medium-8">
                             {!! Form::button('Agregar',['id' => 'button','class'=>'btn btn-success']) !!}                    
                        </div>
                    </div>
                </div>                
        {!! Form::close() !!}
    </div>
    <div id="table" class="medium-4"></div>   
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="{{ asset('js/validations.js') }}"></script>
@endsection  