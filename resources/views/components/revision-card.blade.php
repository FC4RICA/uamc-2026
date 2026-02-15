@props([
    'revision',
])

<div class="card mb-4">
    <h4 class="card-header">
        <div class="row g-2">
            <div class="col-12 col-sm-6">การแจ้งขอปรับปรุง # {{ $revision->round }}</div>
            <div class="col-12 col-sm-6 fs-6 fw-bold text-secondary justify-content-end d-flex align-items-center">
                สร้างเมื่อ: {{ $revision->created_at->format('j M g:i A') }}
            </div>
        </div>
    </h4>

    <div class="card-body">
        <h4>สถานะ:</h4>
        <h5>ข้อความ</h5>
        <p class="fs-6 ms-2">
            {!! nl2br(e($revision->message)) !!}
        </p>
    </div>
</div>