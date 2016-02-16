      <h3>Infracción</h3>
      <div class="medium-8">
            {!! Form::label('Fundamento') !!}
      </div>
      <div class="medium-8">
            {!! Form::textarea('inf_fundament',null,['rows' => 2]) !!}  
      </div>
      <div class="medium-8">
            {!! Form::label('Descripción') !!}
      </div>
      <div class="medium-8">
            {!! Form::textarea('inf_description',null,['rows' => 2]) !!}  
      </div>      
       <br>
      <h3>Sanción</h3>
      <div class="medium-8">      
            {!! Form::label('Fundamento') !!}            
      </div>
      <div class="medium-8">
            {!! Form::textarea('inf_sanfundament',null,['rows' => 2]) !!}
      </div>
      <div class="medium-8">
            {!! Form::label('Tipo Multa') !!}
            {!! Form::select('tfine_id', $multas, null) !!}            
      </div>
      <div class="medium-8">
            {!! Form::label('Multa') !!}
      </div>
      <div class="medium-8">
            {!! Form::textarea('inf_fine',null,['rows' => 2]) !!}
      </div>
      <div class="medium-8">
            {!! Form::label('Valor Multa') !!}
      </div>
      <div class="medium-10 columns">
            $ {!! Form::text('inf_valmin',null) !!} A $ {!! Form::text('inf_valmax',null) !!}
      </div>
      
      <div class="medium-8">
            {!! Form::submit('Guardar') !!}
      </div>