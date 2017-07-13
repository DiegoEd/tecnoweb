@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Compra</div>
                    <div class="panel-body">

                        <a href="{{ url('/purchases-bills/confirm/'. $purchasesbill->id) }}" title="Back"><button class="btn btn-warning btn-xs"><i  aria-hidden="true"></i> Confirmar</button></a>
                        <form method="POST" action="{{ url('/purchases-bills/'. $purchasesbill->id) }}" style="display:inline">
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
                                        <th>Codigo</th><td>{{ $purchasesbill->id }}</td>
                                    </tr>
                                    <tr><th> Fecha de compra </th><td> {{ $purchasesbill->purchasedate }} </td></tr><tr><th> Total </th><td> {{ $purchasesbill->totalamount }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    @include('purchases-bill-details.index')
                </div>
            </div>
        </div>
    </div>
@endsection
