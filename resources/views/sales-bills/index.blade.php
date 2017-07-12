@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenido a la seccion de ventas</div>
                    <div class="panel-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/sales-bills', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Codigo</th><th>Fecha de venta</th><th>Total</th><th>Confirmada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($salesbills as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->salesdate }}</td>
                                        <td>{{ $item->totalamount }}</td>
                                        <td>{{ $item->confirmed ? 'Si': 'No' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $salesbills->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
