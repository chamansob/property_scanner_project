@props(['messages'])

@if ($messages)
    <span {{ $attributes->merge(['class' => 'error invalid-feedback']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
    </span>
    
@endif
