@extends('admin.layout')

@section('content')
    <h2 class="page-header">Edit attribute</h2>
    {!! Form::model($attribute, ['route' => ['admin.attributes.update', $attribute->id], 'method' => 'PUT']) !!}
        @include('admin.attributes.common.form')
        <button type="submit" class="btn btn-primary btn-lg">Update attribute</button>
    {!! Form::close() !!}
@stop