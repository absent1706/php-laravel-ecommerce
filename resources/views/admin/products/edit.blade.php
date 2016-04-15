@extends('admin.layout')

@section('content')
    <h2 class="page-header">Edit product</h2>
    {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'PUT']) !!}
        @include('admin.products.common.form')
        <button type="submit" class="btn btn-primary btn-lg">Update product</button>
    {!! Form::close() !!}
@stop