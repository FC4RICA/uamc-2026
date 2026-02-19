@props([
    'payment',
])

<div class="card">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ route('admin.drive.image', ['id' => $payment->drive_file_id]) }}" class="img-fluid" alt="Image">
        </div>
        <div class="col-md-8 d-flex flex-column">
            <div class="card-body flex-fill">
                <h5 class="card-title">{{ $payment->status->label() }}</h5>
                <p class="card-text"><strong>ชื่อบัญชีผู้โอน:</strong> {{ $payment->account_name }}</p>
                <p class="card-text"><strong>โอนจากบัญชีธนาคาร:</strong> {{ $payment->from_bank }}</p>
                <p class="card-text"><strong>วันที่และเวลาที่โอน:</strong> {{ $payment->payment_at->format('j M g:i A') }}</p>
            </div>
            @if ($payment->isPending())
                <div class="card-body border-top">
                    <div class="d-flex gap-2 ">

                        <form id="verify-payment-form" name="verify-payment-form" 
                            method="POST" action="{{ route('admin.payment.verify', $payment) }}" class="flex-fill">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm w-100" id="submit-verify-payment">
                                ยืนยัน
                            </button>
                        </form>

                        <form id="reject-payment-form" name="reject-payment-form" 
                            method="POST" action="{{ route('admin.payment.reject', $payment) }}" class="flex-fill">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm w-100" id="submit-reject-payment">
                                ปฏิเสธ
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            <div class="card-footer text-body-secondary fs-6">
                <strong>ส่งเมื่อ:</strong> {{ $payment->created_at->format('j M g:i A') }}
            </div>
        </div>
    </div>
</div>