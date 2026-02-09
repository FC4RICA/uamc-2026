@use('App\Enums\SubmissionStatus')

@extends('layouts.admin')
@section('title', 'จัดการบทความ')
@section('submission', 'active')

@section('content')
<div class="card sticky-top bg-light">
    <div class="card-body d-flex gap-2 justify-content-between align-items-center">
        <div>
            <span class="badge bg-{{ $submission->status->tone() }} fs-6">
                {{ $submission->status->label() }}
            </span>

            @if ($submission->hasActiveRevision())
                <span class="ms-2 text-muted">
                    รอบปรับปรุง #{{ $submission->current_revision_round }}
                </span>
            @endif
        </div>

        <div class="d-flex gap-2">
            @can('updateStatus', [$submission, SubmissionStatus::ACCEPTED])
                <form method="POST" id="accept-submission-form" action="{{ route('admin.submission.status.update', $submission) }}">
                    @csrf
                    <input type="hidden" name="status" value="{{ SubmissionStatus::ACCEPTED->value }}">
                    <button class="btn btn-success" id="submit-accept-submission">
                        ยืนยันบทคัดย่อ
                    </button>
                </form>
            @endcan

            @can('updateStatus', [$submission, SubmissionStatus::REVISE_REQUIRED])
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#reviseModal">
                    ขอให้ปรับปรุง
                </button>
            @endcan

            @can('updateStatus', [$submission, SubmissionStatus::REJECTED])
                <form method="POST" id="reject-submission-form" action="{{ route('admin.submission.status.update', $submission) }}">
                    @csrf
                    <input type="hidden" name="status" value="{{ SubmissionStatus::REJECTED->value }}">
                    <button class="btn btn-danger" id="submit-reject-submission">
                        ปฏิเสธบทคัดย่อ
                    </button>
                </form>
            @endcan

            @can('updateStatus', [$submission, SubmissionStatus::PENDING])
                <form method="POST" id="pending-submission-form" action="{{ route('admin.submission.status.update', $submission) }}">
                    @csrf
                    <input type="hidden" name="status" value="{{ SubmissionStatus::PENDING->value }}">
                    <button class="btn btn-danger" id="submit-pending-submission">
                        ย้อนสถานะเป็นรอพิจารณา
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
<div class="container px-4 mt-4 mb-5">
    <div class="d-flex justify-content-between">
        <h2 class="fw-bold">ข้อมูลบทคัดย่อ</h2>
        <div class="d-flex">
            <div class="mx-1">
                <a href="{{ route('admin.submission.folder', $submission) }}" class="btn btn-outline-primary">
                    <i class="fa fa-link me-2"></i>ดูไฟล์ในไดรฟ์
                </a>
            </div>
            <div class="mx-1">
                <a href="{{ route('admin.submission.edit', $submission) }}" class="btn btn-outline-warning">
                    <i class="fa fa-edit me-2"></i>แก้ไขข้อมูล
                </a>
            </div>
            <form action="{{ route('admin.submission.delete', $submission) }}"
                id="delete-submission-form" class="mx-1" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" id="submit-delete-submission">
                    <i class="fa fa-trash me-2"></i>ลบบทคัดย่อ
                </button>
            </form>
        </div>
    </div>
    <hr class="separator">

    <h5 class="mt-4 text">ID: {{ $submission->id }}</h5>

    <h3 class="mt-4">กลุ่มบทคัดย่อ</h3>
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label for="">ประเภทบทคัดย่อ</label>
                <input class="form-control-plaintext fs-6" disabled
                    value="{{ $submission->presentation_type->label() }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>สาขาของผลงาน</label>
                <input class="form-control-plaintext fs-6" disabled
                    value="{{ $submission->abstractGroups[0]->name }}">
                </select>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>สาขาของผลงาน (สำรอง)</label>
                <input class="form-control-plaintext fs-6" disabled
                    value="{{ $submission->abstractGroups[1]?->name ?? 'ไม่เลือก' }}">
                </select>
            </div>
        </div>
    </div>

    <h3 class="mt-4">ข้อมูลบทคัดย่อ</h3>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label>ชื่อบทคัดย่อภาษาไทย</label>
                <input value="{{ $submission->title_th }}"
                    class="form-control-plaintext fs-6" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>ชื่อบทคัดย่อภาษาอังกฤษ</label>
                <input value="{{ $submission->title_en }}"
                    class="form-control-plaintext fs-6" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>คำสำคัญ (Keyword)</label>
                <input value="{{ $submission->keywords }}"
                    class="form-control-plaintext fs-6" disabled>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>บทคัดย่อ</label>
                <div class="mt-1 mb-2 d-flex gap-3">
                    @foreach ($submission->abstractFiles as $abstract)
                        <a href="{{ route('member.submission.file.download', $abstract) }}" class="fs-6 text fw-bold">
                            {{ $abstract->original_file_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <hr class="separator my-4">
    <h3 class="mt-4">ข้อมูลผู้จัดทำ</h3>

    <div id="participants" class="card mb-4">
        <h4 class="card-header">ผู้ส่งผลงาน</h4>
        <div class="card-body row align-items-end">
            <div class="col-12 form-group">
                <label for=" user_email">อีเมล</label>
                <input id="user_email" name="user_email" value="{{ $submission->user->email }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-6 col-xl-2 form-group">
                <label for="user_title">คำนำหน้า</label>
                <input id="user_title" name="user_title" value="{{ $submission->user->profile->title->label() }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-sm-6 col-xl-2 form-group">
                <label for="user_academic_title">ตำแหน่งทางวิชาการ</label>
                <input id="user_academic_title" name="user_academic_title"
                    value="{{ $submission->user->profile->academic_title->label() }}" class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-4 form-group">
                <label for="user_firstname">ชื่อ</label>
                <input id="user_firstname" name="user_firstname" value="{{ $submission->user->profile->firstname }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-4 form-group">
                <label for=" user_lastname">นามสกุล</label>
                <input id="user_lastname" name="user_lastname" value="{{ $submission->user->profile->lastname }}"
                    class="form-control" disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_education">ระดับการศึกษา</label>
                <input id="user_education" name="user_education" class="form-control" disabled
                    value="{{ $submission->user->profile->education->label() }}">
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_phone">เบอร์โทร</label>
                <input id="user_phone" name="user_phone" value="{{ $submission->user->profile->phone }}" class="form-control"
                    disabled>
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_occupation">อาชีพ</label>
                <input id="user_occupation" name="user_occupation" class="form-control" disabled
                    value="{{ $submission->user->profile->occupation?->name ?? $submission->user->profile->occupation_other }}">
            </div>
            <div class="col-12 col-md-6 col-xl-3 form-group">
                <label for="user_organization">สถานที่ทำงาน/สถาบันการศึกษา/หน่วยงาน</label>
                <input id="user_organization" name="user_organization" class="form-control" disabled
                    value="{{ $submission->user->profile->organization?->name ?? $submission->user->profile->organization_other }}">
            </div>
            @if ($submission->user->profile->special_requirements)
                <div class="col-12 col-md-6 form-group">
                    <label for="special_requirements">ข้อจำกัดด้านอาหาร / ข้อมูลสุขภาพที่ควรทราบ</label>
                    <input id="special_requirements" name="special_requirements" disabled class="form-control"
                        value="{{ $submission->user->profile->special_requirements }}">
                </div>
            @endif
        </div>
    </div>

    <div id="participants-container">
        @foreach ($submission->participants as $index => $data)
            <x-participant-form :index="$index" :profile="$data->toArray()" :disabled="true"/>
        @endforeach
    </div>
</div>

{{-- submission revise form --}}
<div class="modal fade modal-lg" id="reviseModal" tabindex="-1" aria-labelledby="reviseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" class="modal-content" id="revise-submission-form"
            action="{{ route('admin.submission.status.update', $submission) }}">
            @csrf
            <input type="hidden" name="status" value="{{ SubmissionStatus::REVISE_REQUIRED->value }}">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="reviseModalLabel">
                    ส่งข้อความขอให้ปรับปรุงบทคัดย่อ<br>
                    <span class="fs-6 fw-bold text-muted">ID: {{ $submission->id }}</span>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <h6 class="fw-bold text-primary mb-3">กรุณาระบุรายละเอียดที่ผู้ส่งควรแก้ไขให้ชัดเจน ข้อความนี้จะถูกส่งทางอีเมล และแสดงในแดชบอร์ดของผู้ส่ง</h6>
                <h5 class="m-0">ผู้รับ: {{ $submission->user->email }}</h5>
                <div class="mb-3">
                    <label for="message" class="col-form-label">รายละเอียด</label>
                    <textarea value="{{ old('message') }}"
                        name="message" class="form-control" id="message" required
                        rows="6" placeholder="- กรุณาแก้ไขบทคัดย่อให้สอดคล้องกับหัวข้อ
- กรุณาเพิ่มผลการทดลองให้ชัดเจน"></textarea>
                    @error('message')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    ยกเลิก
                </button>
                <button type="button" class="btn btn-info" data-bs-target="#revisePreviewModal" data-bs-toggle="modal">
                    ดูตัวอย่าง
                </button>
                <button type="submit" class="btn btn-primary" id="submit-revise-submission">
                    ส่งคำขอปรับปรุง
                </button>
            </div>
        </form>
    </div>
</div>

{{-- submission revise preview --}}
<div class="modal fade modal-lg" id="revisePreviewModal" tabindex="-1" aria-labelledby="revisePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="revisePreviewModalLabel">
                    แจ้งขอความกรุณาปรับปรุงบทคัดย่อ สำหรับ UMAC 2026
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('emails.submission-revise-requested', [
                    'submission' => $submission,
                    'revision' => $previewRevision,
                ])
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviseModal">
                    ย้อนกลับ
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite('resources/js/pages/admin/view-submission.js')
@endpush