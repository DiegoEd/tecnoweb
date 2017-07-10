@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Role {{ $role->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/roles') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/roles/' . $role->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/roles/'. $role->id) }}" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Role" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $role->id }}</td>
                                    </tr>
                                    <tr><th> Role </th><td> {{ $role->role }} </td></tr><tr><th> Description </th><td> {{ $role->description }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                        @foreach($accions as $accion)
                             <li>Accion llamada:  <strong>{{ $accion->name }}</strong>, del modulo: <strong>{{ $accion->module->name }}</strong></li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
