<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
    {!! Form::label('code','Code') !!}
    {!! Form::text('code',null,['class' => 'form-control']) !!}

    @if($errors->has('code'))
        <p class="help-block">{{ $errors->first('code')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
    {!! Form::label('label','Label') !!}
    {!! Form::text('label',null,['class' => 'form-control']) !!}

    @if($errors->has('label'))
        <p class="help-block">{{ $errors->first('label')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('collection') ? 'has-error' : '' }}">
    {!! Form::label('collection','Can have multiple values') !!}
    &nbsp;
    {!! Form::checkbox('collection', true, $attribute->collection) !!}

    @if($errors->has('collection'))
        <p class="help-block">{{ $errors->first('collection')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('optionable') ? 'has-error' : '' }}">
    {!! Form::label('optionable','Has options') !!}
    &nbsp;
    {!! Form::checkbox('optionable', true, $attribute->optionable) !!}

    @if($errors->has('optionable'))
        <p class="help-block">{{ $errors->first('optionable')}}</p>
    @endif
</div>

<hr>

{!! Form::label('Categories') !!}
@foreach ($attribute->categories as $category)
    <p>
        {{ $category->name }}
    </p>
@endforeach