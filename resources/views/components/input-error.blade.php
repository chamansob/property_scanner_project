@props(['messages'])

@if ($messages)
    <label {{ $attributes->merge(['class' => 'error invalid-feedback']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
    </label>
    
@endif
