@props(['key', 'status', 'config', 'mock' => true])

@php
    $isOn = $status == 1;
    $label = $isOn ? $config['label_on'] : $config['label_off'];
    $btnClass = $isOn ? 'btn-danger' : 'btn-success';

    $url = $mock ? '#' : route($config['route_name']);
@endphp

<a href="{{ $url }}" class="btn {{ $btnClass }}" data-key="{{ $key }}"
    data-status="{{ $status }}" data-label-on="{{ $config['label_on'] }}" data-label-off="{{ $config['label_off'] }}"
    data-icon="{{ $config['icon'] }}" @if ($mock) onclick="toggleMock(this); return false;" @endif>
    <i class="fa {{ $config['icon'] }}"></i>
    <span class="mx-2">{{ $label }}</span>
</a>
