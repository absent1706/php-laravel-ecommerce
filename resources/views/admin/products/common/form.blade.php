<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    {!! Form::label('category_id','Category') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

    @if($errors->has('category_id'))
        <p class="help-block">{{ $errors->first('category_id')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name','Name') !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}

    @if($errors->has('name'))
        <p class="help-block">{{ $errors->first('name')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('sku') ? 'has-error' : '' }}">
    {!! Form::label('sku','sku') !!}
    {!! Form::text('sku',null,['class' => 'form-control']) !!}

    @if($errors->has('sku'))
        <p class="help-block">{{ $errors->first('sku')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    {!! Form::label('price','price') !!}
    {!! Form::text('price',null,['class' => 'form-control']) !!}

    @if($errors->has('price'))
        <p class="help-block">{{ $errors->first('price')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('special_price') ? 'has-error' : '' }}">
    {!! Form::label('special_price','special_price') !!}
    {!! Form::text('special_price',null,['class' => 'form-control']) !!}

    @if($errors->has('special_price'))
        <p class="help-block">{{ $errors->first('special_price')}}</p>
    @endif
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {!! Form::label('description','description') !!}
    {!! Form::textarea('description',null,['class' => 'form-control', 'rows' => 3]) !!}
    @if($errors->has('description'))
        <p class="help-block">{{ $errors->first('description')}}</p>
    @endif
</div>