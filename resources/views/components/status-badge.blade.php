@props(['status'])

@php
    $tone = $status->tone();
    $class = config("status.tones.$tone", 'bg-light text-dark');
@endphp

<span {{ $attributes->merge(['class' => "badge $class"]) }}>
    {{ $status->label() }}
</span>