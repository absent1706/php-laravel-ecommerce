@extends('admin.layout')

@section('content')
    <h2 class="page-header">Edit attribute</h2>
    {!! Form::model($attribute, ['route' => ['admin.attributes.update', $attribute->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            <label>
                Type
            </label>
            <div>
                {{ array_flip($avaliable_models)[$attribute->model] }}
            </div>
        </div>

        @include('admin.attributes.common.form')
        <button type="submit" class="btn btn-primary btn-lg">Update attribute</button>
    {!! Form::close() !!}
@stop