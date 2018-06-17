@if ($errors->has($name))
    <ul class="alert alert-danger mt-2 {{isset($class)? $class: ''}}" role="alert">
        @foreach ($errors->get($name) as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif