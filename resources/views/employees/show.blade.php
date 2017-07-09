@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Employee {{ $employees->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/employees') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/employees/' . $employees->id . '/edit') }}" title="Edit Employee"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/employees/'. $employees->id) }}" style="display:inline">
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
                                        <th>ID</th><td>{{ $employees->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $employees->name }} </td></tr><tr><th> Lastname </th><td> {{ $employees->lastname }} </td></tr><tr><th> Sexo </th><td> {{ $employees->sex }} </td></tr><tr><th> Edad </th><td> {{ $employees->age }} </td></tr><tr><th> Carrera </th><td> {{ $employees->career }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
