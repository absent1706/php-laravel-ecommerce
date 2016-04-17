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
