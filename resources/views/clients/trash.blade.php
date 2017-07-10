@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"> Clientes de baja</div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Cod</th><th>Nombre</th><th>Nit</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name  }} </td>
                                        <td>{{ $item->nit }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('/clients/restore/'. $item->id) }}" class="form-horizontal">
                                                <input type="hidden" name="_method" value="PATCH">
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-primary">Restaurar</button>
                                            </form>
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