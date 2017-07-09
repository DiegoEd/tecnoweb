@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Customize {{ $customize->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/customizes') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/customizes/' . $customize->id . '/edit') }}" title="Edit Customize"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <form method="POST" action="{{ url('/customizes/'. $customizes->id) }}" style="display:inline">
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
                                        <th>ID</th><td>{{ $customize->id }}</td>
                                    </tr>
                                    <tr><th> Color </th><td> {{ $customize->color }} </td></tr><tr><th> Font </th><td> {{ $customize->font }} </td></tr><tr><th> Imagepath </th><td> {{ $customize->imagepath }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
