@extends('admin.layout')

@section('content')

<h2 class="page-header">Choose product category</h2>

{!! Form::open(['route' => 'admin.products.create', 'method' => 'GET']) !!}
    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
        {!! Form::label('category_id','Category') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

        @if($errors->has('category_id'))
            <p class="help-block">{{ $errors->first('category_id')}}</p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary btn-lg">Continue</button>
{!! Form::close() !!}

@stop