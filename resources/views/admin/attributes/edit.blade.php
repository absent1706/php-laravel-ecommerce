@extends('admin.layout')

@section('content')
    <h2 class="page-header">Edit attribute</h2>
    {!! Form::model($attribute, ['route' => ['admin.attributes.update', $attribute->id], 'method' => 'PUT']) !!}
        <div class="form-group">
            <label>
                Type
            </label>
            <div>
                {{ array_flip($avaliable_models)[$attribute->model] }}
            </div>
        </div>

        @include('admin.attributes.common.form')

        @if($attribute->isSelectable())
            <legend>Options</legend>
            <div class="options-container">
                <ul class="list-unstyled" data-bind='foreach: options'>
                    <li>
                        <input type="text"  data-bind="value: label, attr:{name: id!='' ? 'options['+id+']' : 'new_options[]'}" />
                        <a href='#' data-bind='click: $root.removeOption'>Delete</a>
                    </li>
                </ul>
                <button type="button" data-bind='click: addOption'>Add option</button>
            </div>

            <script src="{{ url('js/knockout-3.4.0.js') }}"></script>
            <script>
                var OptionModel = function(options) {
                    var self = this;
                    self.options = ko.observableArray(options);

                    self.addOption = function() {
                        self.options.push({
                            id: "",
                            label: ""
                        });
                    };

                    self.removeOption = function(option) {
                        self.options.remove(option);
                    };
                };

                var viewModel = new OptionModel([
                    @foreach($attribute->options as $option)
                        {
                            id:     {{ $option->id }},
                            label: '{{ $option->label }}'
                        },
                    @endforeach
                ]);
                ko.applyBindings(viewModel, document.getElementById('options-container'));
            </script>
        @endif


        <button type="submit" class="btn btn-primary btn-lg">Update attribute</button>
    {!! Form::close() !!}


@stop

