@extends('templates.base')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/md-date-time.css') }}">
@endsection

@section('content')
<h1>Para iniciar... <a class="target-help"><i class="icon icon-speechbubble34"></i></a></h1>       

@if(Session::get('error'))
    <p class="notification">
        <span class="target-close"><i class="icon icon-cancel29"></i></span>
        {{ Session::get('error')}}
    </p>
@endif    

<section>
    <div ng-app="testMod" ng-controller="testCtrl">
        
        <div class="row">
        {!! Form::open(['route' => 'parameters.store']) !!} 
            <input type="hidden" name="par_company" value="{{ Session::get('empresa') }}">                   
            <div class="medium-6 columns">
                <input type="hidden" name="par_first" value="@{{date | date:'yyyy-MM-dd'}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <time-date-picker ng-model="date" display-mode="date"></time-date-picker>
                    </div>
                </div>
            </div>

            <div class="medium-6 columns">
                <input type="hidden" name="par_finish" value="@{{datevalue | date:'yyyy-MM-dd'}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <time-date-picker ng-model="datevalue" display-mode="date"></time-date-picker>
                    </div>
                </div>
            </div>

            <div class="medium-12 columns">
                <div class="input-group checkbox">                    
                    <input type="checkbox" name="par_origin" id="secenet" value="1">
                    <label for="secenet">Cuento con SECENet</label>
                </div>
            </div>
            <div class="medium-12 columns">
                <button class="btn btn-primary">Guardar</button>
            </div>
        {!! Form::close() !!}                
        </div>

        @include('partials.datepicker')

    </div>   
</section>
@endsection

@section('help')
  @include('partials.help-welcome')
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0-beta.1/angular.min.js"></script>
<script src="{{ asset('js/js-date-time.js') }}"></script>
@endsection            