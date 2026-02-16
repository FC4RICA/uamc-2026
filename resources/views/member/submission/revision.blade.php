@extends('layouts.member')

@section('title', 'ปรับปรุงบทคัดย่อ')
@section('check', 'active')

@section('content')
    <div class="container px-4 my-4">
        <div class="d-flex justify-content-between">
            <h2 class="fw-bold">การแจ้งขอปรับปรุง # {{ $revision->round }}</h2>
            <div class="col-12 col-sm-6 fs-6 fw-bold text-secondary justify-content-end d-flex align-items-center">
                สร้างเมื่อ: {{ $revision->created_at->format('j M g:i A') }}
            </div>
        </div>
        <hr class="separator">

        <h5>ข้อความจากผู้ประเมิน</h5>
        <p>
            {!! nl2br(e($revision->message)) !!}
        </p>

        @if ($revision->isResolved())
            <p>บทคัดย่อที่แก้ไข</p>
            <x-submission-file-card :file="$revision->submissionFile"/>
        @else
            <form id="revision-form" action='{{ route('member.submission.abstract.upload-revision', $revision) }}' method="POST"
                enctype="multipart/form-data" name="revision-form" class="mt-4">
                @csrf
                <div class="form-group">
                    <label>อัพโหลดบทคัดย่อที่แก้ไข (PDF)</label>
                    <input type="file" name="abstract" placeholder="O_ชื่อจริง_นามสกุล.pdf หรือ P_ชื่อจริง_นามสกุล.pdf"
                        class="form-control @error('abstract') is-invalid @enderror" value="{{ old('abstract') }}"
                        onchange="onInputFileChangeLabel(this.id, this.value)" required>
                    @error('abstract')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>

                <p class="fs-6 text-secondary fw-bold">
                    *ตั้งชื่อไฟล์ผลงาน O_ชื่อ_นามสกุล.pdf หรือ P_ชื่อ_นามสกุล.pdf ตามรูปแบบการนําเสนอ*
                </p>

                <div class="text-center">
                    <button id="submit-revision" class="btn btn-warning" type="submit">
                        ส่งบทคัดย่อ
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection

@push('scripts')
    @vite('resources/js/pages/member/revision.js')
@endpush