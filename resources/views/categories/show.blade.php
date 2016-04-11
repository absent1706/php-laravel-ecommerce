@extends('layout')

@section('content')
<div class="row">
  <ol class="breadcrumb">
      <li><a href="{{ route('categories.index') }}">Home</a></li>
      <li class="active">{{ $category->name }}</li>
  </ol>
</div>
<div class="row">
    <div class="col-md-4">
        <legend>Filters</legend>
        <form id="category-filter-form" action="{{ route('categories.show', $category->id) }}">

            <!-- TODO: not use '_' but '-' in GET params -->
            <!-- TODO: filter by common attributes (not only by EAV, but by price, qty etc) -->
            @foreach ($category->attributes as $attribute)
                <p>
                    <b>{{ $attribute->label }}</b>
                    {!! $attribute->getFilterHtml(isset($filters[$attribute->code]) ? $filters[$attribute->code] : []) !!}
                </p>
                <hr>
            @endforeach

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Apply filters</button>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        @include('products/partials/list', ['products' => $products])
    </div>
</div>

<script type="text/javascript">
    // TODO: send form with JS. It's needed to prevent sending empty fields
</script>
@stop