@extends('admin.layout')

@section('content')
    <h2 class="page-header">New attribute</h2>
    {!! Form::open(['route' => 'admin.attributes.store']) !!}
        <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
            {!! Form::label('model','Type') !!}
            {!! Form::select('model', array_flip($avaliable_models), null, ['class' => 'form-control']) !!}

            @if($errors->has('model'))
                <p class="help-block">{{ $errors->first('model')}}</p>
            @endif
        </div>

        @include('admin.attributes.common.form')

        <button type="submit" class="btn btn-primary btn-lg">Create attribute</button>
    {!! Form::close() !!}
@stop