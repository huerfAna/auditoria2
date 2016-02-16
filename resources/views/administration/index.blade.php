@extends('templates.base')
@section('content')
<div class="container">
      <div class="panel">      
           {!! Form::open(['route' => ['administration.index'], 'method' => 'GET']) !!}  
           <div class="panel-body">
                  <div class="medium-3 columns">                  
                        {!! Form::label('Aduana-Patente-Pedimento') !!}
                  </div>
                  <div class="medium-8 columns">      
                       {!! Form::text('aduana',null) !!}                        
                       {!! Form::text('patente',null) !!}
                       {!! Form::text('pedimento',null) !!}                 
                  </div>
                  <div class="medium-3 columns">                        
                        {!! Form::label('Clave') !!} 
                  </div>
                  <div class="medium-3 columns">
                        {!! Form::select('clave',$claves) !!}               
                  </div><br><br>
                  <div class="medium-3 columns">
                        {!! Form::label('Tipo Operación') !!}
                  </div>
                  <div class="medium-3 columns">
                        {!! Form::select('operacion',[1 => 'Importación',2 => 'Exportación']) !!}
                  </div><br>
                  <div class="medium-3 columns">
                        {!! Form::label('Periodo') !!}
                  </div>
                  <div class="medium-3 columns">
                        {!! Form::select('anio', $fechas) !!}
                  </div><br>
                  <div class="medium-3 columns">
                        {!! Form::label('Mes') !!}
                  </div>
                  <div class="medium-3 columns">
                        {!! Form::selectMonth('mes',1) !!}
                  </div><br>
            </div>
            <div class="panel-footer">
                  <div class="medium-1 columns">
                  </div>
                  <div class="medium-3 columns">
                        {!! Form::submit('Buscar',['class' => 'btn-primary']) !!}                        
                  </div>                        
            </div> 
            {!! Form::close() !!}    
            <br>     
      </div>
      <div class="panel ">
            <div class="panel-body">
                  <table class="row">
                        <thead>
                              <td>Aduana</td>
                              <td>Patente</td>                        
                              <td>Pedimento</td>
                              <td>Tipo</td>
                              <td>Fecha Pago</td>
                              <td>Clave</td>
                              <td>GlosaSAT</td>
                              <td>Encabezado</td>
                              <td>Facturas</td>
                              <td>Partidas</td>
                              <td>Inventario</td>
                              <td>Inventario VS Partidas</td>                              
                              <td>A. Documental</td>                             
                        </thead>      
                        <tbody>
                        @foreach($auditoria as $aud)
                              <tr>
                                    <td>{{ $aud->pk_aduana}}</td>
                                    <td>{{ $aud->pk_patente}}</td>
                                    <td>{{ $aud->pk_pedimento}}</td>                              
                                    @if($aud->ref_tipo == 1)
                                          <td>IMPORTACION</td>
                                    @else
                                          <td>EXPORTACION</td>
                                    @endif
                                    <td>{{ $aud->ref_fechapago}}</td>
                                    <td>{{ $aud->ref_clave}}</td>
                                    @if ($aud->ref_sat <= 0)
                                          <td>0</td>
                                    @else
                                          <td>1</td>
                                    @endif
                                    @if (($aud->ref_sat - $aud->ref_preciopag) > 5 || $aud->ref_preciopag == 0)
                                          <td>0</td>
                                    @else
                                          <td>1</td>
                                    @endif
                                    @if (($aud->ref_partidas - $aud->ref_preciopag) > 5 || $aud->ref_facturas == 0)
                                          <td>0</td>
                                    @else
                                          <td>1</td>
                                    @endif
                                    @if (($aud->ref_partidas - $aud->ref_preciopag) > 5 || $aud->ref_partidas == 0)
                                          <td>0</td>
                                    @else
                                          <td>1</td>
                                    @endif
                                    @if (($aud->ref_inventario - $aud->ref_preciopag) > 5 || $aud->ref_inventario == 0)
                                          <td>0</td>
                                    @else
                                          <td>1</td>
                                    @endif
                                     @if ($aud->sec_status == 0)
                                          <td>0</td>
                                    @else
                                          <td>1</td>
                                    @endif        
                                    <?php $referencia = $aud->pk_aduana.'-'.$aud->pk_patente.'-'.$aud->pk_pedimento; ?>                                    
                                    <td><a href="{{ route('checklist.show',$referencia) }}"><i class="icon icon-notepad20"></i></a></td>
                                    
                                    
                              </tr>
                        @endforeach                  
                        </tbody>            
                  </table>   
            </div>
            <div class="panel-footer">
                  <div class="medium-12 columns">
                        {!!$auditoria->render()!!}
                  </div>
            </div>
      </div>
</div>  

 
      
</div>
@endsection