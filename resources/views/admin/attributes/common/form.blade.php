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


<div class="form-group {{ $errors->has('category_ids') ? 'has-error' : '' }}">
    {!! Form::label('category_ids','Use in categories') !!}

    {!! Form::select('category_ids[]',$all_categories->all(), isset($attribute) ? $attribute->category_ids() : null,['class' => 'form-control', 'multiple']) !!}

    @if($errors->has('category_ids'))
        <p class="help-block">{{ $errors->first('category_ids')}}</p>
    @endif
</div>
