@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Venta {{ $salesbill->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/sales-bills/confirm/'. $salesbill->id) }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Confirmar</button></a>
                        <form method="POST" action="{{ url('/sales-bills/'. $salesbill->id) }}" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete Supplier" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Cancelar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Cod</th><td>{{ $salesbill->id }}</td>
                                    </tr>
                                    <tr><th> Fecha de venta</th><td> {{ $salesbill->salesdate }} </td></tr><tr><th> Total </th><td> {{ $salesbill->totalamount }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    @include('sale-bill-details.index')
                </div>
            </div>
        </div>
    </div>
@endsection
