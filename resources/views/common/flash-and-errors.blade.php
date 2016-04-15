@if(session()->has('message'))
    <div class="alert alert-{{ session('message_class', 'success') }}" role="alert">{{ session('message') }}</div>
@endif

<!-- display errors not attached to any form field -->
@if($errors->any())
    @foreach($errors->getMessages() as $field => $errors)
        @if(is_int($field))
            @foreach($errors as $error)
                <div class="alert alert-danger" role="alert">{{ $error }}</div>
            @endforeach
        @endif
    @endforeach
@endif