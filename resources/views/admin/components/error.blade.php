@if ($errors->has($name))
    <div class="alert alert-danger {{isset($class)? $class: ''}}" role="alert">
        @foreach ($errors->get($name) as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif