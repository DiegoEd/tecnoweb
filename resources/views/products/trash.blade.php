@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading"> Papelera de productos</div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Cod</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('/products/restore/'. $item->id) }}" class="form-horizontal">
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