@extends('layout')

@section('content')

<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('categories.index') }}">Home</a></li>
        <li><a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}</a></li>
        <li class="active">{{ $product->name }}</li>
    </ol>
</div>

<div class="row">

    <h2>{{ $product->name }}</h2>
    <h4>${{ $product->price }}</h4>
    <p>
        SKU: {{ $product->sku }}
    </p>
    <p>
        <button type="button" class="btn btn-primary">Buy</button>
    </p>

    @foreach ($product->category_attributes as $attribute)
        <p>
            <b>{{ $attribute->label }}</b>:

            @if ($attribute->isCollection())
                @foreach ($product->getDisplayContent($attribute->code) as $value)
                    {{ $value }},
                @endforeach
            @else
                {{ $product->getDisplayContent($attribute->code) }}
            @endif
        </p>
    @endforeach

    <p></p>
    <div class="well">
        {{ $product->description }}
    </div>
</div>
@stop