@extends('admin.layout')

@section('content')

<div class="clearfix">
    <a class="pull-right btn btn-success" href="{{ route('admin.attributes.create')}}"> + New attribute </a>
</div>
@foreach ($attributes as $attribute)
    <div class="clearfix">
        <h3><a href="{{ route('admin.attributes.edit', $attribute->id)}}"> {{ $attribute->code }}</a></h3>
        Label: {{ $attribute->label }}
        <div class="pull-right">
            <a class="btn btn-default" href="{{ route('admin.attributes.edit', $attribute->id)}}">
                Edit
            </a>
                {!! Form::open(['route' => ['admin.attributes.destroy', $attribute->id], 'method' => 'DELETE', 'style' => 'display:inline-block']) !!}
                    <button type="submit" class="btn btn-danger">Delete</button>
                {!! Form::close() !!}
            </form>

        </div>
    </div>
    <hr>
@endforeach

@stop