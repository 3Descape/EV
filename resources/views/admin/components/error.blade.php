@if ($errors->has($name))
<div class="alert alert-danger" role="alert">
    {{ $errors->first($name) }}
</div>
@endif