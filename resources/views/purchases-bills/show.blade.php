@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">PurchasesBill {{ $purchasesbill->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/purchases-bills') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/purchases-bills/' . $purchasesbill->id . '/edit') }}" title="Edit PurchasesBill"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/purchases-bills/'. $purchasesbill->id) }}" style="display:inline">
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
                                        <th>ID</th><td>{{ $purchasesbill->id }}</td>
                                    </tr>
                                    <tr><th> Purchasedate </th><td> {{ $purchasesbill->purchasedate }} </td></tr><tr><th> Totalamount </th><td> {{ $purchasesbill->totalamount }} </td></tr>
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
