@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Producto #{{ $module->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/modules') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ url('/modules/'. $module->id) }}" class="form-horizontal">
                            <input type="hidden" name="_method" value="PATCH">

                        @include ('modules.form', ['submitButtonText' => 'Update'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

