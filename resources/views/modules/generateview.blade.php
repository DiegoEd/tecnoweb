@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Modulo</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Permisos</th><th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accions as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td> 
                                                <a href="{{ url($item->pageroute) }}" class="btn btn-success btn-sm" title="Go to">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Ir a la accion
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
