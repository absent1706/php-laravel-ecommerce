@extends('admin.layout')

@section('content')

<div class="clearfix">
    <a class="pull-right btn btn-success" href="{{ route('admin.products.create')}}"> + New product </a>
</div>
@foreach ($products as $product)
    <div class="clearfix">
        <h2><a href="{{ route('admin.products.edit', $product->id)}}"> {{ $product->name }}</a></h2>
        <h3>${{ $product->price }}</h3>
        <div class="pull-right">
            <a class="btn btn-default" href="{{ route('admin.products.edit', $product->id)}}">
                Edit
            </a>
                {!! Form::open(['route' => ['admin.products.destroy', $product->id], 'method' => 'DELETE', 'style' => 'display:inline-block']) !!}
                <button type="submit" class="btn btn-danger">Delete</button>
                {!! Form::close() !!}
            </form>

        </div>
    </div>
    <hr>
@endforeach

@stop