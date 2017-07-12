@extends('layouts.app')
@section('content')
@if (empty(session('id')))
@include('layouts.out')
@else
@include('layouts.in')
@endif
@endsection