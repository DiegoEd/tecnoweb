@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenido a la seccion de compras</div>
                    <div class="panel-body">
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Codigo</th><th>Fecha de compra</th><th>Total</th><th>Confirmada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($purchasesbills as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->purchasedate }}</td>
                                        <td>{{ $item->totalamount }}</td>
                                        <td>{{ $item->confirmed ? 'Si': 'No' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $purchasesbills->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
