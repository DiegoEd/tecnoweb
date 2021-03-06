@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear nuevo producto</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/products') }}" class="form-horizontal">

                        @include ('products.form', ['submitButtonText' => 'Registrar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
