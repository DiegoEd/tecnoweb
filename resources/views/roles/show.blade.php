@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Role {{ $role->role }}</div>
                    <div class="panel-body">



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
