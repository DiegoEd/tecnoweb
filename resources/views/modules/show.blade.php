@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Module {{ $module->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/modules') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Cod</th><td>{{ $module->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nombre </th><td> {{ $module->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Descripcion </th><td> {{ $module->description }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @include('accions.index')
                </div>
            </div>
        </div>
    </div>
@endsection

