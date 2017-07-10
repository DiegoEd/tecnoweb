@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Accion #{{ $accion->id }}</div>
                    <div class="panel-body">
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/accions/'. $accion->id) }}" class="form-horizontal">
                            <input type="hidden" name="_method" value="PATCH">

                        @include ('accions.form', ['submitButtonText' => 'Update'])
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
