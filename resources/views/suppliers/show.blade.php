@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Supplier {{ $suppliers->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/suppliers') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/suppliers/' . $suppliers->id . '/edit') }}" title="Edit Supplier"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/suppliers/'. $suppliers->id) }}" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Supplier" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $suppliers->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $suppliers->name }} </td></tr><tr><th> Correo </th><td> {{ $suppliers->email }} </td></tr><tr><th> Telefono </th><td> {{ $suppliers->telephone }} </td></tr><tr><th> Direccion </th><td> {{ $suppliers->address }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
