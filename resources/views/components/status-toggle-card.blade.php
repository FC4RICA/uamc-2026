@props([
    'label',
    'enabled' => false,
    'action',
    'onText' => 'ปิด',
    'offText' => 'เปิด',
])

<div class="card h-100">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div class="fw-semibold">
            {{ $label }}
        </div>

        <div class="d-flex align-items-center gap-4">
            <span class="badge {{ $enabled ? 'text-success' : 'text-secondary' }}">
                <i class="fa fa-circle"></i> {{ $enabled ? 'ON' : 'OFF' }}
            </span>

            <form method="POST" action="{{ $action }}">
                @csrf
                <button
                    type="submit" onclick="this.disabled=true;"
                    class="btn {{ $enabled ? 'btn-outline-danger' : 'btn-outline-success' }}"
                >
                    {{ $enabled ? $onText : $offText }}
                </button>
            </form>
        </div>

    </div>
</div>