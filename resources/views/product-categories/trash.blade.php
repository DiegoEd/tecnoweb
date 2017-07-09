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
                                        <th>Cod</th><th>Nombre</th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($productcategories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('/product-categories/restore/'. $item->id) }}" class="form-horizontal">
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