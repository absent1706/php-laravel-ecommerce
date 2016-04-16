@extends('admin.layout')

@section('content')
    <h2 class="page-header">New attribute</h2>
    {!! Form::open(['route' => 'admin.attributes.store']) !!}
        @include('admin.attributes.common.form')
        <button type="submit" class="btn btn-primary btn-lg">Create attribute</button>
    {!! Form::close() !!}
@stop