@if ($errors->has($title))
    <span class="help-block">
        <strong>{{ $errors->first($title) }}</strong>
    </span> 
@endif
