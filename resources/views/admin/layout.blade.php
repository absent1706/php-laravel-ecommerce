<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}">
</head>
<body>
    <div class="col-md-8 col-md-offset-2">
        <h1 class="text-center">Admin Panel</h1>
        <a href="{{ route('admin.products.index')}}">Manage Products</a>
        |
        <a href="{{ route('admin.attributes.index')}}">Manage Attributes</a>
        <hr>

        @include('common.flash-and-errors')
        @yield('content')
    </div>
</body>
</html>