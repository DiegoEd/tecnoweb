@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Modulo  {{ $module->name }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/roles') }}" title="Back">
                        <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
                        </a>
                        <form method="POST" action="{{ url('/roles/commituser/') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        @if(count($accions)>0)
                            <div class="form-group">
                                <label name="check" class="col-md-4 control-label">Acciones</label>
                                <div class="col-md-4">
                                    @foreach ($accions as $accion)
                                        <input type="checkbox" name="accions[]" id="{{$accion->id}}" value="{{$accion->id}}" {{$accion->inrole($role->id)}} ><label for="{{$user->id}}">{{$user->username}}</label>
                                        <br/>
                                    @endforeach

                                </div>
                            </div>
                            <input type="hidden" name="id" id="{{$role->id}}" value="{{$role->id}}" >
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                </div>
                            </div>
                        @else
                                <label class="control-label">El modulo no tiene ninguna acción</label>
                        @endif

                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection