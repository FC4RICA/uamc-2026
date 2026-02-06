@props([
    'title',
    'value',
    'total',
    'icon',
    'color' => 'primary',
    'class' => '',
])

<div class="card h-100 {{ $class }}">
    <div class="card-body d-flex">
        @if (! empty($icon))
            <div class="me-3">
                <div class="ratio ratio-1x1 bg-{{ $color }} bg-opacity-10 rounded-circle p-4">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fa {{ $icon }} text-{{ $color }}"></i>
                    </div>
                </div>
            </div>
        @endif

        <div>
            <h6 class="text-muted fw-bold mb-1 opacity-75">{{ $title }}</h6>
            <h3 class="mb-0 fw-bold">
                {{ number_format($value) }}
                @if (! empty($total))
                    <small class="text-muted"> / {{ number_format($total) }}</small>
                @endif
            </h3>
        </div>
    </div>
</div>