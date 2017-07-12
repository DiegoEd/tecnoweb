@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New PurchasesBillDetail</div>
                    <div class="panel-body">
                        <a href="{{ url('/purchases-bill-details') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/purchases-bill-details') }}" class="form-horizontal">

                        @include ('purchases-bill-details.form', ['submitButtonText' => 'Registrar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
