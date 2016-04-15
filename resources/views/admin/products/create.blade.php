@extends('admin.layout')

@section('content')
    <h2 class="page-header">New product</h2>
    {!! Form::open(['route' => 'admin.products.store']) !!}
        @include('admin.products.common.form')
        <button type="submit" class="btn btn-primary btn-lg">Create product</button>
    {!! Form::close() !!}
@stop