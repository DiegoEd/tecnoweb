@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Role {{ $role->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/roles/index/signups') }}" title="Back">
                        <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
                        </a>
                        <form method="POST" action="{{ url('/roles/commituser/') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        @if(count($users)>0)
                            <div class="form-group">
                                <label name="check" class="col-md-4 control-label">Usuarios</label>
                                <div class="col-md-4">
                                    @foreach ($users as $user)
                                        <input type="checkbox" name="users[]" id="{{$user->id}}" value="{{$user->id}}" {{$user->inrole($role->id)}} ><label for="{{$user->id}}">{{$user->username}}</label>
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
                                <label class="control-label">Ningun usaurio registrado en el sistema</label>
                        @endif

                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection