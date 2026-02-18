@props([
    'payment',
])

<a href="{{ route('member.payment.download', $payment) }}" class="card text-decoration-none">
    <div class="card-body p-2 d-flex align-items-center">
        <i class="fa fa-file-image ms-1 me-3 fs-2 text-secondary"></i>
        <div>
            <div>
                <small class="fs-6">
                    {{ $payment->original_file_name }}
                </small>
            </div>
            <div class="text-muted" style="font-size:0.8rem">
                {{ $payment->created_at->format('j M g:i A') }}
            </div>
        </div>
    </div>
</a>