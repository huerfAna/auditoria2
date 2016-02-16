@extends('templates.base')
@section('content')
<div class="container">
      @include('partials.notifications')
	<div class="medium-12">  
            <div class="medium-5 columns">            
                  <a href="{{ route('infraction.create') }}" class="btn btn-success">Nuevo</a>                  
                  <a href="{{ route('anexo.index') }}" class="btn btn-info">Anexo 22</a>       
                  <br>           
            </div>    
            <div class="medium-10 columns">                 
                  <table>
                        <thead>
                              <th class="medium-1">ID</th>
                              <th class="medium-3">INFRACCIÓN</th>
                              <th class="medium-3">SANCIÓN</th>
                              <th class="medium-2">MULTA</th>
                              <th class="medium-2"></th>
                        </thead>
                        <tbody>
                        @foreach($data as $inf)
                              <tr>
                                    <td class="medium-1">{{ $inf->id}}</td>
                                    <td class="medium-3">{{ $inf->inf_fundament}}</td>
                                    <td class="medium-3">{{ $inf->inf_sanfundament}}</td>
                                    @if($inf->inf_valmax > 0)
                                          <td class="medium-2">{{ $inf->inf_valmin }} a {{ $inf->inf_valmax}}</td>
                                    @elseif($inf->inf_fine == '')
                                          <td class="medium-2">NO MULTABLE</td>
                                          @else
                                          <td class="medium-2">{{ $inf->inf_fine }}</td>
                                    @endif
                                    <td class="medium-1">
                                          <a href="{{ route('infraction.edit',$inf->id) }}"><i class="icon icon-pencil8"> Modificar</i></a>                                          
                                    </td>
                                    <td class="medium-1">
                                          {!! Form::open(['method' => 'DELETE','route' => ['infraction.destroy', $inf->id]]) !!}
                                                {!! Form::button('<i class="icon icon-trash1">Eliminar</i>', array('style'=>'border:none','type'=>'submit')) !!}
                                          {!! Form::close() !!} 
                                    </td>
                              </tr>
                        @endforeach             
                        </tbody>               
                  </table>
            </div>
	</div>    
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/delete_field.js') }}"></script>
@endsection  